<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Listas de precios: $fiscalisto->customerGroups.
 */
final class CustomerGroups
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un grupo de clientes
     *
     * Lo que tienen todos sus clientes: price_list, discount_percent (el descuento de cada
     * concepto en el CFDI), credit_days, min_order (antes de IVA, desde el portal) y
     * portal_ordering. Un cliente entra con group en POST /v1/customers/{id}.
     *
     * POST /v1/customer_groups
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     color?: 'info'|'warning'|'positive'|'critical'|'muted',
     *     price_list?: string|null,
     *     discount_percent?: float|int,
     *     credit_days?: int|null,
     *     min_order?: float|int|null,
     *     portal_ordering?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer_group',
     *     issuer: string,
     *     name: string,
     *     color: string,
     *     price_list: string|null,
     *     discount_percent: float|int,
     *     credit_days: int|null,
     *     min_order: float|int|null,
     *     portal_ordering: bool,
     *     customers: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/create-customer-group
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/customer_groups', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar grupos de clientes
     *
     * Los grupos de clientes, con cuántos clientes tiene cada uno.
     *
     * GET /v1/customer_groups
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'customer_group', issuer: string, name: string, color: string, price_list: string|null, discount_percent: float|int, credit_days: int|null, min_order: float|int|null, portal_ordering: bool, customers: int, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/list-customer-groups
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/customer_groups', $params, $options);
    }

    /**
     * Ver un grupo de clientes
     *
     * Un grupo de clientes.
     *
     * GET /v1/customer_groups/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer_group',
     *     issuer: string,
     *     name: string,
     *     color: string,
     *     price_list: string|null,
     *     discount_percent: float|int,
     *     credit_days: int|null,
     *     min_order: float|int|null,
     *     portal_ordering: bool,
     *     customers: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/get-customer-group
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/customer_groups/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un grupo de clientes
     *
     * Cambia solo lo que manda.
     *
     * POST /v1/customer_groups/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     color?: 'info'|'warning'|'positive'|'critical'|'muted',
     *     price_list?: string|null,
     *     discount_percent?: float|int,
     *     credit_days?: int|null,
     *     min_order?: float|int|null,
     *     portal_ordering?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer_group',
     *     issuer: string,
     *     name: string,
     *     color: string,
     *     price_list: string|null,
     *     discount_percent: float|int,
     *     credit_days: int|null,
     *     min_order: float|int|null,
     *     portal_ordering: bool,
     *     customers: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/update-customer-group
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/customer_groups/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar un grupo de clientes
     *
     * Sus clientes se quedan sin grupo.
     *
     * DELETE /v1/customer_groups/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/delete-customer-group
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/customer_groups/' . rawurlencode($id), [], $options);
    }
}
