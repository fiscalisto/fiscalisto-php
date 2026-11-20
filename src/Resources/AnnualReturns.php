<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->annualReturns.
 */
final class AnnualReturns
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Calcular la declaración anual de una persona moral
     *
     * La declaración anual de una persona moral del régimen general (Título II de la Ley del ISR)
     * desde su contabilidad: la conciliación contable-fiscal (items: partidas de los libros, de
     * los CFDI, de la nómina, el ajuste anual por inflación, la deducción de inversiones y las
     * capturadas), ingresos acumulables y deducciones autorizadas, utilidad o pérdida fiscal
     * después de la PTU pagada (artículo 9), las pérdidas de ejercicios anteriores actualizadas y
     * aplicadas (artículo 57), desde 2027 los límites de los artículos 78-A a 78-D, el resultado
     * fiscal, el ISR del ejercicio menos pagos provisionales y retenciones (balance: positivo a
     * cargo, negativo a favor), el coeficiente de utilidad para el año siguiente (artículo 14), la
     * renta gravable de la PTU, la utilidad fiscal neta (artículo 77) y en tax_accounts la CUFIN y
     * la CUCA con lo que cada dividendo o reembolso saca de ellas, el ISR del artículo 10 y el 10%
     * a retener (artículo 140). Es un papel de trabajo para su contador, no la declaración
     * presentada. Un emisor persona física, RESICO o no lucrativo contesta regime_not_applicable.
     * Como Estados financieros › Declaración anual en la app.
     *
     * GET /v1/accounting/annual_returns/{year}
     *
     * @param string $year
     * @param array{issuer?: string, through_month?: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'annual_return',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     through_month: int,
     *     estimated: bool,
     *     book_profit: float|int,
     *     items: list<array{concept: string, type: 'taxable_income'|'non_deductible_expense'|'tax_deduction'|'non_taxable_income', amount: float|int, legal_basis: string, source: 'books'|'cfdi'|'payroll'|'calculation'|'captured', reduces_net_tax_profit: bool}>,
     *     taxable_income: float|int,
     *     nominal_income: float|int,
     *     deductions: float|int,
     *     subject_to_78a: bool,
     *     limit_78b: array{total: float|int, threshold: float|int, fraction: 'I'|'II', limit: float|int, pending_deductions: list<array<string, mixed>>, not_deducted: float|int}|null,
     *     ptu_paid: float|int,
     *     tax_profit: float|int,
     *     tax_loss: float|int,
     *     new_loss: array{year: int, amount: float|int, updated_to: string}|null,
     *     losses: array{applied: float|int, cap: float|int, term_years: int, rows: list<array<string, mixed>>},
     *     tax_result: float|int,
     *     income_tax: float|int,
     *     provisional_payments: float|int,
     *     missing_provisional_months: list<int>,
     *     withheld_tax: float|int,
     *     balance: float|int,
     *     profit_ratio: float|int|null,
     *     ptu: array{taxable_base: float|int, amount: float|int},
     *     dividend_tax_credited: float|int,
     *     net_tax_profit: array{non_deductibles: float|int, dividend_tax_reduction: float|int, amount: float|int},
     *     tax_accounts: array{opening_missing: bool, opening: array<string, mixed>, movements: list<array<string, mixed>>, dividend_tax: float|int, year_end: array<string, mixed>, negative_net_tax_profit_applied: float|int, next_year: array<string, mixed>},
     *     next_year: array{losses: list<array<string, mixed>>, pending_deductions: list<array<string, mixed>>},
     *     captured: array{losses: list<array<string, mixed>>, pending_deductions: list<array<string, mixed>>, items: list<array<string, mixed>>, exception_78e: bool, from_month: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-annual-return
     */
    public function get(string $year, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/annual_returns/' . rawurlencode($year), ['query' => $params], $options);
    }

    /**
     * Capturar lo que los libros no dicen de la declaración anual
     *
     * Reemplaza lo capturado para la declaración anual del año: las pérdidas pendientes por
     * ejercicio (con el mes hasta el que están actualizadas), desde 2027 las deducciones
     * pendientes del artículo 78-B, las partidas de la conciliación (como dividendos de personas
     * morales mexicanas, ingreso no acumulable), si está en una excepción del artículo 78-E, el
     * primer mes del ejercicio y, en tax_accounts, la CUFIN y la CUCA (saldos iniciales,
     * dividendos pagados o recibidos, aportaciones y reembolsos; sin tax_accounts se quedan los
     * guardados). Mande la lista completa: lo que no mande se quita. Una pérdida de este año o
     * posterior, un mes de actualización anterior a su ejercicio o dos del mismo ejercicio
     * contestan parameter_invalid. Contesta la declaración recalculada.
     *
     * POST /v1/accounting/annual_returns/{year}
     *
     * @param string $year
     * @param array{
     *     issuer?: string,
     *     losses: list<array{year: int, amount: float|int, updated_to: string}>,
     *     pending_deductions?: list<array{year: int, amount: float|int, updated_to: string}>,
     *     items?: list<array{concept: string, type: 'taxable_income'|'non_deductible_expense'|'tax_deduction'|'non_taxable_income', amount: float|int, reduces_net_tax_profit?: bool}>,
     *     exception_78e?: bool,
     *     from_month?: int,
     *     tax_accounts?: array{opening: array{cufin: float|int, cufin_2013?: float|int, cuca: float|int, cufin_updated_to: string, cuca_updated_to: string}|null, movements?: list<array{date: string, type: 'dividend_paid'|'dividend_received'|'capital_contribution'|'capital_reduction', amount: float|int, account?: 'cufin'|'cufin_2013', individual?: bool, shares?: float|int, total_shares?: float|int, equity?: float|int}>, pending_dividend_tax?: list<array{year: int, amount: float|int}>},
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'annual_return',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     through_month: int,
     *     estimated: bool,
     *     book_profit: float|int,
     *     items: list<array{concept: string, type: 'taxable_income'|'non_deductible_expense'|'tax_deduction'|'non_taxable_income', amount: float|int, legal_basis: string, source: 'books'|'cfdi'|'payroll'|'calculation'|'captured', reduces_net_tax_profit: bool}>,
     *     taxable_income: float|int,
     *     nominal_income: float|int,
     *     deductions: float|int,
     *     subject_to_78a: bool,
     *     limit_78b: array{total: float|int, threshold: float|int, fraction: 'I'|'II', limit: float|int, pending_deductions: list<array<string, mixed>>, not_deducted: float|int}|null,
     *     ptu_paid: float|int,
     *     tax_profit: float|int,
     *     tax_loss: float|int,
     *     new_loss: array{year: int, amount: float|int, updated_to: string}|null,
     *     losses: array{applied: float|int, cap: float|int, term_years: int, rows: list<array<string, mixed>>},
     *     tax_result: float|int,
     *     income_tax: float|int,
     *     provisional_payments: float|int,
     *     missing_provisional_months: list<int>,
     *     withheld_tax: float|int,
     *     balance: float|int,
     *     profit_ratio: float|int|null,
     *     ptu: array{taxable_base: float|int, amount: float|int},
     *     dividend_tax_credited: float|int,
     *     net_tax_profit: array{non_deductibles: float|int, dividend_tax_reduction: float|int, amount: float|int},
     *     tax_accounts: array{opening_missing: bool, opening: array<string, mixed>, movements: list<array<string, mixed>>, dividend_tax: float|int, year_end: array<string, mixed>, negative_net_tax_profit_applied: float|int, next_year: array<string, mixed>},
     *     next_year: array{losses: list<array<string, mixed>>, pending_deductions: list<array<string, mixed>>},
     *     captured: array{losses: list<array<string, mixed>>, pending_deductions: list<array<string, mixed>>, items: list<array<string, mixed>>, exception_78e: bool, from_month: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/save-annual-return
     */
    public function save(string $year, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/annual_returns/' . rawurlencode($year), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Llevar las pérdidas que quedan al año siguiente
     *
     * Pasa a lo capturado del año siguiente las pérdidas que quedan después de este año (con la de
     * este año, si la hubo, actualizada al último mes del ejercicio) desde 2027 las deducciones
     * pendientes del artículo 78-B, y los saldos de la CUFIN y la CUCA al 31 de diciembre con el
     * ISR de dividendos por acreditar; reemplaza los que tuviera. Si los pagos provisionales del
     * año siguiente no tienen pérdidas en Impuestos, les pone su total (artículo 14, fracción II).
     * Las demás capturas del año siguiente se quedan.
     *
     * POST /v1/accounting/annual_returns/{year}/carry_forward
     *
     * @param string $year
     * @param array{issuer?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'annual_return_carry_forward',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     to_year: int,
     *     losses: list<array{year: int, amount: float|int, updated_to: string}>,
     *     pending_deductions: list<array{year: int, amount: float|int, updated_to: string}>,
     *     total_losses: float|int,
     *     provisional_payments_updated: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/carry-forward-annual-return
     */
    public function carryForward(string $year, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/annual_returns/' . rawurlencode($year) . '/carry_forward', ['body' => $params, 'idempotent' => true], $options);
    }
}
