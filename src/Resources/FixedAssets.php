<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->fixedAssets.
 */
final class FixedAssets
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar los activos fijos
     *
     * Los activos fijos del emisor al cierre de un mes: los que llegaron con una factura recibida
     * de uso I01 a I08 (fxc_…) y los capturados sin ella (fxa_…), con su depreciación mensual y
     * acumulada y su valor en libros.
     *
     * GET /v1/accounting/fixed_assets
     *
     * @param array{month?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'fixed_asset', issuer: string, description: string, source: 'cfdi'|'manual', cfdi_use: string, class: string, uuid: string|null, in_use_since: string, cost: float|int, annual_rate: float|int, residual_rate: float|int, tax_annual_rate: float|int, monthly_depreciation: float|int, month: string, month_depreciation: float|int, accumulated_depreciation: float|int, book_value: float|int, disposal: array<string, mixed>|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-fixed-assets
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/fixed_assets', ['query' => $params], $options);
    }

    /**
     * Agregar un activo fijo sin factura
     *
     * Uno que compró antes de usar Fiscalisto o cuya factura no está aquí. Se deprecia cada mes
     * desde el siguiente a in_use_since, en la contabilidad y en el cálculo del ISR. Su costo no
     * entra solo a los libros: va en los saldos iniciales o en una póliza (POST
     * /v1/accounting/manual_entries).
     *
     * POST /v1/accounting/fixed_assets
     *
     * @param array{
     *     issuer?: string,
     *     description: string,
     *     cfdi_use: 'I01'|'I02'|'I03'|'I04'|'I05'|'I06'|'I07'|'I08',
     *     cost: float|int,
     *     acquired_on: string,
     *     in_use_since?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'fixed_asset',
     *     issuer: string,
     *     description: string,
     *     source: 'cfdi'|'manual',
     *     cfdi_use: string,
     *     class: string,
     *     uuid: string|null,
     *     in_use_since: string,
     *     cost: float|int,
     *     annual_rate: float|int,
     *     residual_rate: float|int,
     *     tax_annual_rate: float|int,
     *     monthly_depreciation: float|int,
     *     month: string,
     *     month_depreciation: float|int,
     *     accumulated_depreciation: float|int,
     *     book_value: float|int,
     *     disposal: array{date: string, reason: 'sale'|'write_off', note: string|null}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-fixed-asset
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/fixed_assets', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver un activo fijo
     *
     * Un activo fijo, con sus cifras al cierre del mes actual.
     *
     * GET /v1/accounting/fixed_assets/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'fixed_asset',
     *     issuer: string,
     *     description: string,
     *     source: 'cfdi'|'manual',
     *     cfdi_use: string,
     *     class: string,
     *     uuid: string|null,
     *     in_use_since: string,
     *     cost: float|int,
     *     annual_rate: float|int,
     *     residual_rate: float|int,
     *     tax_annual_rate: float|int,
     *     monthly_depreciation: float|int,
     *     month: string,
     *     month_depreciation: float|int,
     *     accumulated_depreciation: float|int,
     *     book_value: float|int,
     *     disposal: array{date: string, reason: 'sale'|'write_off', note: string|null}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-fixed-asset
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/fixed_assets/' . rawurlencode($id), [], $options);
    }

    /**
     * Borrar un activo fijo capturado
     *
     * Solo uno capturado sin factura (fxa_…); uno con CFDI contesta asset_from_cfdi: véndalo o
     * dele de baja.
     *
     * DELETE /v1/accounting/fixed_assets/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/delete-fixed-asset
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/fixed_assets/' . rawurlencode($id), [], $options);
    }

    /**
     * Vender o dar de baja un activo fijo
     *
     * Deja de depreciarse el mes de date, y ese día una póliza (asset_disposal) cancela el activo
     * y su depreciación acumulada; su valor en libros va a pérdida en venta o baja (703). El
     * ingreso de una venta entra con la factura que emita. Uno ya dado de baja contesta
     * asset_already_disposed.
     *
     * POST /v1/accounting/fixed_assets/{id}/dispose
     *
     * @param string $id
     * @param array{date: string, reason?: 'sale'|'write_off', note?: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'fixed_asset',
     *     issuer: string,
     *     description: string,
     *     source: 'cfdi'|'manual',
     *     cfdi_use: string,
     *     class: string,
     *     uuid: string|null,
     *     in_use_since: string,
     *     cost: float|int,
     *     annual_rate: float|int,
     *     residual_rate: float|int,
     *     tax_annual_rate: float|int,
     *     monthly_depreciation: float|int,
     *     month: string,
     *     month_depreciation: float|int,
     *     accumulated_depreciation: float|int,
     *     book_value: float|int,
     *     disposal: array{date: string, reason: 'sale'|'write_off', note: string|null}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/dispose-fixed-asset
     */
    public function dispose(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/fixed_assets/' . rawurlencode($id) . '/dispose', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Deshacer la baja de un activo fijo
     *
     * El activo vuelve a depreciarse como si nunca se hubiera dado de baja.
     *
     * DELETE /v1/accounting/fixed_assets/{id}/disposal
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'fixed_asset',
     *     issuer: string,
     *     description: string,
     *     source: 'cfdi'|'manual',
     *     cfdi_use: string,
     *     class: string,
     *     uuid: string|null,
     *     in_use_since: string,
     *     cost: float|int,
     *     annual_rate: float|int,
     *     residual_rate: float|int,
     *     tax_annual_rate: float|int,
     *     monthly_depreciation: float|int,
     *     month: string,
     *     month_depreciation: float|int,
     *     accumulated_depreciation: float|int,
     *     book_value: float|int,
     *     disposal: array{date: string, reason: 'sale'|'write_off', note: string|null}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/undispose-fixed-asset
     */
    public function undispose(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/fixed_assets/' . rawurlencode($id) . '/disposal', [], $options);
    }
}
