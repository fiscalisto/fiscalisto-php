<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->payrollProvisions.
 */
final class PayrollProvisions
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver las cuotas patronales de un mes
     *
     * Lo que la empresa debe al IMSS, al SAR y al Infonavit por los días del mes, calculado de sus
     * recibos de nómina timbrados (su salario base de cotización y sus días, con faltas e
     * incapacidades como dice la Ley del Seguro Social), el impuesto sobre nómina del mes y la
     * póliza de provisión, si ya se registró. Como Cierre del mes › Cuotas patronales del mes en
     * la app. Se calcula con las tasas de 2026; otro año contesta parameter_invalid en month.
     *
     * GET /v1/accounting/payroll_provisions/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_provision',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     employer_risk_premium: float|int,
     *     employer_risk_premium_saved: bool,
     *     calculated: array{imss: float|int, sar: float|int, infonavit: float|int, payroll_tax: float|int},
     *     posted: array{imss: float|int, sar: float|int, infonavit: float|int, payroll_tax: float|int}|null,
     *     employees: list<array{employee: string|null, name: string, sbc: float|int, days_health: float|int, days_disability_life: float|int, days_retirement: float|int, minimum_wage: bool, imss: float|int, sar: float|int, infonavit: float|int}>,
     *     payroll_tax_states: list<array{state: string, base: float|int, amount: float|int}>,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-payroll-provision
     */
    public function get(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/payroll_provisions/' . rawurlencode($month), ['query' => $params], $options);
    }

    /**
     * Registrar las cuotas patronales de un mes
     *
     * Registra (o reemplaza) la provisión del último día del mes: Cuotas patronales al IMSS
     * (601.26), Aportaciones patronales al Infonavit (601.27), al SAR (601.28) e Impuesto sobre
     * nómina (601.29) contra IMSS, SAR e Infonavit por pagar (211.01 a 211.03) e Impuesto sobre
     * nómina por pagar (213.04). Los importes que mande reemplazan los calculados;
     * employer_risk_premium se guarda para los meses siguientes. Al pagarlos, registre el retiro
     * del banco contra esas cuentas. Sin recibos ni importes contesta parameter_invalid en month;
     * en un mes cerrado, period_closed.
     *
     * POST /v1/accounting/payroll_provisions/{month}
     *
     * @param string $month
     * @param array{
     *     issuer?: string,
     *     employer_risk_premium?: float|int,
     *     imss?: float|int,
     *     sar?: float|int,
     *     infonavit?: float|int,
     *     payroll_tax?: float|int,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_provision',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     employer_risk_premium: float|int,
     *     employer_risk_premium_saved: bool,
     *     calculated: array{imss: float|int, sar: float|int, infonavit: float|int, payroll_tax: float|int},
     *     posted: array{imss: float|int, sar: float|int, infonavit: float|int, payroll_tax: float|int}|null,
     *     employees: list<array{employee: string|null, name: string, sbc: float|int, days_health: float|int, days_disability_life: float|int, days_retirement: float|int, minimum_wage: bool, imss: float|int, sar: float|int, infonavit: float|int}>,
     *     payroll_tax_states: list<array{state: string, base: float|int, amount: float|int}>,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-payroll-provision
     */
    public function create(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/payroll_provisions/' . rawurlencode($month), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar las cuotas patronales de un mes
     *
     * Quita la póliza de provisión del mes. En un mes cerrado contesta period_closed.
     *
     * DELETE /v1/accounting/payroll_provisions/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_provision',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     employer_risk_premium: float|int,
     *     employer_risk_premium_saved: bool,
     *     calculated: array{imss: float|int, sar: float|int, infonavit: float|int, payroll_tax: float|int},
     *     posted: array{imss: float|int, sar: float|int, infonavit: float|int, payroll_tax: float|int}|null,
     *     employees: list<array{employee: string|null, name: string, sbc: float|int, days_health: float|int, days_disability_life: float|int, days_retirement: float|int, minimum_wage: bool, imss: float|int, sar: float|int, infonavit: float|int}>,
     *     payroll_tax_states: list<array{state: string, base: float|int, amount: float|int}>,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/delete-payroll-provision
     */
    public function delete(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/payroll_provisions/' . rawurlencode($month), ['query' => $params], $options);
    }
}
