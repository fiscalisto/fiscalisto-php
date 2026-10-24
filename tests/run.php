<?php

declare(strict_types=1);

/**
 * El SDK sin red: un transport falso contesta como la API. php tests/run.php
 */

use Fiscalisto\Fiscalisto;
use Fiscalisto\FiscalistoException;
use Fiscalisto\TransportException;
use Fiscalisto\Webhook;
use Fiscalisto\WebhookException;

spl_autoload_register(static function (string $class): void {
    $file = __DIR__ . '/../src/' . str_replace('\\', '/', substr($class, strlen('Fiscalisto\\'))) . '.php';
    if (str_starts_with($class, 'Fiscalisto\\') && is_file($file)) {
        require $file;
    }
});

$failures = 0;
$count = 0;

function test(string $name, callable $body): void
{
    global $failures, $count;
    $count++;
    try {
        $body();
        echo "ok   {$name}\n";
    } catch (\Throwable $e) {
        $failures++;
        echo "FAIL {$name}: {$e->getMessage()} ({$e->getFile()}:{$e->getLine()})\n";
    }
}

function same(mixed $expected, mixed $actual, string $what = ''): void
{
    if ($expected !== $actual) {
        throw new \RuntimeException(($what ? "{$what}: " : '') . 'esperaba ' . var_export($expected, true) . ', llegó ' . var_export($actual, true));
    }
}

/** @return callable */
function throws(string $class, callable $body): \Throwable
{
    try {
        $body();
    } catch (\Throwable $e) {
        if ($e instanceof $class) {
            return $e;
        }
        throw new \RuntimeException("esperaba {$class}, llegó " . get_class($e) . ': ' . $e->getMessage());
    }
    throw new \RuntimeException("esperaba {$class}, no lanzó nada");
}

final class Fake
{
    /** @var list<array<string, mixed>> */
    public array $requests = [];
    /** @var list<float> */
    public array $waits = [];

    /** @param list<array{status: int, headers: array<string, string>, body: string}|\Throwable> $answers */
    public function __construct(private array $answers)
    {
    }

    /** @param array<string, mixed> $options */
    public function client(array $options = []): Fiscalisto
    {
        return new Fiscalisto('fk_test_abc', $options + [
            'transport' => function (array $request): array {
                $this->requests[] = $request;
                $a = array_shift($this->answers);
                if ($a instanceof \Throwable) {
                    throw $a;
                }
                return $a;
            },
            'sleep' => function (float $s): void {
                $this->waits[] = $s;
            },
        ]);
    }
}

/** @param array<string, string> $headers */
function answer(int $status, mixed $body, array $headers = []): array
{
    return ['status' => $status, 'headers' => $headers, 'body' => is_string($body) ? $body : json_encode($body)];
}

$error = ['error' => [
    'type' => 'invoice_error',
    'code' => 'invoice_rejected',
    'message' => 'El SAT no la aceptó.',
    'param' => 'customer',
    'sat_code' => 'CFDI40147',
    'invoice' => 'inv_1',
    'request_id' => 'req_1',
]];
$serverError = answer(503, ['error' => ['type' => 'api_error', 'code' => 'internal_error']]);

test('pide una llave fk_', function (): void {
    putenv('FISCALISTO_API_KEY');
    throws(\InvalidArgumentException::class, fn () => new Fiscalisto());
    throws(\InvalidArgumentException::class, fn () => new Fiscalisto('whsec_x'));
    putenv('FISCALISTO_API_KEY=fk_live_x');
    same(true, (new Fiscalisto())->livemode);
    putenv('FISCALISTO_API_KEY');
    same(false, (new Fiscalisto('fk_test_x'))->livemode);
});

test('manda la llave y JSON', function (): void {
    $fake = new Fake([answer(200, ['id' => 'cus_1'])]);
    $fake->client(['base_url' => 'http://api.localhost:3000'])->customers->create(['tax_id' => 'ICV060329BY0', 'legal_name' => 'INMOBILIARIA CVA']);
    $r = $fake->requests[0];
    same('POST', $r['method']);
    same('http://api.localhost:3000/v1/customers', $r['url']);
    same('Bearer fk_test_abc', $r['headers']['authorization']);
    same(false, isset($r['headers']['idempotency-key']));
    same('INMOBILIARIA CVA', json_decode($r['body'], true)['legal_name']);
    same(true, str_contains($r['body'], 'INMOBILIARIA CVA'));
});

