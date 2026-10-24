<?php

declare(strict_types=1);

namespace Fiscalisto;

/**
 * Verificar que un webhook lo mandó Fiscalisto (Standard Webhooks): la firma HMAC-SHA256 de
 * `webhook-id.webhook-timestamp.cuerpo` con el secreto whsec_ del endpoint.
 */
final class Webhook
{
    /**
     * Revisa la firma y la hora de un webhook y le devuelve el evento. Pase el cuerpo exactamente
     * como llegó (file_get_contents('php://input')), no el JSON ya interpretado: un espacio de
     * diferencia cambia la firma. $headers: getallheaders(), los de su framework o $_SERVER.
     *
     * @param array<string, string|list<string>> $headers
     * @return array<string, mixed> El evento: type, data.object…
     * @throws WebhookException Si no es de Fiscalisto.
     */
    public static function verify(string $payload, array $headers, string $secret, int $tolerance = 300, ?int $now = null): array
    {
        $id = self::header($headers, 'webhook-id');
        $timestamp = self::header($headers, 'webhook-timestamp');
        $signatures = self::header($headers, 'webhook-signature');
        if ($id === null || $timestamp === null || $signatures === null) {
            throw new WebhookException('Faltan los encabezados webhook-id, webhook-timestamp o webhook-signature.');
        }
        if (!ctype_digit($timestamp) || abs(($now ?? time()) - (int) $timestamp) > $tolerance) {
            throw new WebhookException('La hora del webhook está fuera de tolerancia: puede ser una repetición.');
        }
        if (!str_starts_with($secret, 'whsec_')) {
            throw new WebhookException('El secreto del endpoint empieza con whsec_.');
        }
        $key = base64_decode(substr($secret, strlen('whsec_')), true);
        if ($key === false) {
            throw new WebhookException('El secreto del endpoint no es válido.');
        }
        $expected = hash_hmac('sha256', "{$id}.{$timestamp}.{$payload}", $key, true);
        // Several during a secret change, separated by spaces: any one valid is enough.
        foreach (explode(' ', $signatures) as $part) {
            $pieces = explode(',', $part, 2);
            $version = $pieces[0];
            $signature = $pieces[1] ?? '';
            if ($version !== 'v1' || $signature === '') {
                continue;
            }
            $given = base64_decode($signature, true);
            if ($given !== false && hash_equals($expected, $given)) {
                $event = json_decode($payload, true);
                if (!is_array($event)) {
                    throw new WebhookException('El cuerpo del webhook no es JSON.');
                }
                /** @var array<string, mixed> $event */
                return $event;
            }
        }
        throw new WebhookException('La firma del webhook no coincide con el secreto.');
    }

    /** @param array<string, string|list<string>> $headers */
    private static function header(array $headers, string $name): ?string
    {
        $server = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        foreach ($headers as $k => $v) {
            if (strcasecmp((string) $k, $name) === 0 || $k === $server) {
                $value = is_array($v) ? ($v[0] ?? null) : $v;
                return $value === null ? null : (string) $value;
            }
        }
        return null;
    }
}
