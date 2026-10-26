<?php

declare(strict_types=1);

namespace Fiscalisto;

/**
 * Lo que hace cada llamada del SDK: la llave, la Idempotency-Key, los reintentos seguros, los
 * errores y las listas que se recorren solas. Los recursos (Resources/) solo dicen qué ruta
 * llamar.
 */
abstract class Core
{
    public const VERSION = '0.1.1';
    public const DEFAULT_BASE_URL = 'https://api.fiscalisto.com';
    /** La versión de la API para la que se hizo este SDK (cabecera Fiscalisto-Version). */
    public const API_VERSION = '2026-10-24';

    /** true con una llave fk_live_ (producción), false con fk_test_ (pruebas). */
    public readonly bool $livemode;

    private readonly string $key;
    private readonly string $baseUrl;
    private readonly int $maxRetries;
    private readonly float $timeout;
    private readonly ?string $apiVersion;
    private readonly ?string $language;
    /** @var callable(array{method: string, url: string, headers: array<string, string>, body: ?string, timeout: float}): array{status: int, headers: array<string, string>, body: string} */
    private $transport;
    /** @var callable(float): void */
    private $sleep;

    /**
     * @param array{base_url?: string, api_version?: ?string, language?: 'es'|'en', max_retries?: int, timeout?: float|int, transport?: callable, sleep?: callable} $options
     */
    public function __construct(?string $apiKey = null, array $options = [])
    {
        $key = $apiKey ?? (getenv('FISCALISTO_API_KEY') ?: null);
        if ($key === null || $key === '') {
            throw new \InvalidArgumentException(
                'Falta la llave de la API: new Fiscalisto(\'fk_test_…\') o la variable FISCALISTO_API_KEY. Créela en Desarrolladores › Llaves.'
            );
        }
        if (!preg_match('/^fk_(live|test)_/', $key)) {
            throw new \InvalidArgumentException(
                'La llave de la API empieza con fk_live_ o fk_test_. (Un secreto whsec_ es para verificar webhooks.)'
            );
        }
        $this->key = $key;
        $this->livemode = str_starts_with($key, 'fk_live_');
        $this->baseUrl = rtrim($options['base_url'] ?? self::DEFAULT_BASE_URL, '/');
        // null: la versión fijada en la cuenta.
        $this->apiVersion = array_key_exists('api_version', $options) ? $options['api_version'] : self::API_VERSION;
        // 'en': error messages in English (Accept-Language).
        $this->language = $options['language'] ?? null;
        $this->maxRetries = $options['max_retries'] ?? 2;
        $this->timeout = (float) ($options['timeout'] ?? 80);
        $this->transport = $options['transport'] ?? [self::class, 'curlTransport'];
        $this->sleep = $options['sleep'] ?? static function (float $seconds): void {
            usleep((int) round($seconds * 1_000_000));
        };
    }

