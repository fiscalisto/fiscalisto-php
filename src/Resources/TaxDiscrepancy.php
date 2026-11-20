<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->taxDiscrepancy.
 */
final class TaxDiscrepancy
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Calcular la discrepancia fiscal
     *
     * Como «Discrepancia fiscal» (personas físicas, art. 91 LISR): gastos con CFDI a su nombre y
     * depósitos en sus cuentas del año, menos traspasos entre sus cuentas, préstamos y
     * devoluciones, contra los ingresos declarados; lo que queda es lo que el SAT presumiría
     * ingreso. Un emisor persona moral contesta parameter_invalid. No usa timbres.
     *
     * GET /v1/tax_discrepancy
     *
     * @param array{issuer?: string, year?: int, declared_income?: float|int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'tax_discrepancy',
     *     livemode: bool,
     *     issuer: string,
     *     tax_id: string,
     *     year: int,
     *     spending: float|int,
     *     deposits: float|int,
     *     own_transfers: float|int,
     *     loans: float|int,
     *     refunds: float|int,
     *     outflows: float|int,
     *     declared_income: float|int,
     *     declared_income_source: 'tax_returns'|'payroll'|'declared_income'|'none',
     *     discrepancy: float|int,
     *     unclassified_deposits: float|int,
     *     loans_to_report: bool,
     *     bank_statements: bool,
     *     months: list<array{month: string, spending: float|int, deposits: float|int, own_transfers: float|int, loans: float|int, declared_income: float|int}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-tax-discrepancy
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/tax_discrepancy', ['query' => $params], $options);
    }
}
