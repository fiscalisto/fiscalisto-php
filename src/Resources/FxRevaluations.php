<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->fxRevaluations.
 */
final class FxRevaluations
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver la revaluación cambiaria de un mes
     *
     * Las facturas PPD en otra moneda que seguían pendientes al cierre del mes, lo pendiente por
     * moneda con el tipo de cambio de cierre que sugerimos (el FIX del DOF) y la póliza de
     * revaluación, si ya se registró. Como Cierre del mes › Revaluación cambiaria en la app.
     *
     * GET /v1/accounting/fx_revaluations/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'fx_revaluation',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     currencies: list<array{currency: string, receivable: float|int, payable: float|int, closing_rate: float|int|null, closing_rate_date: string|null}>,
     *     documents: list<array{uuid: string, direction: 'issued'|'received', tax_id: string, name: string, series_folio: string|null, date: string, currency: string, balance: float|int, booked_rate: float|int}>,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-fx-revaluation
     */
    public function get(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/fx_revaluations/' . rawurlencode($month), ['query' => $params], $options);
    }

    /**
     * Registrar la revaluación cambiaria de un mes
     *
     * Registra (o reemplaza) la póliza de ajuste del último día del mes que lleva lo pendiente en
     * otra moneda al tipo de cambio de cierre (rates): Clientes contra Utilidad o Pérdida
     * cambiaria, y Proveedores contra Pérdida o Utilidad cambiaria. Se revierte sola el día 1 del
     * mes siguiente, para que cada pago siga calculando su diferencia cambiaria desde el tipo de
     * cambio de la factura. Sin facturas pendientes, o sin diferencia a esos tipos de cambio,
     * contesta parameter_invalid en month; en un mes cerrado, period_closed.
     *
     * POST /v1/accounting/fx_revaluations/{month}
     *
     * @param string $month
     * @param array{issuer?: string, rates: array<string, mixed>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'fx_revaluation',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     currencies: list<array{currency: string, receivable: float|int, payable: float|int, closing_rate: float|int|null, closing_rate_date: string|null}>,
     *     documents: list<array{uuid: string, direction: 'issued'|'received', tax_id: string, name: string, series_folio: string|null, date: string, currency: string, balance: float|int, booked_rate: float|int}>,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-fx-revaluation
     */
    public function create(string $month, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/fx_revaluations/' . rawurlencode($month), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar la revaluación cambiaria de un mes
     *
     * Quita la póliza de revaluación del mes y su reversión. En un mes cerrado contesta
     * period_closed.
     *
     * DELETE /v1/accounting/fx_revaluations/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'fx_revaluation',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     currencies: list<array{currency: string, receivable: float|int, payable: float|int, closing_rate: float|int|null, closing_rate_date: string|null}>,
     *     documents: list<array{uuid: string, direction: 'issued'|'received', tax_id: string, name: string, series_folio: string|null, date: string, currency: string, balance: float|int, booked_rate: float|int}>,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/delete-fx-revaluation
     */
    public function delete(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/fx_revaluations/' . rawurlencode($month), ['query' => $params], $options);
    }
}
