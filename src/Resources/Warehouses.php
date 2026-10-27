<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Inventario: $fiscalisto->warehouses.
 */
final class Warehouses
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar almacenes
     *
     * Los almacenes del emisor, los más recientes primero: el de la Matriz y uno por sucursal se
     * crean solos. Todos en una página.
     *
     * GET /v1/warehouses
     *
     * @param array{issuer?: string, include_archived?: bool} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'warehouse', issuer: string, name: string, code: string|null, type: 'warehouse'|'consignment', branch: string|null, default: bool, archived: bool, created_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/list-warehouses
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/warehouses', ['query' => $params], $options);
    }

    /**
     * Ver un almacén
     *
     * Un almacén del emisor.
     *
     * GET /v1/warehouses/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'warehouse',
     *     issuer: string,
     *     name: string,
     *     code: string|null,
     *     type: 'warehouse'|'consignment',
     *     branch: string|null,
     *     default: bool,
     *     archived: bool,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/get-warehouse
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/warehouses/' . rawurlencode($id), [], $options);
    }

    /**
     * Ver las existencias de un almacén
     *
     * Lo que hay de cada producto en el almacén, el producto más reciente primero. Solo los que
     * tienen existencias, salvo con include_empty=true (todos los que llevan track_stock).
     *
     * GET /v1/warehouses/{id}/stock
     *
     * @param string $id
     * @param array{limit?: int, starting_after?: string, include_empty?: bool} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'stock_level', product: string, warehouse: string, on_hand: float|int, reserved: float|int, available: float|int, value: float|int, average_cost: float|int|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/list-warehouse-stock
     */
    public function stock(string $id, array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/warehouses/' . rawurlencode($id) . '/stock', $params, $options);
    }
}
