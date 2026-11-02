<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Tickets de compra: $fiscalisto->purchaseReceipts.
 */
final class PurchaseReceipts
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Guardar un ticket de compra
     *
     * La foto o el PDF de un ticket que el emisor pagó sin factura, en base64, con los datos que
     * usted tenga: la tienda, su RFC, la fecha, el total, la forma de pago, el folio, los datos
     * que pide su portal y la liga de facturación. Si qr_text es la liga de una tienda que factura
     * con Fiscalisto, el folio y el total se llenan solos. El mismo archivo dos veces devuelve el
     * ticket que ya estaba. Si llega una factura de esa tienda por el mismo total con las
     * descargas del SAT, el ticket queda invoiced solo.
     *
     * POST /v1/purchase_receipts
     *
     * @param array{
     *     issuer?: string,
     *     file: string,
     *     file_type: 'image/jpeg'|'image/png'|'image/webp'|'application/pdf',
     *     qr_text?: string,
     *     store_name?: string|null,
     *     store_tax_id?: string|null,
     *     date?: string|null,
     *     total?: float|int|null,
     *     payment_method?: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio?: string|null,
     *     fields?: list<array{label: string, value: string}>,
     *     portal_url?: string|null,
     *     store_email?: string|null,
     *     use?: string|null,
     *     note?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'purchase_receipt',
     *     issuer: string,
     *     status: 'pending'|'requested'|'invoiced'|'non_deductible',
     *     store: array{name: string|null, tax_id: string|null, email: string|null, portal_url: string|null, on_fiscalisto: bool},
     *     date: string|null,
     *     total: float|int|null,
     *     payment_method: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio: string|null,
     *     fields: list<array{label: string, value: string}>,
     *     use: string|null,
     *     note: string|null,
     *     file_type: string|null,
     *     cash_over_limit: bool,
     *     days_left_in_month: int|null,
     *     requested: array{method: string|null, to: string|null, at: string|null}|null,
     *     invoice_uuid: string|null,
     *     invoice: string|null,
     *     invoiced_at: string|null,
     *     non_deductible_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/create-purchase-receipt
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/purchase_receipts', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar tickets de compra
     *
     * Los más recientes primero.
     *
     * GET /v1/purchase_receipts
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'pending'|'requested'|'invoiced'|'non_deductible',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'purchase_receipt', issuer: string, status: 'pending'|'requested'|'invoiced'|'non_deductible', store: array<string, mixed>, date: string|null, total: float|int|null, payment_method: 'efectivo'|'tarjeta'|'otro'|null, folio: string|null, fields: list<array<string, mixed>>, use: string|null, note: string|null, file_type: string|null, cash_over_limit: bool, days_left_in_month: int|null, requested: array<string, mixed>|null, invoice_uuid: string|null, invoice: string|null, invoiced_at: string|null, non_deductible_at: string|null, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/list-purchase-receipts
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/purchase_receipts', $params, $options);
    }

    /**
     * Ver un ticket de compra
     *
     * Con la factura recibida que lo cubre, si ya llegó.
     *
     * GET /v1/purchase_receipts/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'purchase_receipt',
     *     issuer: string,
     *     status: 'pending'|'requested'|'invoiced'|'non_deductible',
     *     store: array{name: string|null, tax_id: string|null, email: string|null, portal_url: string|null, on_fiscalisto: bool},
     *     date: string|null,
     *     total: float|int|null,
     *     payment_method: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio: string|null,
     *     fields: list<array{label: string, value: string}>,
     *     use: string|null,
     *     note: string|null,
     *     file_type: string|null,
     *     cash_over_limit: bool,
     *     days_left_in_month: int|null,
     *     requested: array{method: string|null, to: string|null, at: string|null}|null,
     *     invoice_uuid: string|null,
     *     invoice: string|null,
     *     invoiced_at: string|null,
     *     non_deductible_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/get-purchase-receipt
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/purchase_receipts/' . rawurlencode($id), [], $options);
    }

    /**
     * Corregir un ticket de compra
     *
     * Corrige o llena sus datos; solo cambia lo que mande (null borra un dato). Con store_tax_id y
     * total corregidos se vuelve a buscar su factura.
     *
     * POST /v1/purchase_receipts/{id}
     *
     * @param string $id
     * @param array{
     *     store_name?: string|null,
     *     store_tax_id?: string|null,
     *     date?: string|null,
     *     total?: float|int|null,
     *     payment_method?: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio?: string|null,
     *     fields?: list<array{label: string, value: string}>,
     *     portal_url?: string|null,
     *     store_email?: string|null,
     *     use?: string|null,
     *     note?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'purchase_receipt',
     *     issuer: string,
     *     status: 'pending'|'requested'|'invoiced'|'non_deductible',
     *     store: array{name: string|null, tax_id: string|null, email: string|null, portal_url: string|null, on_fiscalisto: bool},
     *     date: string|null,
     *     total: float|int|null,
     *     payment_method: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio: string|null,
     *     fields: list<array{label: string, value: string}>,
     *     use: string|null,
     *     note: string|null,
     *     file_type: string|null,
     *     cash_over_limit: bool,
     *     days_left_in_month: int|null,
     *     requested: array{method: string|null, to: string|null, at: string|null}|null,
     *     invoice_uuid: string|null,
     *     invoice: string|null,
     *     invoiced_at: string|null,
     *     non_deductible_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/update-purchase-receipt
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/purchase_receipts/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un ticket de compra
     *
     * El ticket y su archivo, para siempre.
     *
     * DELETE /v1/purchase_receipts/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/delete-purchase-receipt
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/purchase_receipts/' . rawurlencode($id), [], $options);
    }

    /**
     * Pedir la factura a la tienda
     *
     * fiscalisto: la tienda factura con Fiscalisto (store.on_fiscalisto), se timbra al momento con
     * los datos fiscales del emisor y el ticket queda invoiced. email: le manda a la tienda los
     * datos fiscales y la foto; las respuestas van a reply_to. portal o manual: usted la pidió,
     * solo queda requested. Pide el uso de use (G03 por omisión).
     *
     * POST /v1/purchase_receipts/{id}/request
     *
     * @param string $id
     * @param array{
     *     method: 'fiscalisto'|'email'|'portal'|'manual',
     *     to?: string,
     *     message?: string,
     *     reply_to?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'purchase_receipt',
     *     issuer: string,
     *     status: 'pending'|'requested'|'invoiced'|'non_deductible',
     *     store: array{name: string|null, tax_id: string|null, email: string|null, portal_url: string|null, on_fiscalisto: bool},
     *     date: string|null,
     *     total: float|int|null,
     *     payment_method: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio: string|null,
     *     fields: list<array{label: string, value: string}>,
     *     use: string|null,
     *     note: string|null,
     *     file_type: string|null,
     *     cash_over_limit: bool,
     *     days_left_in_month: int|null,
     *     requested: array{method: string|null, to: string|null, at: string|null}|null,
     *     invoice_uuid: string|null,
     *     invoice: string|null,
     *     invoiced_at: string|null,
     *     non_deductible_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/request-purchase-receipt-invoice
     */
    public function requestInvoice(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/purchase_receipts/' . rawurlencode($id) . '/request', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ya llegó la factura
     *
     * Para una factura que llegó por otro lado. Con invoice (sat_… o UUID), la factura recibida
     * que lo cubre; una factura cubre un solo ticket.
     *
     * POST /v1/purchase_receipts/{id}/mark_invoiced
     *
     * @param string $id
     * @param array{invoice?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'purchase_receipt',
     *     issuer: string,
     *     status: 'pending'|'requested'|'invoiced'|'non_deductible',
     *     store: array{name: string|null, tax_id: string|null, email: string|null, portal_url: string|null, on_fiscalisto: bool},
     *     date: string|null,
     *     total: float|int|null,
     *     payment_method: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio: string|null,
     *     fields: list<array{label: string, value: string}>,
     *     use: string|null,
     *     note: string|null,
     *     file_type: string|null,
     *     cash_over_limit: bool,
     *     days_left_in_month: int|null,
     *     requested: array{method: string|null, to: string|null, at: string|null}|null,
     *     invoice_uuid: string|null,
     *     invoice: string|null,
     *     invoiced_at: string|null,
     *     non_deductible_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/mark-purchase-receipt-invoiced
     */
    public function markInvoiced(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/purchase_receipts/' . rawurlencode($id) . '/mark_invoiced', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Marcar como no deducible
     *
     * La tienda no dio factura: el gasto queda como no deducible.
     *
     * POST /v1/purchase_receipts/{id}/mark_non_deductible
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'purchase_receipt',
     *     issuer: string,
     *     status: 'pending'|'requested'|'invoiced'|'non_deductible',
     *     store: array{name: string|null, tax_id: string|null, email: string|null, portal_url: string|null, on_fiscalisto: bool},
     *     date: string|null,
     *     total: float|int|null,
     *     payment_method: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio: string|null,
     *     fields: list<array{label: string, value: string}>,
     *     use: string|null,
     *     note: string|null,
     *     file_type: string|null,
     *     cash_over_limit: bool,
     *     days_left_in_month: int|null,
     *     requested: array{method: string|null, to: string|null, at: string|null}|null,
     *     invoice_uuid: string|null,
     *     invoice: string|null,
     *     invoiced_at: string|null,
     *     non_deductible_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/mark-purchase-receipt-non-deductible
     */
    public function markNonDeductible(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/purchase_receipts/' . rawurlencode($id) . '/mark_non_deductible', ['idempotent' => true], $options);
    }

    /**
     * Volver a pedir la factura
     *
     * Deshace mark_non_deductible o mark_invoiced: vuelve a requested si ya se había pedido, si no
     * a pending.
     *
     * POST /v1/purchase_receipts/{id}/reopen
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'purchase_receipt',
     *     issuer: string,
     *     status: 'pending'|'requested'|'invoiced'|'non_deductible',
     *     store: array{name: string|null, tax_id: string|null, email: string|null, portal_url: string|null, on_fiscalisto: bool},
     *     date: string|null,
     *     total: float|int|null,
     *     payment_method: 'efectivo'|'tarjeta'|'otro'|null,
     *     folio: string|null,
     *     fields: list<array{label: string, value: string}>,
     *     use: string|null,
     *     note: string|null,
     *     file_type: string|null,
     *     cash_over_limit: bool,
     *     days_left_in_month: int|null,
     *     requested: array{method: string|null, to: string|null, at: string|null}|null,
     *     invoice_uuid: string|null,
     *     invoice: string|null,
     *     invoiced_at: string|null,
     *     non_deductible_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tickets-de-compra/reopen-purchase-receipt
     */
    public function reopen(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/purchase_receipts/' . rawurlencode($id) . '/reopen', ['idempotent' => true], $options);
    }
}
