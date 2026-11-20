<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->bookDepreciationRates.
 */
final class BookDepreciationRates
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Fijar la tasa de depreciación contable
     *
     * Fija la tasa anual y el valor residual con que los libros deprecian un activo (fixed_asset)
     * o todos los de un tipo (cfdi_use) desde from_month en adelante (NIF C-6); la del activo gana
     * sobre la de su tipo. Los meses anteriores no cambian, y la deducción fiscal sigue con la
     * tasa del artículo 34. annual_rate null quita la de ese mes. Un mes cerrado contesta
     * parameter_invalid en from_month.
     *
     * POST /v1/accounting/book_depreciation_rates
     *
     * @param array{
     *     issuer?: string,
     *     fixed_asset?: string,
     *     cfdi_use?: 'I01'|'I02'|'I03'|'I04'|'I05'|'I06'|'I07'|'I08',
     *     from_month: string,
     *     annual_rate: float|int|null,
     *     residual_rate?: float|int,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'book_depreciation_rate',
     *     livemode: bool,
     *     issuer: string,
     *     fixed_asset: string|null,
     *     cfdi_use: string|null,
     *     from_month: string,
     *     annual_rate: float|int|null,
     *     residual_rate: float|int|null,
     *     removed: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/save-book-depreciation-rate
     */
    public function save(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/book_depreciation_rates', ['body' => $params, 'idempotent' => true], $options);
    }
}