    /**
     * @param array{body?: array<mixed>, query?: array<string, mixed>, idempotent?: bool, as?: 'json'|'bytes'|'text'} $spec
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int, expand?: list<string>} $options
     * @return mixed El JSON como arreglo, o el texto del PDF o el XML.
     * @throws FiscalistoException
     */
    public function request(string $method, string $path, array $spec = [], array $options = []): mixed
    {
        $url = $this->baseUrl . $path;
        $query = self::query($spec['query'] ?? []);
        // Ids as their objects in the same answer: ['expand' => ['issuer', 'data.recurring_invoice']].
        foreach ($options['expand'] ?? [] as $e) {
            $query .= ($query === '' ? '' : '&') . 'expand%5B%5D=' . rawurlencode($e);
        }
        if ($query !== '') {
            $url .= '?' . $query;
        }
        $headers = [
            'authorization' => 'Bearer ' . $this->key,
            'user-agent' => 'fiscalisto-php/' . self::VERSION . ' PHP/' . PHP_VERSION,
            'accept' => 'application/json',
        ];
        if ($this->apiVersion !== null) {
            $headers['fiscalisto-version'] = $this->apiVersion;
        }
        if ($this->language !== null) {
            $headers['accept-language'] = $this->language;
        }
        $idempotencyKey = ($spec['idempotent'] ?? false)
            ? ($options['idempotency_key'] ?? self::uuid())
            : null;
        if ($idempotencyKey !== null) {
            $headers['idempotency-key'] = $idempotencyKey;
        }
        $body = null;
        if ($method === 'POST') {
            $headers['content-type'] = 'application/json';
            $data = $spec['body'] ?? [];
            // An empty PHP array is an empty JSON object here, never [].
            $body = $data === [] ? '{}' : json_encode(
                $data,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION | JSON_THROW_ON_ERROR
            );
        }
        // Only what can't do something twice is repeated after a failure we can't see through:
        // reads, deletes and requests with an Idempotency-Key. A 429 was never processed.
        $safe = $method === 'GET' || $method === 'DELETE' || $idempotencyKey !== null;
        $retries = $options['max_retries'] ?? $this->maxRetries;
        $timeout = (float) ($options['timeout'] ?? $this->timeout);

        for ($attempt = 0; ; $attempt++) {
            try {
                $response = ($this->transport)([
                    'method' => $method,
                    'url' => $url,
                    'headers' => $headers,
                    'body' => $body,
                    'timeout' => $timeout,
                ]);
            } catch (TransportException $error) {
                if ($safe && $attempt < $retries) {
                    ($this->sleep)(self::backoff($attempt));
                    continue;
                }
                $hint = $idempotencyKey !== null
                    ? " Repita con la misma Idempotency-Key ({$idempotencyKey}) para saber si se timbró."
                    : '';
                throw new FiscalistoException([
                    'type' => 'connection_error',
                    'code' => $error->timedOut ? 'timeout' : 'connection_failed',
                    'message' => $error->timedOut
                        ? 'La API no contestó en ' . $timeout . ' s.' . $hint
                        : 'No se pudo conectar con la API: ' . $error->getMessage(),
                    'idempotency_key' => $idempotencyKey,
                ], null, null, $error);
            }
            $status = $response['status'];
            $responseHeaders = array_change_key_case($response['headers'], CASE_LOWER);
            $requestId = $responseHeaders['request-id'] ?? null;
            if ($status >= 200 && $status < 300) {
                $as = $spec['as'] ?? 'json';
                if ($as !== 'json') {
                    return $response['body'];
                }
                try {
                    return json_decode($response['body'], true, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException) {
                    // A proxy's or a network portal's page answered instead of the API.
                    $text = substr(trim((string) preg_replace('/\s+/', ' ', $response['body'])), 0, 80);
                    throw new FiscalistoException([
                        'type' => 'api_error',
                        'code' => 'invalid_response',
                        'message' => "La respuesta ($status) no es de la API: " . ($text !== '' ? $text : 'vacía') . '. ¿Hay un proxy o un portal de por medio?',
                    ], $status, $requestId);
                }
            }
            $parsed = json_decode($response['body'], true);
            /** @var array<string, mixed> $raw */
            $raw = is_array($parsed) && is_array($parsed['error'] ?? null) ? $parsed['error'] : [];
            $retryAfter = is_numeric($responseHeaders['retry-after'] ?? null) ? (float) $responseHeaders['retry-after'] : 0.0;
            $retryable = $status === 429
                || ($raw['code'] ?? null) === 'request_in_progress'
                || ($safe && $status >= 500);
            if ($retryable && $attempt < $retries && $retryAfter <= 60) {
                ($this->sleep)($retryAfter > 0 ? $retryAfter : self::backoff($attempt));
                continue;
            }
            throw new FiscalistoException($raw, $status, $requestId);
        }
    }

    /**
     * @param array<string, mixed> $query
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array<string, mixed>>
     */
    public function list(string $path, array $query, array $options = []): Collection
    {
        return new Collection(function (?string $startingAfter) use ($path, $query, $options): array {
            if ($startingAfter !== null) {
                $query['starting_after'] = $startingAfter;
            }
            /** @var array{object: string, data: list<array<string, mixed>>, has_more: bool, url: string} */
            return $this->request('GET', $path, ['query' => $query], $options);
        });
    }

    /** @param array<string, mixed> $query */
    private static function query(array $query): string
    {
        $pairs = [];
        foreach ($query as $k => $v) {
            if ($v === null) {
                continue;
            }
            $value = is_bool($v) ? ($v ? 'true' : 'false') : (is_scalar($v) ? (string) $v : json_encode($v, JSON_THROW_ON_ERROR));
            $pairs[] = rawurlencode((string) $k) . '=' . rawurlencode($value);
        }
        return implode('&', $pairs);
    }

    /** 0.5 s, 1 s, 2 s… hasta 8 s, con algo de azar para no llegar todos juntos. */
    private static function backoff(int $attempt): float
    {
        return min(8.0, 0.5 * 2 ** $attempt) * (0.75 + mt_rand() / mt_getrandmax() / 2);
    }

    private static function uuid(): string
    {
        $b = random_bytes(16);
        $b[6] = chr((ord($b[6]) & 0x0f) | 0x40);
        $b[8] = chr((ord($b[8]) & 0x3f) | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($b), 4));
    }

    /**
     * El transport de siempre, con cURL.
     *
     * @param array{method: string, url: string, headers: array<string, string>, body: ?string, timeout: float} $request
     * @return array{status: int, headers: array<string, string>, body: string}
     * @throws TransportException
     */
    public static function curlTransport(array $request): array
    {
        $headers = [];
        foreach ($request['headers'] as $k => $v) {
            $headers[] = $k . ': ' . $v;
        }
        $responseHeaders = [];
        $ch = curl_init($request['url']);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => $request['method'],
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT_MS => (int) round($request['timeout'] * 1000),
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HEADERFUNCTION => static function ($ch, string $line) use (&$responseHeaders): int {
                $parts = explode(':', $line, 2);
                if (count($parts) === 2) {
                    $responseHeaders[strtolower(trim($parts[0]))] = trim($parts[1]);
                }
                return strlen($line);
            },
        ]);
        if ($request['body'] !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request['body']);
        }
        $body = curl_exec($ch);
        if ($body === false) {
            $errno = curl_errno($ch);
            $message = curl_error($ch);
            throw new TransportException($message, $errno === CURLE_OPERATION_TIMEDOUT);
        }
        $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        return ['status' => $status, 'headers' => $responseHeaders, 'body' => (string) $body];
    }
}
