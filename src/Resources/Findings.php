<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Hallazgos: $fiscalisto->findings.
 */
final class Findings
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar hallazgos
     *
     * Lo que Fiscalisto encontró en las órdenes de compra, pagos, proveedores, contabilidad,
     * viáticos, tickets de compra, inventario, clientes y nómina del emisor, el más reciente
     * primero: una factura que no coincide con su orden, un proveedor en la lista 69-B, un
     * documento vencido, Caja con saldo acreedor, una comprobación vencida, un ticket sin factura,
     * una existencia negativa, un saldo vencido, un salario diario integrado bajo. Sin status, los
     * que nadie ha revisado. Los de facturas están en GET /v1/sat_findings. No usa timbres.
     *
     * GET /v1/findings
     *
     * @param array{
     *     issuer?: string,
     *     limit?: int,
     *     starting_after?: string,
     *     area?: 'purchase_orders'|'payouts'|'suppliers'|'accounting'|'bank'|'expense_reports'|'purchase_receipts'|'inventory'|'customers'|'payroll',
     *     status?: 'open'|'reviewed'|'resolved'|'all',
     *     severity?: 'critical'|'warning'|'info',
     *     code?: string,
     *     counterparty_tax_id?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'finding', issuer: string, area: 'purchase_orders'|'payouts'|'suppliers'|'accounting'|'bank'|'expense_reports'|'purchase_receipts'|'inventory'|'customers'|'payroll'|null, record: array<string, mixed>, code: string, severity: 'critical'|'warning'|'info', title: string, explanation: string|null, text: string, amount: float|int|null, counterparty_tax_id: string|null, status: 'open'|'reviewed'|'resolved', holds_record: bool, note: string|null, created_at: string|null, updated_at: string|null, reviewed_at: string|null, resolved_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/hallazgos/list-findings
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/findings', $params, $options);
    }

    /**
     * Ver un hallazgo
     *
     * Un hallazgo, con su registro y si lo revisaron.
     *
     * GET /v1/findings/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'finding',
     *     issuer: string,
     *     area: 'purchase_orders'|'payouts'|'suppliers'|'accounting'|'bank'|'expense_reports'|'purchase_receipts'|'inventory'|'customers'|'payroll'|null,
     *     record: array{type: 'purchase_order'|'payout'|'supplier'|'poliza'|'account'|'bank_movement'|'expense_report'|'expense_ticket'|'product'|'customer'|'employee', id: string|null, reference: string, description: string},
     *     code: string,
     *     severity: 'critical'|'warning'|'info',
     *     title: string,
     *     explanation: string|null,
     *     text: string,
     *     amount: float|int|null,
     *     counterparty_tax_id: string|null,
     *     status: 'open'|'reviewed'|'resolved',
     *     holds_record: bool,
     *     note: string|null,
     *     created_at: string|null,
     *     updated_at: string|null,
     *     reviewed_at: string|null,
     *     resolved_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/hallazgos/get-finding
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/findings/' . rawurlencode($id), [], $options);
    }

    /**
     * Marcar un hallazgo como revisado
     *
     * Como «Revisado» en la app: alguien vio el hallazgo y está bien, con una nota opcional de por
     * qué. Si detenía su registro, ya no lo detiene. Uno ya revisado cambia su nota. Uno que ya no
     * aplica contesta finding_resolved. Si lo que lo causó cambia después, vuelve a abrirse solo.
     *
     * POST /v1/findings/{id}/review
     *
     * @param string $id
     * @param array{note?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'finding',
     *     issuer: string,
     *     area: 'purchase_orders'|'payouts'|'suppliers'|'accounting'|'bank'|'expense_reports'|'purchase_receipts'|'inventory'|'customers'|'payroll'|null,
     *     record: array{type: 'purchase_order'|'payout'|'supplier'|'poliza'|'account'|'bank_movement'|'expense_report'|'expense_ticket'|'product'|'customer'|'employee', id: string|null, reference: string, description: string},
     *     code: string,
     *     severity: 'critical'|'warning'|'info',
     *     title: string,
     *     explanation: string|null,
     *     text: string,
     *     amount: float|int|null,
     *     counterparty_tax_id: string|null,
     *     status: 'open'|'reviewed'|'resolved',
     *     holds_record: bool,
     *     note: string|null,
     *     created_at: string|null,
     *     updated_at: string|null,
     *     reviewed_at: string|null,
     *     resolved_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/hallazgos/review-finding
     */
    public function review(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/findings/' . rawurlencode($id) . '/review', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Volver a abrir un hallazgo
     *
     * Como «Deshacer» en la app: un hallazgo revisado vuelve a «Sin revisar», sin su nota, y si su
     * ajuste es detener el registro, lo vuelve a detener.
     *
     * POST /v1/findings/{id}/reopen
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'finding',
     *     issuer: string,
     *     area: 'purchase_orders'|'payouts'|'suppliers'|'accounting'|'bank'|'expense_reports'|'purchase_receipts'|'inventory'|'customers'|'payroll'|null,
     *     record: array{type: 'purchase_order'|'payout'|'supplier'|'poliza'|'account'|'bank_movement'|'expense_report'|'expense_ticket'|'product'|'customer'|'employee', id: string|null, reference: string, description: string},
     *     code: string,
     *     severity: 'critical'|'warning'|'info',
     *     title: string,
     *     explanation: string|null,
     *     text: string,
     *     amount: float|int|null,
     *     counterparty_tax_id: string|null,
     *     status: 'open'|'reviewed'|'resolved',
     *     holds_record: bool,
     *     note: string|null,
     *     created_at: string|null,
     *     updated_at: string|null,
     *     reviewed_at: string|null,
     *     resolved_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/hallazgos/reopen-finding
     */
    public function reopen(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/findings/' . rawurlencode($id) . '/reopen', ['idempotent' => true], $options);
    }
}
