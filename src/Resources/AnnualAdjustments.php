<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->annualAdjustments.
 */
final class AnnualAdjustments
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ajuste anual del ISR
     *
     * El ISR del ejercicio de cada empleado (tarifa del artículo 152 sobre lo gravado de sus
     * recibos timbrados del año, menos el subsidio para el empleo del año) contra lo que le
     * retuvieron (artículo 97 de la Ley del ISR). balance positivo es a cargo del empleado;
     * negativo, a su favor. excluded dice por qué no se le calcula. No cambia nada: aplíquelo con
     * POST /v1/annual_adjustments.
     *
     * GET /v1/annual_adjustments
     *
     * @param array{issuer?: string, year: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'annual_adjustment',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     applies_from: string,
     *     last_payment_date: string|null,
     *     employees: list<array{employee: string, employee_number: string, employee_name: string, income: float|int, taxable_income: float|int, annual_tax: float|int, employment_subsidy: float|int, tax_due: float|int, tax_withheld: float|int, balance: float|int, excluded: 'started'|'left'|'income'|'files_own'|null, files_own_return: bool, missing_months: list<int>, applied_amount: float|int|null, remaining: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-annual-adjustment
     */
    public function get(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/annual_adjustments', ['query' => $params], $options);
    }

    /**
     * Aplicar el ajuste anual
     *
     * action apply: la diferencia de cada empleado va en sus siguientes recibos ordinarios pagados
     * desde el 1 de enero del año siguiente: a cargo como Deducción 101 (hasta su neto; el resto,
     * en el siguiente), a favor como OtroPago 004 con CompensacionSaldosAFavor. Repetirlo no hace
     * nada. undo la quita mientras ningún recibo timbrado la lleve. files_own_return y
     * no_own_return marcan si el empleado presentará su propia declaración anual.
     *
     * POST /v1/annual_adjustments
     *
     * @param array{
     *     issuer?: string,
     *     year: int,
     *     action: 'apply'|'undo'|'files_own_return'|'no_own_return',
     *     employees: list<string>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'annual_adjustment',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     applies_from: string,
     *     last_payment_date: string|null,
     *     employees: list<array{employee: string, employee_number: string, employee_name: string, income: float|int, taxable_income: float|int, annual_tax: float|int, employment_subsidy: float|int, tax_due: float|int, tax_withheld: float|int, balance: float|int, excluded: 'started'|'left'|'income'|'files_own'|null, files_own_return: bool, missing_months: list<int>, applied_amount: float|int|null, remaining: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-annual-adjustment
     */
    public function update(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/annual_adjustments', ['body' => $params, 'idempotent' => true], $options);
    }
}
