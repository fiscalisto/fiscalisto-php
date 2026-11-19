<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->costOfSales.
 */
final class CostOfSales
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver el costo de ventas de un mes
     *
     * Las compras netas del mes según sus pólizas, el inventario en libros, lo que vale el
     * inventario según Inventario y la póliza de costo de ventas, si ya se registró. Como Cierre
     * del mes › Inventario y costo de ventas en la app.
     *
     * GET /v1/accounting/cost_of_sales/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cost_of_sales',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     purchases: list<array{account: string, amount: float|int}>,
     *     purchase_returns: list<array{account: string, amount: float|int}>,
     *     net_purchases: float|int,
     *     book_inventory: float|int,
     *     suggested_ending_inventory: float|int|null,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-cost-of-sales
     */
    public function get(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/cost_of_sales/' . rawurlencode($month), ['query' => $params], $options);
    }

    /**
     * Registrar el costo de ventas de un mes
     *
     * Registra (o reemplaza) la póliza del último día del mes en el sistema de inventarios
     * periódico: Inventario queda en ending_inventory, las compras (502) y sus devoluciones (503)
     * se cancelan y la diferencia va a Costo de ventas (501.01): inventario inicial + compras
     * netas − inventario final, el costo de lo vendido que se deduce (LISR arts. 25-II y 39). Sin
     * compras ni cambio de inventario contesta parameter_invalid en month; en un mes cerrado,
     * period_closed.
     *
     * POST /v1/accounting/cost_of_sales/{month}
     *
     * @param string $month
     * @param array{issuer?: string, ending_inventory: float|int} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cost_of_sales',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     purchases: list<array{account: string, amount: float|int}>,
     *     purchase_returns: list<array{account: string, amount: float|int}>,
     *     net_purchases: float|int,
     *     book_inventory: float|int,
     *     suggested_ending_inventory: float|int|null,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-cost-of-sales
     */
    public function create(string $month, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/cost_of_sales/' . rawurlencode($month), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar el costo de ventas de un mes
     *
     * Quita la póliza de costo de ventas del mes. En un mes cerrado contesta period_closed.
     *
     * DELETE /v1/accounting/cost_of_sales/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cost_of_sales',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     purchases: list<array{account: string, amount: float|int}>,
     *     purchase_returns: list<array{account: string, amount: float|int}>,
     *     net_purchases: float|int,
     *     book_inventory: float|int,
     *     suggested_ending_inventory: float|int|null,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/delete-cost-of-sales
     */
    public function delete(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/cost_of_sales/' . rawurlencode($month), ['query' => $params], $options);
    }
}
