<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->depreciationReconciliations.
 */
final class DepreciationReconciliations
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Comparar la depreciación contable con la fiscal
     *
     * La depreciación contable del año de cada activo fijo contra su deducción fiscal (artículo 34
     * de la Ley del ISR, actualizada con el INPC del artículo 31) y la diferencia, que es partida
     * de la conciliación contable-fiscal de la declaración anual. Las notas de crédito sobre un
     * activo van en su propio renglón. Como Activos fijos › Contable contra fiscal en la app.
     *
     * GET /v1/accounting/depreciation_reconciliations/{year}
     *
     * @param string $year
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'depreciation_reconciliation',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     items: list<array{fixed_asset: string|null, description: string, cfdi_use: string|null, book_depreciation: float|int, tax_deduction: float|int, inflation_factor: float|int, difference: float|int}>,
     *     book_depreciation: float|int,
     *     tax_deduction: float|int,
     *     difference: float|int,
     *     inpc_estimated_months: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-depreciation-reconciliation
     */
    public function get(string $year, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/depreciation_reconciliations/' . rawurlencode($year), ['query' => $params], $options);
    }
}
