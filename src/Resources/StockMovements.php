<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Inventario: $fiscalisto->stockMovements.
 */
final class StockMovements
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar movimientos (kárdex)
     *
     * Cada entrada y salida de existencias, la más reciente primero: ventas (de sus facturas),
     * compras, ajustes, traspasos y lo que deshizo una cancelación.
     *
     * GET /v1/stock_movements
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     product?: string,
     *     warehouse?: string,
     *     type?: 'sale'|'purchase'|'customer_return'|'supplier_return'|'adjustment'|'count'|'transfer_out'|'transfer_in'|'initial'|'cost'|'reversal',
     *     date_gte?: string,
     *     date_lte?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'stock_movement', issuer: string, product: string, warehouse: string, type: 'sale'|'purchase'|'customer_return'|'supplier_return'|'adjustment'|'count'|'transfer_out'|'transfer_in'|'initial'|'cost'|'reversal', quantity: float|int, unit_cost: float|int, value: float|int, lot: string|null, source: array<string, mixed>, reason: string|null, date: string|null, reversed: bool, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/list-stock-movements
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/stock_movements', $params, $options);
    }

    /**
     * Ver un movimiento
     *
     * Una entrada o salida de existencias, con lo que la causó (source).
     *
     * GET /v1/stock_movements/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'stock_movement',
     *     issuer: string,
     *     product: string,
     *     warehouse: string,
     *     type: 'sale'|'purchase'|'customer_return'|'supplier_return'|'adjustment'|'count'|'transfer_out'|'transfer_in'|'initial'|'cost'|'reversal',
     *     quantity: float|int,
     *     unit_cost: float|int,
     *     value: float|int,
     *     lot: string|null,
     *     source: array{type: string, id: string},
     *     reason: string|null,
     *     date: string|null,
     *     reversed: bool,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/get-stock-movement
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/stock_movements/' . rawurlencode($id), [], $options);
    }
}