test('un cuerpo vacío es {}', function (): void {
    $fake = new Fake([answer(200, ['id' => 'whe_1'])]);
    $fake->client()->webhookEndpoints->rollSecret('whe_1');
    same('{}', $fake->requests[0]['body']);
});

test('lo que timbra lleva Idempotency-Key, la misma en cada reintento', function () use ($serverError): void {
    $fake = new Fake([$serverError, new TransportException('reset'), answer(201, ['id' => 'inv_1'])]);
    same('inv_1', $fake->client()->invoices->create(['items' => []])['id']);
    same(3, count($fake->requests));
    same(1, count(array_unique(array_map(fn ($r) => $r['headers']['idempotency-key'], $fake->requests))));
    same(2, count($fake->waits));
    $fake = new Fake([answer(201, ['id' => 'inv_2'])]);
    $fake->client()->invoices->substitute('inv_1/x', ['items' => []], ['idempotency_key' => 'pedido-1042']);
    same('pedido-1042', $fake->requests[0]['headers']['idempotency-key']);
    same('https://api.fiscalisto.com/v1/invoices/inv_1%2Fx/substitute', $fake->requests[0]['url']);
});

test('no repite lo que podría hacer algo dos veces', function (): void {
    $fake = new Fake([answer(500, ['error' => ['type' => 'api_error', 'code' => 'internal_error']])]);
    $e = throws(FiscalistoException::class, fn () => $fake->client()->customers->create(['tax_id' => 'X', 'legal_name' => 'X']));
    same([500, 1], [$e->status, count($fake->requests)]);
    $fake = new Fake([new TransportException('down')]);
    $e = throws(FiscalistoException::class, fn () => $fake->client()->customers->create(['tax_id' => 'X', 'legal_name' => 'X']));
    same(['connection_error', 'connection_failed'], [$e->type, $e->errorCode]);
});

test('espera lo que dice Retry-After', function (): void {
    $busy = ['error' => ['type' => 'rate_limit_error', 'code' => 'rate_limit']];
    $fake = new Fake([answer(429, $busy, ['Retry-After' => '7']), answer(200, ['object' => 'balance'])]);
    $fake->client()->balance->get();
    same([7.0], $fake->waits);
    $fake = new Fake([answer(429, $busy, ['retry-after' => '3600'])]);
    $e = throws(FiscalistoException::class, fn () => $fake->client()->balance->get());
    same(['rate_limit', []], [$e->errorCode, $fake->waits]);
});

test('espera un timbrado en proceso y se rinde tras max_retries', function () use ($serverError): void {
    $fake = new Fake([answer(409, ['error' => ['type' => 'idempotency_error', 'code' => 'request_in_progress']]), answer(201, ['id' => 'inv_1'])]);
    $fake->client()->invoices->create(['items' => []]);
    same(2, count($fake->requests));
    $fake = new Fake([$serverError, $serverError]);
    throws(FiscalistoException::class, fn () => $fake->client(['max_retries' => 1])->invoices->get('inv_1'));
    same(2, count($fake->requests));
    $fake = new Fake([new TransportException('timed out', true)]);
    $e = throws(FiscalistoException::class, fn () => $fake->client()->invoices->create(['items' => []], ['max_retries' => 0]));
    same('timeout', $e->errorCode);
    same(true, str_contains($e->getMessage(), 'Idempotency-Key'));
});

test('los errores dicen qué corregir', function () use ($error): void {
    $fake = new Fake([answer(422, $error, ['request-id' => 'req_header'])]);
    $e = throws(FiscalistoException::class, fn () => $fake->client()->invoices->create(['items' => []]));
    same(
        ['invoice_error', 'invoice_rejected', 'customer', 'CFDI40147', 'inv_1', 'req_1', 422, 422, 'El SAT no la aceptó.'],
        [$e->type, $e->errorCode, $e->param, $e->satCode, $e->invoice, $e->requestId, $e->status, $e->getCode(), $e->getMessage()],
    );
    $fake = new Fake([answer(502, '<html>bad gateway</html>', ['request-id' => 'req_2'])]);
    $e = throws(FiscalistoException::class, fn () => $fake->client(['max_retries' => 0])->account->get());
    same(['unknown', 'req_2'], [$e->errorCode, $e->requestId]);
});

