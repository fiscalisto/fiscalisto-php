<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollReports.
 */
final class PayrollReports
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Acumulados de nómina
     *
     * Los acumulados del año de los recibos de nómina timbrados vigentes (ordinarios y
     * extraordinarios, por fecha de pago), como «Nómina › Reportes» de la app: cada percepción,
     * deducción y otro pago por su clave del SAT y la del patrón, mes por mes, y los totales de
     * cada empleado (percepciones gravadas y exentas, ISR e IMSS retenidos, subsidio para el
     * empleo causado y neto). Con employee, solo los de ese empleado.
     *
     * GET /v1/payroll_reports/accumulated
     *
     * @param array{issuer?: string, year?: int, employee?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_accumulated',
     *     livemode: bool,
     *     issuer: string,
     *     year: float|int,
     *     employee: string|null,
     *     receipts: float|int,
     *     concepts: list<array{kind: 'percepcion'|'deduccion'|'otro_pago', type: string, key: string, concept: string, months: list<float|int>, total: float|int, taxed: float|int|null, exempt: float|int|null, receipts: float|int}>,
     *     employees: list<array{employee: string|null, name: string, rfc: string, number: string|null, receipts: float|int, perceptions: float|int, taxed: float|int, exempt: float|int, isr_withheld: float|int, imss_withheld: float|int, other_deductions: float|int, other_payments: float|int, employment_subsidy: float|int, net: float|int}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-payroll-accumulated
     */
    public function accumulated(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payroll_reports/accumulated', ['query' => $params], $options);
    }

    /**
     * Costo de la nómina
     *
     * Lo que cuesta la nómina del año mes por mes: lo pagado a los empleados (percepciones y otros
     * pagos de los recibos timbrados, sin el subsidio para el empleo) más las cuotas del patrón al
     * IMSS, SAR e Infonavit y el impuesto sobre nómina, calculados como GET
     * /v1/accounting/payroll_provisions/{month}. En un año cuyas tasas aún no están cargadas
     * (rates_loaded false), esas columnas y total vienen en null.
     *
     * GET /v1/payroll_reports/cost
     *
     * @param array{issuer?: string, year?: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_cost',
     *     livemode: bool,
     *     issuer: string,
     *     year: float|int,
     *     rates_loaded: bool,
     *     months: list<array{month: string, receipts: float|int, employees: float|int, paid: float|int, imss: float|int|null, sar: float|int|null, infonavit: float|int|null, payroll_tax: float|int|null, total: float|int|null}>,
     *     totals: array{paid: float|int, imss: float|int|null, sar: float|int|null, infonavit: float|int|null, payroll_tax: float|int|null, total: float|int|null},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-payroll-cost
     */
    public function cost(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payroll_reports/cost', ['query' => $params], $options);
    }
}
