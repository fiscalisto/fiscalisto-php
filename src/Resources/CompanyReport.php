<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->companyReport.
 */
final class CompanyReport
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver el reporte de la empresa
     *
     * Como Impuestos y SAT › Reporte de la empresa en la app: la salud fiscal del emisor en una
     * calificación de 0 a 1,000 con la razón de cada factor, los indicadores de riesgo contra su
     * umbral, los años lado a lado (ingresos, gastos, PUE y PPD, días de cobro y pago, margen),
     * sus principales clientes y proveedores con su concentración (HHI), sus socios por los CFDI
     * de retenciones por dividendos y los clientes y proveedores que publicaron su liquidación o
     * fusión. Sale de lo que Fiscalisto ya tiene: no consulta al SAT y no usa timbres. Sin fechas,
     * los últimos 12 meses.
     *
     * GET /v1/company_report
     *
     * @param array{
     *     issuer?: string,
     *     date_gte?: string,
     *     date_lte?: string,
     *     version?: 'full'|'executive',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'company_report',
     *     livemode: bool,
     *     issuer: string,
     *     tax_id: string,
     *     name: string|null,
     *     date_gte: string,
     *     date_lte: string,
     *     version: 'full'|'executive',
     *     fiscal_health: array{score: int|null, band: 'attention'|'fair'|'good'|'excellent'|null, factors_used: int, factors_total: int, factors: list<array<string, mixed>>},
     *     indicators: list<array{key: string, label: string, state: 'ok'|'risk'|'no_data', value: float|int|null, display: string, threshold: float|int|null, custom_threshold: bool}>,
     *     years: list<array{year: int, partial: bool, income: float|int, income_cancelled: float|int, cash_share: float|int|null, credit_share: float|int|null, collected_share: float|int|null, days_to_collect: float|int|null, expenses: float|int, expenses_cancelled: float|int, paid_share: float|int|null, days_to_pay: float|int|null, payroll_paid: float|int, payroll_received: float|int, payroll_received_net: float|int, profit: float|int, margin: float|int|null}>,
     *     totals: array{income: float|int, expenses: float|int, receivable: float|int, payable: float|int},
     *     customers: array{count: int, hhi: float|int|null, top10_share: float|int|null, parties: list<array<string, mixed>>},
     *     suppliers: array{count: int, hhi: float|int|null, top10_share: float|int|null, parties: list<array<string, mixed>>},
     *     shareholders: array{paid_to: list<array<string, mixed>>, received_from: list<array<string, mixed>>}|null,
     *     counterparty_notices: list<array{tax_id: string, name: string|null, side: 'customer'|'supplier', type: string, group: string|null, date: string, number: string, pdf_url: string|null}>|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-company-report
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/company_report', ['query' => $params], $options);
    }
}
