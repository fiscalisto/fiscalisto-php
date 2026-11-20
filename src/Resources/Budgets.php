<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->budgets.
 */
final class Budgets
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver el presupuesto de un año contra lo real
     *
     * El presupuesto del año por cuenta de resultados y mes, y la comparación con lo real de sus
     * pólizas: el mes y de enero a ese mes, con la variación, su porcentaje y si es favorable
     * (deja más utilidad que lo planeado). Con cost_center, el presupuesto y lo real de ese centro
     * de costo; sin él, de toda la empresa. Como Estados financieros › Presupuesto en la app.
     *
     * GET /v1/accounting/budgets/{year}
     *
     * @param string $year
     * @param array{issuer?: string, cost_center?: string, month?: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'budget',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     month: int,
     *     cost_center: string|null,
     *     lines: list<array{account: string, account_name: string, grouping_code: string, months: list<float|int>, annual: float|int}>,
     *     comparison: list<array{account: string, account_name: string, grouping_code: string, section: 'revenue'|'cost_of_sales'|'operating_expenses'|'financing'|'other', month: array<string, mixed>, year_to_date: array<string, mixed>, annual_budget: float|int}>,
     *     income_before_taxes: array{month: array<string, mixed>, year_to_date: array<string, mixed>, annual_budget: float|int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-budget
     */
    public function get(string $year, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/budgets/' . rawurlencode($year), ['query' => $params], $options);
    }

    /**
     * Guardar el presupuesto de un año
     *
     * Reemplaza el presupuesto del año (de toda la empresa, o del centro de costo de cost_center)
     * con las cuentas que mande: cada una con sus 12 meses en la naturaleza de la cuenta. Solo
     * cuentas de resultados (códigos agrupadores 4 a 7); una cuenta dos veces contesta
     * parameter_invalid en lines. Una lista vacía borra el presupuesto.
     *
     * POST /v1/accounting/budgets/{year}
     *
     * @param string $year
     * @param array{
     *     issuer?: string,
     *     cost_center?: string|null,
     *     lines: list<array{account: string, months: list<float|int>}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'budget',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     month: int,
     *     cost_center: string|null,
     *     lines: list<array{account: string, account_name: string, grouping_code: string, months: list<float|int>, annual: float|int}>,
     *     comparison: list<array{account: string, account_name: string, grouping_code: string, section: 'revenue'|'cost_of_sales'|'operating_expenses'|'financing'|'other', month: array<string, mixed>, year_to_date: array<string, mixed>, annual_budget: float|int}>,
     *     income_before_taxes: array{month: array<string, mixed>, year_to_date: array<string, mixed>, annual_budget: float|int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/save-budget
     */
    public function save(string $year, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/budgets/' . rawurlencode($year), ['body' => $params, 'idempotent' => true], $options);
    }
}
