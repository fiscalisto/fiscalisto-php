<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->inflationAdjustments.
 */
final class InflationAdjustments
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Calcular el ajuste anual por inflación
     *
     * El ajuste anual por inflación de una persona moral (artículo 44 de la Ley del ISR): la suma
     * de los saldos al último día de cada mes de sus créditos y de sus deudas entre los meses del
     * ejercicio, y la diferencia por el factor de ajuste anual. Deudas mayores dan un ajuste
     * acumulable (taxable); créditos mayores, uno deducible. Cada cuenta cuenta por su código
     * agrupador (con la razón en reason) o como la marcó con POST
     * /v1/accounting/inflation_accounts. En el año en curso es una estimación hasta el mes actual.
     * Como Estados financieros › Ajuste por inflación en la app.
     *
     * GET /v1/accounting/inflation_adjustments/{year}
     *
     * @param string $year
     * @param array{issuer?: string, from_month?: int, through_month?: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'inflation_adjustment',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     from_month: int,
     *     through_month: int,
     *     months: int,
     *     accounts: list<array{account: string, name: string, grouping_code: string, treatment: 'credit'|'debt'|'none', changed: bool, reason: string, month_end_balances: list<float|int>, average_balance: float|int}>,
     *     credits_by_month: list<float|int>,
     *     debts_by_month: list<float|int>,
     *     average_credits: float|int,
     *     average_debts: float|int,
     *     difference: float|int,
     *     factor: float|int|null,
     *     inpc_start: float|int|null,
     *     inpc_end: float|int|null,
     *     inpc_end_month: string|null,
     *     estimated: bool,
     *     type: 'taxable'|'deductible'|null,
     *     amount: float|int|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-inflation-adjustment
     */
    public function get(string $year, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/inflation_adjustments/' . rawurlencode($year), ['query' => $params], $options);
    }
}
