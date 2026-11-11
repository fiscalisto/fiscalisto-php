<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Portal de proveedores: $fiscalisto->supplierInvoices.
 */
final class SupplierInvoices
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar facturas de proveedores
     *
     * Las facturas que mandaron sus proveedores por el portal, las más recientes primero. Para
     * llevar a su ERP lo aprobado: status=approved, o escuche supplier_invoice.approved.
     *
     * GET /v1/supplier_invoices
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'received'|'approved'|'scheduled'|'paid'|'rejected',
     *     supplier?: string,
     *     received_since?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'supplier_invoice', issuer: string, supplier: string, supplier_tax_id: string, uuid: string, sat_invoice: string|null, series: string|null, folio: string|null, type: 'income'|'credit_note', date: string, currency: string, total: float|int, payable: float|int, payment_method: string|null, status: 'received'|'approved'|'scheduled'|'paid'|'rejected', purchase_order: string|null, matches_purchase_order: bool|null, contrarecibo: string|null, due_on: string|null, scheduled_on: string|null, paid_on: string|null, paid_amount: float|int|null, payment_reference: string|null, rejection_reason: string|null, warnings: list<array<string, mixed>>, received_at: string|null, approved_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/portal-de-proveedores/list-supplier-invoices
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/supplier_invoices', $params, $options);
    }

    /**
     * Ver una factura de proveedor
     *
     * Con su estado, su orden de compra, su contrarecibo y sus fechas de pago. Su XML y su PDF:
     * GET /v1/sat_invoices/{sat_invoice}/xml y /pdf.
     *
     * GET /v1/supplier_invoices/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'supplier_invoice',
     *     issuer: string,
     *     supplier: string,
     *     supplier_tax_id: string,
     *     uuid: string,
     *     sat_invoice: string|null,
     *     series: string|null,
     *     folio: string|null,
     *     type: 'income'|'credit_note',
     *     date: string,
     *     currency: string,
     *     total: float|int,
     *     payable: float|int,
     *     payment_method: string|null,
     *     status: 'received'|'approved'|'scheduled'|'paid'|'rejected',
     *     purchase_order: string|null,
     *     matches_purchase_order: bool|null,
     *     contrarecibo: string|null,
     *     due_on: string|null,
     *     scheduled_on: string|null,
     *     paid_on: string|null,
     *     paid_amount: float|int|null,
     *     payment_reference: string|null,
     *     rejection_reason: string|null,
     *     warnings: list<array{code: string, message: string}>,
     *     received_at: string|null,
     *     approved_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/portal-de-proveedores/get-supplier-invoice
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/supplier_invoices/' . rawurlencode($id), [], $options);
    }

    /**
     * Programar el pago de una factura de proveedor
     *
     * El día en que la pagará, como «Programar pago» en la app: el proveedor lo ve en su portal y
     * llega supplier_invoice.scheduled. Solo una aprobada o ya programada; si el SAT la reporta
     * cancelada, 400 supplier_invoice_invalid.
     *
     * POST /v1/supplier_invoices/{id}/schedule
     *
     * @param string $id
     * @param array{pay_on: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'supplier_invoice',
     *     issuer: string,
     *     supplier: string,
     *     supplier_tax_id: string,
     *     uuid: string,
     *     sat_invoice: string|null,
     *     series: string|null,
     *     folio: string|null,
     *     type: 'income'|'credit_note',
     *     date: string,
     *     currency: string,
     *     total: float|int,
     *     payable: float|int,
     *     payment_method: string|null,
     *     status: 'received'|'approved'|'scheduled'|'paid'|'rejected',
     *     purchase_order: string|null,
     *     matches_purchase_order: bool|null,
     *     contrarecibo: string|null,
     *     due_on: string|null,
     *     scheduled_on: string|null,
     *     paid_on: string|null,
     *     paid_amount: float|int|null,
     *     payment_reference: string|null,
     *     rejection_reason: string|null,
     *     warnings: list<array{code: string, message: string}>,
     *     received_at: string|null,
     *     approved_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/portal-de-proveedores/schedule-supplier-invoice
     */
    public function schedule(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/supplier_invoices/' . rawurlencode($id) . '/schedule', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Marcar pagada una factura de proveedor
     *
     * El pago que hizo su ERP o su banco, como «Marcar pagada» en la app: el proveedor lo ve, y si
     * es PPD le pedimos su complemento de pago. Llega supplier_invoice.paid.
     *
     * POST /v1/supplier_invoices/{id}/mark_paid
     *
     * @param string $id
     * @param array{paid_on: string, reference?: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'supplier_invoice',
     *     issuer: string,
     *     supplier: string,
     *     supplier_tax_id: string,
     *     uuid: string,
     *     sat_invoice: string|null,
     *     series: string|null,
     *     folio: string|null,
     *     type: 'income'|'credit_note',
     *     date: string,
     *     currency: string,
     *     total: float|int,
     *     payable: float|int,
     *     payment_method: string|null,
     *     status: 'received'|'approved'|'scheduled'|'paid'|'rejected',
     *     purchase_order: string|null,
     *     matches_purchase_order: bool|null,
     *     contrarecibo: string|null,
     *     due_on: string|null,
     *     scheduled_on: string|null,
     *     paid_on: string|null,
     *     paid_amount: float|int|null,
     *     payment_reference: string|null,
     *     rejection_reason: string|null,
     *     warnings: list<array{code: string, message: string}>,
     *     received_at: string|null,
     *     approved_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/portal-de-proveedores/mark-supplier-invoice-paid
     */
    public function markPaid(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/supplier_invoices/' . rawurlencode($id) . '/mark_paid', ['body' => $params, 'idempotent' => true], $options);
    }
}
