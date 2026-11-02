<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Descargas del SAT: $fiscalisto->satInvoices.
 */
final class SatInvoices
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar facturas del SAT
     *
     * Las facturas que trajeron sus descargas (y las demás que Fiscalisto tenga del emisor), de la
     * más reciente a la más antigua por fecha.
     *
     * GET /v1/sat_invoices
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     direction?: 'received'|'issued',
     *     type?: 'I'|'E'|'P'|'T'|'N',
     *     counterparty_tax_id?: string,
     *     date_gte?: string,
     *     date_lte?: string,
     *     cost_center?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'sat_invoice', issuer: string, uuid: string, direction: 'received'|'issued', type: 'I'|'E'|'P'|'T'|'N'|null, date: string, series: string|null, folio: string|null, issued_by: array<string, mixed>, issued_to: array<string, mixed>, currency: string|null, exchange_rate: float|int|null, payment_method: string|null, payment_form: string|null, use: string|null, subtotal: float|int|null, total: float|int|null, taxes: array<string, mixed>, sat_status: 'active'|'canceled'|null, cost_center: string|null, sat_download: string|null, downloaded_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/list-sat-invoices
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/sat_invoices', $params, $options);
    }

    /**
     * Ver una factura del SAT
     *
     * Un CFDI que trajo una descarga del SAT, con sus importes y su estado ante el SAT.
     *
     * GET /v1/sat_invoices/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_invoice',
     *     issuer: string,
     *     uuid: string,
     *     direction: 'received'|'issued',
     *     type: 'I'|'E'|'P'|'T'|'N'|null,
     *     date: string,
     *     series: string|null,
     *     folio: string|null,
     *     issued_by: array{tax_id: string, legal_name: string|null},
     *     issued_to: array{tax_id: string, legal_name: string|null},
     *     currency: string|null,
     *     exchange_rate: float|int|null,
     *     payment_method: string|null,
     *     payment_form: string|null,
     *     use: string|null,
     *     subtotal: float|int|null,
     *     total: float|int|null,
     *     taxes: array{iva: float|int, ieps: float|int, iva_withheld: float|int, isr_withheld: float|int, ieps_withheld: float|int, local_transferred: float|int, local_withheld: float|int},
     *     sat_status: 'active'|'canceled'|null,
     *     cost_center: string|null,
     *     sat_download: string|null,
     *     downloaded_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/get-sat-invoice
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_invoices/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar una factura del SAT
     *
     * Lo que se puede cambiar de un CFDI del SAT sin tocarlo: su centro de costo (cost_center, o
     * null para quitárselo), para ver sus gastos por obra, proyecto o área.
     *
     * POST /v1/sat_invoices/{id}
     *
     * @param string $id
     * @param array{cost_center?: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_invoice',
     *     issuer: string,
     *     uuid: string,
     *     direction: 'received'|'issued',
     *     type: 'I'|'E'|'P'|'T'|'N'|null,
     *     date: string,
     *     series: string|null,
     *     folio: string|null,
     *     issued_by: array{tax_id: string, legal_name: string|null},
     *     issued_to: array{tax_id: string, legal_name: string|null},
     *     currency: string|null,
     *     exchange_rate: float|int|null,
     *     payment_method: string|null,
     *     payment_form: string|null,
     *     use: string|null,
     *     subtotal: float|int|null,
     *     total: float|int|null,
     *     taxes: array{iva: float|int, ieps: float|int, iva_withheld: float|int, isr_withheld: float|int, ieps_withheld: float|int, local_transferred: float|int, local_withheld: float|int},
     *     sat_status: 'active'|'canceled'|null,
     *     cost_center: string|null,
     *     sat_download: string|null,
     *     downloaded_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/update-sat-invoice
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_invoices/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Descargar el XML de una factura del SAT
     *
     * El CFDI tal como lo entregó el SAT.
     *
     * GET /v1/sat_invoices/{id}/xml
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/get-sat-invoice-xml
     */
    public function xml(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_invoices/' . rawurlencode($id) . '/xml', ['as' => 'text'], $options);
    }

    /**
     * Descargar el PDF de una factura del SAT
     *
     * El CFDI en PDF, como lo ofrece Facturas: si se timbró en Fiscalisto, el mismo que recibió el
     * cliente; si no, dibujado con el diseño de PDF del emisor (el de un proveedor, con su estilo
     * y color, nunca con su logo). El XML es el documento válido ante el SAT.
     *
     * GET /v1/sat_invoices/{id}/pdf
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/get-sat-invoice-pdf
     */
    public function pdf(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_invoices/' . rawurlencode($id) . '/pdf', ['as' => 'bytes'], $options);
    }
}
