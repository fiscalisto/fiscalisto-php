<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Webhooks: $fiscalisto->webhookEndpoints.
 */
final class WebhookEndpoints
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un webhook
     *
     * La respuesta trae el secreto de firma (secret) una sola vez.
     *
     * POST /v1/webhook_endpoints
     *
     * @param array{
     *     url: string,
     *     events?: list<string>|null,
     *     description?: string|null,
     *     api_version?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'webhook_endpoint',
     *     sandbox: string|null,
     *     url: string,
     *     description: string|null,
     *     events: list<string>,
     *     status: 'enabled'|'failing'|'disabled',
     *     disabled_reason?: string|null,
     *     failing_since?: string|null,
     *     previous_secret_expires_at: string|null,
     *     api_version: string|null,
     *     created_at: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/create-webhook-endpoint
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/webhook_endpoints', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar webhooks
     *
     * GET /v1/webhook_endpoints
     *
     * @param array{limit?: int, starting_after?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'webhook_endpoint', sandbox: string|null, url: string, description: string|null, events: list<string>, status: 'enabled'|'failing'|'disabled', disabled_reason?: string|null, failing_since?: string|null, previous_secret_expires_at: string|null, api_version: string|null, created_at: string|null, secret?: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/list-webhook-endpoints
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/webhook_endpoints', $params, $options);
    }

    /**
     * Ver un webhook
     *
     * GET /v1/webhook_endpoints/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'webhook_endpoint',
     *     sandbox: string|null,
     *     url: string,
     *     description: string|null,
     *     events: list<string>,
     *     status: 'enabled'|'failing'|'disabled',
     *     disabled_reason?: string|null,
     *     failing_since?: string|null,
     *     previous_secret_expires_at: string|null,
     *     api_version: string|null,
     *     created_at: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/get-webhook-endpoint
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/webhook_endpoints/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un webhook
     *
     * POST /v1/webhook_endpoints/{id}
     *
     * @param string $id
     * @param array{
     *     url?: string,
     *     events?: list<string>|null,
     *     description?: string|null,
     *     disabled?: bool,
     *     api_version?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'webhook_endpoint',
     *     sandbox: string|null,
     *     url: string,
     *     description: string|null,
     *     events: list<string>,
     *     status: 'enabled'|'failing'|'disabled',
     *     disabled_reason?: string|null,
     *     failing_since?: string|null,
     *     previous_secret_expires_at: string|null,
     *     api_version: string|null,
     *     created_at: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/update-webhook-endpoint
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/webhook_endpoints/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un webhook
     *
     * DELETE /v1/webhook_endpoints/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/delete-webhook-endpoint
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/webhook_endpoints/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar el secreto
     *
     * Un secreto nuevo, que la respuesta trae una sola vez. El anterior sigue firmando (una
     * segunda firma en webhook-signature) el tiempo que elija, 24 horas por omisión, para que
     * cambie su servidor sin rechazar eventos. Si se filtró, mande previous_secret_expires_in: 0.
     *
     * POST /v1/webhook_endpoints/{id}/roll_secret
     *
     * @param string $id
     * @param array{previous_secret_expires_in?: int} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'webhook_endpoint',
     *     sandbox: string|null,
     *     url: string,
     *     description: string|null,
     *     events: list<string>,
     *     status: 'enabled'|'failing'|'disabled',
     *     disabled_reason?: string|null,
     *     failing_since?: string|null,
     *     previous_secret_expires_at: string|null,
     *     api_version: string|null,
     *     created_at: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/roll-webhook-secret
     */
    public function rollSecret(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/webhook_endpoints/' . rawurlencode($id) . '/roll_secret', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Mandar un evento de prueba
     *
     * Manda ahora, una sola vez y sin reintentos, un evento del tipo que elija con un objeto de
     * ejemplo (sus id no existen), firmado como los reales, aunque el webhook no escuche ese tipo.
     * La respuesta trae lo que contestó su servidor. El evento no sale en GET /v1/events, pero sí
     * en las entregas del webhook.
     *
     * POST /v1/webhook_endpoints/{id}/test
     *
     * @param string $id
     * @param array{
     *     type?: 'invoice.stamped'|'invoice.failed'|'invoice.canceled'|'invoice.cancellation_pending'|'invoice.cancellation_rejected'|'invoice.paid'|'invoice.partially_paid'|'retention.stamped'|'retention.failed'|'retention.canceled'|'invoice_batch.completed'|'customer_data_request.completed'|'sat_download.completed'|'sat_download.failed'|'ticket.invoiced'|'ticket.included_in_global'|'recurring_invoice.failed'|'quote.viewed'|'quote.accepted'|'quote.changes_requested'|'quote.rejected'|'issuer.ready'|'balance.low'|'test_clock.ready',
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'webhook_test',
     *     event: array{id: string, object: 'event', type: string, api_version: string, livemode: bool, created_at: string, data: array<string, mixed>},
     *     delivery: array{ok: bool, status: int|null, error: string|null, response_body: string|null, duration_ms: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/test-webhook-endpoint
     */
    public function test(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/webhook_endpoints/' . rawurlencode($id) . '/test', ['body' => $params, 'idempotent' => true], $options);
    }
}
