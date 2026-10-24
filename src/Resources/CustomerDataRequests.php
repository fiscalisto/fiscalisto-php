<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Clientes: $fiscalisto->customerDataRequests.
 */
final class CustomerDataRequests
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Pedirle sus datos fiscales a un cliente
     *
     * Una liga (url) que usted le manda a su cliente: la abre en fiscalisto.com y da su RFC,
     * nombre, régimen, código postal y uso, escritos o leídos de su constancia, revisados antes de
     * aceptarlos. Al mandarlos llega customer_data_request.completed. Un cliente nuevo queda en el
     * catálogo del emisor; si ya existía con otros datos, los nuevos vienen en submission para que
     * usted los aplique.
     *
     * POST /v1/customer_data_requests
     *
     * @param array{
     *     issuer?: string,
     *     reference?: string,
     *     description?: string,
     *     expires_in_days?: int,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer_data_request',
     *     issuer: string,
     *     status: 'open'|'completed'|'expired'|'canceled',
     *     url: string|null,
     *     reference: string|null,
     *     description: string|null,
     *     expires_at: string|null,
     *     created_at: string|null,
     *     submission: array{tax_id: string, legal_name: string, tax_system: string, zip: string, use: string, email: string|null, source: 'constancia'|'manual', customer: string|null, applied: bool, submitted_at: string|null}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/create-customer-data-request
     */
    public function create(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/customer_data_requests', ['body' => $params], $options);
    }

    /**
     * Listar solicitudes de datos
     *
     * GET /v1/customer_data_requests
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'customer_data_request', issuer: string, status: 'open'|'completed'|'expired'|'canceled', url: string|null, reference: string|null, description: string|null, expires_at: string|null, created_at: string|null, submission: array<string, mixed>|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/list-customer-data-requests
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/customer_data_requests', $params, $options);
    }

    /**
     * Ver una solicitud de datos
     *
     * GET /v1/customer_data_requests/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer_data_request',
     *     issuer: string,
     *     status: 'open'|'completed'|'expired'|'canceled',
     *     url: string|null,
     *     reference: string|null,
     *     description: string|null,
     *     expires_at: string|null,
     *     created_at: string|null,
     *     submission: array{tax_id: string, legal_name: string, tax_system: string, zip: string, use: string, email: string|null, source: 'constancia'|'manual', customer: string|null, applied: bool, submitted_at: string|null}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/get-customer-data-request
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/customer_data_requests/' . rawurlencode($id), [], $options);
    }

    /**
     * Cancelar una solicitud de datos
     *
     * La liga deja de funcionar. Una que el cliente ya contestó no se cancela.
     *
     * DELETE /v1/customer_data_requests/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer_data_request',
     *     issuer: string,
     *     status: 'open'|'completed'|'expired'|'canceled',
     *     url: string|null,
     *     reference: string|null,
     *     description: string|null,
     *     expires_at: string|null,
     *     created_at: string|null,
     *     submission: array{tax_id: string, legal_name: string, tax_system: string, zip: string, use: string, email: string|null, source: 'constancia'|'manual', customer: string|null, applied: bool, submitted_at: string|null}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/cancel-customer-data-request
     */
    public function cancel(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/customer_data_requests/' . rawurlencode($id), [], $options);
    }
}
