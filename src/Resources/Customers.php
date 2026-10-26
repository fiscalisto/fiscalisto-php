<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Clientes: $fiscalisto->customers.
 */
final class Customers
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un cliente
     *
     * POST /v1/customers
     *
     * @param array{
     *     issuer?: string,
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     email?: string|null,
     *     use?: string,
     *     foreign?: array{country: string, tax_id: string}|null,
     *     ieps_taxpayer?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer',
     *     issuer: string,
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     email: string|null,
     *     use: string|null,
     *     foreign: array{country: string, tax_id: string|null}|null,
     *     ieps_taxpayer: bool,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/create-customer
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/customers', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar clientes
     *
     * GET /v1/customers
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string, tax_id?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'customer', issuer: string, tax_id: string, legal_name: string, tax_system: string, zip: string, email: string|null, use: string|null, foreign: array<string, mixed>|null, ieps_taxpayer: bool, created_at: string, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/list-customers
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/customers', $params, $options);
    }

    /**
     * Ver un cliente
     *
     * GET /v1/customers/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer',
     *     issuer: string,
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     email: string|null,
     *     use: string|null,
     *     foreign: array{country: string, tax_id: string|null}|null,
     *     ieps_taxpayer: bool,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/get-customer
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/customers/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un cliente
     *
     * POST /v1/customers/{id}
     *
     * @param string $id
     * @param array{
     *     tax_id?: string,
     *     legal_name?: string,
     *     tax_system?: string,
     *     zip?: string,
     *     email?: string|null,
     *     use?: string,
     *     foreign?: array{country: string, tax_id: string}|null,
     *     ieps_taxpayer?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer',
     *     issuer: string,
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     email: string|null,
     *     use: string|null,
     *     foreign: array{country: string, tax_id: string|null}|null,
     *     ieps_taxpayer: bool,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/update-customer
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/customers/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un cliente
     *
     * DELETE /v1/customers/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/delete-customer
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/customers/' . rawurlencode($id), [], $options);
    }
}
