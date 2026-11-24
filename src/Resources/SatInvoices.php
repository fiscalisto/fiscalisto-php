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
     *     tag?: string,
     *     cash_confirmation?: 'pending'|'confirmed',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'sat_invoice', issuer: string, uuid: string, direction: 'received'|'issued', type: 'I'|'E'|'P'|'T'|'N'|null, date: string, series: string|null, folio: string|null, issued_by: array<string, mixed>, issued_to: array<string, mixed>, currency: string|null, exchange_rate: float|int|null, payment_method: string|null, payment_form: string|null, use: string|null, subtotal: float|int|null, total: float|int|null, taxes: array<string, mixed>, sat_status: 'active'|'canceled'|null, paid_otherwise: array<string, mixed>|null, cash_confirmation: 'pending'|'confirmed'|null, cash_confirmed_at: string|null, cost_center: string|null, account: string|null, tags: list<array<string, mixed>>, sat_download: string|null, downloaded_at: string|null}>
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
     *     paid_otherwise: array{without_complement: bool, paid_on: string|null, payment_form: string|null, money_source: 'petty_cash'|'reimbursement'|'bank'|'other'|null, by_rule: bool}|null,
     *     cash_confirmation: 'pending'|'confirmed'|null,
     *     cash_confirmed_at: string|null,
     *     cost_center: string|null,
     *     account: string|null,
     *     tags: list<array{id: string, name: string, color: string, automatic: bool}>,
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
     * null para quitárselo), para ver sus gastos por obra, proyecto o área, y sus etiquetas (tags,
     * exactamente las que manda: ids tag_… o nombres; un nombre nuevo crea la etiqueta).
     *
     * POST /v1/sat_invoices/{id}
     *
     * @param string $id
     * @param array{cost_center?: string|null, tags?: list<string>, account?: string|null} $params
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
     *     paid_otherwise: array{without_complement: bool, paid_on: string|null, payment_form: string|null, money_source: 'petty_cash'|'reimbursement'|'bank'|'other'|null, by_rule: bool}|null,
     *     cash_confirmation: 'pending'|'confirmed'|null,
     *     cash_confirmed_at: string|null,
     *     cost_center: string|null,
     *     account: string|null,
     *     tags: list<array{id: string, name: string, color: string, automatic: bool}>,
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
     * Marcar como pagada una factura recibida
     *
     * Una factura PPD recibida que la empresa pagó (en efectivo, de caja chica, con un reembolso…)
     * y cuyo proveedor no emitió el complemento de pago: sale de Por pagar como pagada sin
     * complemento, con cuándo, cómo y de dónde se pagó. El SAT la sigue viendo sin pagar: el IVA
     * no se acredita ni el gasto se deduce hasta que llegue el complemento. En una PUE recibida,
     * que ya está pagada, solo anota de dónde salió el dinero (money_source). Lo marcado se ve en
     * paid_otherwise.
     *
     * POST /v1/sat_invoices/{id}/mark_paid
     *
     * @param string $id
     * @param array{
     *     paid_on?: string,
     *     payment_form?: '12'|'13'|'14'|'15'|'17'|'23'|'24'|'25'|'26'|'27'|'28'|'29'|'30'|'31'|'01'|'02'|'03'|'04'|'05'|'06'|'08',
     *     money_source?: 'petty_cash'|'reimbursement'|'bank'|'other',
     *     note?: string,
     * } $params
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
     *     paid_otherwise: array{without_complement: bool, paid_on: string|null, payment_form: string|null, money_source: 'petty_cash'|'reimbursement'|'bank'|'other'|null, by_rule: bool}|null,
     *     cash_confirmation: 'pending'|'confirmed'|null,
     *     cash_confirmed_at: string|null,
     *     cost_center: string|null,
     *     account: string|null,
     *     tags: list<array{id: string, name: string, color: string, automatic: bool}>,
     *     sat_download: string|null,
     *     downloaded_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/mark-sat-invoice-paid
     */
    public function markPaid(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_invoices/' . rawurlencode($id) . '/mark_paid', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar la marca de pagada
     *
     * Deshace mark_paid (o lo que marcó una regla de Pagos sin complemento): una PPD vuelve a Por
     * pagar y una PUE pierde su origen del dinero. Una regla ya no la vuelve a marcar.
     *
     * POST /v1/sat_invoices/{id}/mark_unpaid
     *
     * @param string $id
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
     *     paid_otherwise: array{without_complement: bool, paid_on: string|null, payment_form: string|null, money_source: 'petty_cash'|'reimbursement'|'bank'|'other'|null, by_rule: bool}|null,
     *     cash_confirmation: 'pending'|'confirmed'|null,
     *     cash_confirmed_at: string|null,
     *     cost_center: string|null,
     *     account: string|null,
     *     tags: list<array{id: string, name: string, color: string, automatic: bool}>,
     *     sat_download: string|null,
     *     downloaded_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/mark-sat-invoice-unpaid
     */
    public function markUnpaid(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_invoices/' . rawurlencode($id) . '/mark_unpaid', ['idempotent' => true], $options);
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
