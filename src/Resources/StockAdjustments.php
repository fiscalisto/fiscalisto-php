<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Inventario: $fiscalisto->stockAdjustments.
 */
final class StockAdjustments
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ajustar existencias
     *
     * Mete o saca existencias de un almacén con su motivo: el inventario inicial, una merma, un
     * robo, un sobrante. Las entradas valen su unit_cost (o el costo promedio), las salidas el
     * costo del emisor (promedio o PEPS). Los productos deben llevar track_stock: true. Se aplica
     * al momento (status applied).
     *
     * POST /v1/stock_adjustments
     *
     * @param array{
     *     issuer?: string,
     *     warehouse?: string,
     *     reason: 'shrinkage'|'theft'|'damage'|'expiration'|'internal_use'|'gift'|'initial'|'surplus'|'count'|'other',
     *     note?: string|null,
     *     lines: list<array{product: string, quantity: float|int, unit_cost?: float|int, lot?: string, expires_on?: string}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'stock_adjustment',
     *     issuer: string,
     *     warehouse: string,
     *     reason: 'shrinkage'|'theft'|'damage'|'expiration'|'internal_use'|'gift'|'initial'|'surplus'|'count'|'other',
     *     note: string|null,
     *     status: 'applied'|'pending'|'rejected'|'reversed',
     *     value: float|int,
     *     lines: list<array{product: string, quantity: float|int, unit_cost: float|int|null, lot: string|null}>,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/create-stock-adjustment
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/stock_adjustments', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar ajustes
     *
     * Los ajustes del emisor, los más recientes primero.
     *
     * GET /v1/stock_adjustments
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     warehouse?: string,
     *     status?: 'applied'|'pending'|'rejected'|'reversed',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'stock_adjustment', issuer: string, warehouse: string, reason: 'shrinkage'|'theft'|'damage'|'expiration'|'internal_use'|'gift'|'initial'|'surplus'|'count'|'other', note: string|null, status: 'applied'|'pending'|'rejected'|'reversed', value: float|int, lines: list<array<string, mixed>>, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/list-stock-adjustments
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/stock_adjustments', $params, $options);
    }

    /**
     * Ver un ajuste
     *
     * Un ajuste de existencias, con sus líneas.
     *
     * GET /v1/stock_adjustments/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'stock_adjustment',
     *     issuer: string,
     *     warehouse: string,
     *     reason: 'shrinkage'|'theft'|'damage'|'expiration'|'internal_use'|'gift'|'initial'|'surplus'|'count'|'other',
     *     note: string|null,
     *     status: 'applied'|'pending'|'rejected'|'reversed',
     *     value: float|int,
     *     lines: list<array{product: string, quantity: float|int, unit_cost: float|int|null, lot: string|null}>,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/get-stock-adjustment
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/stock_adjustments/' . rawurlencode($id), [], $options);
    }
}
