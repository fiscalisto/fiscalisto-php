<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Inventario: $fiscalisto->productionOrders.
 */
final class ProductionOrders
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear una orden de producción
     *
     * Una orden en borrador (status draft) para producir quantity de un producto con receta: sus
     * components salen de la receta (la hoja de costo de Compras › Costos y márgenes) con su merma
     * y rendimiento, y sus other_costs se escalan a la cantidad. Nada se mueve hasta iniciarla.
     * Enciende Producción en el inventario si estaba apagada. Un producto sin receta: 400
     * inventory_refused.
     *
     * POST /v1/production_orders
     *
     * @param array{
     *     issuer?: string,
     *     product: string,
     *     quantity: float|int,
     *     warehouse?: string,
     *     destination_warehouse?: string,
     *     due_date?: string|null,
     *     note?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'production_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'in_process'|'completed'|'cancelled',
     *     product: string,
     *     quantity: float|int,
     *     quantity_made: float|int|null,
     *     warehouse: string,
     *     destination_warehouse: string,
     *     lot: string|null,
     *     due_date: string|null,
     *     note: string|null,
     *     components: list<array{product: string, quantity: float|int, quantity_used: float|int|null, tracks_stock: bool, value: float|int|null}>,
     *     other_costs: list<array{description: string, amount: float|int}>,
     *     materials_cost: float|int|null,
     *     unit_cost: float|int|null,
     *     created_at: string|null,
     *     started_at: string|null,
     *     completed_at: string|null,
     *     cancelled_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/create-production-order
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/production_orders', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar órdenes de producción
     *
     * Las órdenes del emisor, las más recientes primero.
     *
     * GET /v1/production_orders
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     product?: string,
     *     status?: 'draft'|'in_process'|'completed'|'cancelled',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'production_order', issuer: string, number: string, status: 'draft'|'in_process'|'completed'|'cancelled', product: string, quantity: float|int, quantity_made: float|int|null, warehouse: string, destination_warehouse: string, lot: string|null, due_date: string|null, note: string|null, components: list<array<string, mixed>>, other_costs: list<array<string, mixed>>, materials_cost: float|int|null, unit_cost: float|int|null, created_at: string|null, started_at: string|null, completed_at: string|null, cancelled_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/list-production-orders
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/production_orders', $params, $options);
    }

    /**
     * Ver una orden de producción
     *
     * Una orden con sus componentes, sus otros costos y, al terminar, su costo por unidad.
     *
     * GET /v1/production_orders/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'production_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'in_process'|'completed'|'cancelled',
     *     product: string,
     *     quantity: float|int,
     *     quantity_made: float|int|null,
     *     warehouse: string,
     *     destination_warehouse: string,
     *     lot: string|null,
     *     due_date: string|null,
     *     note: string|null,
     *     components: list<array{product: string, quantity: float|int, quantity_used: float|int|null, tracks_stock: bool, value: float|int|null}>,
     *     other_costs: list<array{description: string, amount: float|int}>,
     *     materials_cost: float|int|null,
     *     unit_cost: float|int|null,
     *     created_at: string|null,
     *     started_at: string|null,
     *     completed_at: string|null,
     *     cancelled_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/get-production-order
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/production_orders/' . rawurlencode($id), [], $options);
    }

    /**
     * Iniciar una orden de producción
     *
     * Los componentes salen del almacén (status in_process), cada lote el que caduca primero, al
     * costo del emisor (promedio o PEPS). Mande components para lo que de verdad se usó de alguno.
     * Con existencias negativas en «No permitir», uno que no alcanza: 400 inventory_refused.
     *
     * POST /v1/production_orders/{id}/start
     *
     * @param string $id
     * @param array{components?: list<array{product: string, quantity_used: float|int}>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'production_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'in_process'|'completed'|'cancelled',
     *     product: string,
     *     quantity: float|int,
     *     quantity_made: float|int|null,
     *     warehouse: string,
     *     destination_warehouse: string,
     *     lot: string|null,
     *     due_date: string|null,
     *     note: string|null,
     *     components: list<array{product: string, quantity: float|int, quantity_used: float|int|null, tracks_stock: bool, value: float|int|null}>,
     *     other_costs: list<array{description: string, amount: float|int}>,
     *     materials_cost: float|int|null,
     *     unit_cost: float|int|null,
     *     created_at: string|null,
     *     started_at: string|null,
     *     completed_at: string|null,
     *     cancelled_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/start-production-order
     */
    public function start(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/production_orders/' . rawurlencode($id) . '/start', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Terminar una orden de producción
     *
     * Lo producido entra al almacén destino a su costo real: (materials_cost + other_costs) ÷
     * quantity_made (status completed). Una en borrador se inicia antes con lo planeado.
     *
     * POST /v1/production_orders/{id}/complete
     *
     * @param string $id
     * @param array{
     *     quantity_made?: float|int,
     *     lot?: string,
     *     expires_on?: string,
     *     other_costs?: list<array{description: string, amount: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'production_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'in_process'|'completed'|'cancelled',
     *     product: string,
     *     quantity: float|int,
     *     quantity_made: float|int|null,
     *     warehouse: string,
     *     destination_warehouse: string,
     *     lot: string|null,
     *     due_date: string|null,
     *     note: string|null,
     *     components: list<array{product: string, quantity: float|int, quantity_used: float|int|null, tracks_stock: bool, value: float|int|null}>,
     *     other_costs: list<array{description: string, amount: float|int}>,
     *     materials_cost: float|int|null,
     *     unit_cost: float|int|null,
     *     created_at: string|null,
     *     started_at: string|null,
     *     completed_at: string|null,
     *     cancelled_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/complete-production-order
     */
    public function complete(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/production_orders/' . rawurlencode($id) . '/complete', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cancelar una orden de producción
     *
     * Los componentes regresan a su almacén y lo producido sale (status cancelled). Una ya
     * cancelada: 400 inventory_refused.
     *
     * POST /v1/production_orders/{id}/cancel
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'production_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'in_process'|'completed'|'cancelled',
     *     product: string,
     *     quantity: float|int,
     *     quantity_made: float|int|null,
     *     warehouse: string,
     *     destination_warehouse: string,
     *     lot: string|null,
     *     due_date: string|null,
     *     note: string|null,
     *     components: list<array{product: string, quantity: float|int, quantity_used: float|int|null, tracks_stock: bool, value: float|int|null}>,
     *     other_costs: list<array{description: string, amount: float|int}>,
     *     materials_cost: float|int|null,
     *     unit_cost: float|int|null,
     *     created_at: string|null,
     *     started_at: string|null,
     *     completed_at: string|null,
     *     cancelled_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/inventario/cancel-production-order
     */
    public function cancel(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/production_orders/' . rawurlencode($id) . '/cancel', ['idempotent' => true], $options);
    }
}
