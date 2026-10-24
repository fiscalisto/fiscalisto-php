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
     * @param array{url: string, events?: list<string>|null, description?: string|null} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'webhook_endpoint',
     *     url: string,
     *     description: string|null,
     *     events: list<string>,
     *     status: 'enabled'|'failing'|'disabled',
     *     disabled_reason?: string|null,
     *     failing_since?: string|null,
     *     previous_secret_expires_at: string|null,
     *     created_at: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/create-webhook-endpoint
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/webhook_endpoints', ['body' => $params], $options);
    }

    /**
     * Listar webhooks
     *
     * GET /v1/webhook_endpoints
     *
     * @param array{limit?: int, starting_after?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'webhook_endpoint', url: string, description: string|null, events: list<string>, status: 'enabled'|'failing'|'disabled', disabled_reason?: string|null, failing_since?: string|null, previous_secret_expires_at: string|null, created_at: string|null, secret?: string}>
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
     *     url: string,
     *     description: string|null,
     *     events: list<string>,
     *     status: 'enabled'|'failing'|'disabled',
     *     disabled_reason?: string|null,
     *     failing_since?: string|null,
     *     previous_secret_expires_at: string|null,
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
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'webhook_endpoint',
     *     url: string,
     *     description: string|null,
     *     events: list<string>,
     *     status: 'enabled'|'failing'|'disabled',
     *     disabled_reason?: string|null,
     *     failing_since?: string|null,
     *     previous_secret_expires_at: string|null,
     *     created_at: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/update-webhook-endpoint
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/webhook_endpoints/' . rawurlencode($id), ['body' => $params], $options);
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
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'webhook_endpoint',
     *     url: string,
     *     description: string|null,
     *     events: list<string>,
     *     status: 'enabled'|'failing'|'disabled',
     *     disabled_reason?: string|null,
     *     failing_since?: string|null,
     *     previous_secret_expires_at: string|null,
     *     created_at: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/webhooks/roll-webhook-secret
     */
    public function rollSecret(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/webhook_endpoints/' . rawurlencode($id) . '/roll_secret', ['body' => $params], $options);
    }
}
