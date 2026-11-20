<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->costCenterResults.
 */
final class CostCenterResults
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver el estado de resultados por centro de costo
     *
     * Lo que cada centro de costo dejó de utilidad en el mes y de enero a ese mes: sus ingresos,
     * costo de ventas, gastos y otros, de las facturas que se le pusieron (POST
     * /v1/cost_centers/{id}/invoices) y de los renglones de póliza a mano que lo llevan
     * (lines[].cost_center). Lo que no tiene centro va con cost_center null; todos suman el estado
     * de resultados de la empresa.
     *
     * GET /v1/accounting/cost_center_results/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cost_center_results',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     month_results: list<array{cost_center: string|null, cost_center_name: string|null, revenue: float|int, cost_of_sales: float|int, operating_expenses: float|int, financing: float|int, other: float|int, income_before_taxes: float|int, margin_percent: float|int|null}>,
     *     year_to_date: list<array{cost_center: string|null, cost_center_name: string|null, revenue: float|int, cost_of_sales: float|int, operating_expenses: float|int, financing: float|int, other: float|int, income_before_taxes: float|int, margin_percent: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-cost-center-results
     */
    public function get(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/cost_center_results/' . rawurlencode($month), ['query' => $params], $options);
    }
}