test('archivos y parámetros', function (): void {
    $fake = new Fake([answer(200, '%PDF-1.7'), answer(200, '<cfdi:Comprobante/>'), answer(200, ['object' => 'list', 'data' => [], 'has_more' => false])]);
    $f = $fake->client();
    same('%PDF-1.7', $f->invoices->pdf('inv_1'));
    same('<cfdi:Comprobante/>', $f->invoices->xml('inv_1'));
    iterator_to_array($f->issuers->list(['include_archived' => true, 'limit' => 5]));
    same(true, str_ends_with($fake->requests[2]['url'], '?include_archived=true&limit=5'));
});

test('las listas recorren todas las páginas', function (): void {
    $page = fn (array $ids, bool $more) => answer(200, ['object' => 'list', 'data' => array_map(fn ($i) => ['id' => $i], $ids), 'has_more' => $more]);
    $fake = new Fake([$page(['cus_1', 'cus_2'], true), $page(['cus_3'], false)]);
    $list = $fake->client()->customers->list(['limit' => 2]);
    same(['cus_1', 'cus_2'], array_column($list->data(), 'id'));
    same(true, $list->hasMore());
    $all = [];
    foreach ($list as $c) {
        $all[] = $c['id'];
    }
    same(['cus_1', 'cus_2', 'cus_3'], $all);
    same(true, str_ends_with($fake->requests[1]['url'], 'limit=2&starting_after=cus_2'));
    $fake = new Fake([$page(['cus_1', 'cus_2'], true)]);
    same(1, count($fake->client()->customers->list()->toArray(1)));
});

$vector = json_decode((string) file_get_contents(__DIR__ . '/../../fixtures/webhook.json'), true);

test('verifica Standard Webhooks', function () use ($vector): void {
    $h = $vector['headers'];
    $at = $vector['timestamp'];
    same('invoice.stamped', Webhook::verify($vector['body'], $h, $vector['secret'], 300, $at)['type']);
    same($h['webhook-id'], (new Fiscalisto('fk_test_x'))->webhooks->verify($vector['body'], $h, $vector['secret'], 300, $at)['id']);
    Webhook::verify($vector['body'], ['webhook-signature' => $vector['overlap_signature']] + $h, $vector['secret'], 300, $at);
    $title = [];
    $server = [];
    $lists = [];
    foreach ($h as $k => $v) {
        $title[ucwords($k, '-')] = $v;
        $server['HTTP_' . strtoupper(str_replace('-', '_', $k))] = $v;
        $lists[$k] = [$v];
    }
    Webhook::verify($vector['body'], $title, $vector['secret'], 300, $at);
    Webhook::verify($vector['body'], $server, $vector['secret'], 300, $at);
    Webhook::verify($vector['body'], $lists, $vector['secret'], 300, $at);
});

test('rechaza lo que no es de Fiscalisto', function () use ($vector): void {
    $h = $vector['headers'];
    $at = $vector['timestamp'];
    $cases = [
        [$vector['body'], ['webhook-signature' => $vector['wrong_signature']] + $h, $vector['secret'], $at],
        [$vector['body'] . ' ', $h, $vector['secret'], $at],
        [$vector['body'], $h, $vector['secret'], $at + 301],
        [$vector['body'], ['webhook-id' => $h['webhook-id']], $vector['secret'], $at],
        [$vector['body'], $h, 'fk_test_x', $at],
    ];
    foreach ($cases as [$payload, $headers, $secret, $now]) {
        throws(WebhookException::class, fn () => Webhook::verify($payload, $headers, $secret, 300, $now));
    }
});

test('cada ruta tiene su método', function (): void {
    $calls = json_decode((string) file_get_contents(__DIR__ . '/../../fixtures/calls.json'), true);
    $f = new Fiscalisto('fk_test_x');
    foreach ($calls as $route => $call) {
        [$resource, $method] = explode('->', $call['php']);
        same(true, method_exists($f->{$resource}, $method), $route);
    }
});

echo "\n{$count} pruebas, {$failures} fallaron\n";
exit($failures ? 1 : 0);
