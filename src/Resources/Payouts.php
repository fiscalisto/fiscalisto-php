<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Pagos a proveedores: $fiscalisto->payouts.
 */
final class Payouts
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Preparar un pago a proveedores
     *
     * Un pago en borrador con estas facturas, revisado como en la app: las reglas antes de pagar,
     * los límites y las cuentas aprobadas de cada proveedor. Las de un proveedor van en una
     * transferencia. Nunca sale solo: alguien del equipo lo abre en app_url y lo firma con su
     * llave de acceso. Solo si la empresa lo permite en Pagos › Configurar pagos (si no, 403
     * payouts_api_disabled); lo que no se puede pagar contesta 400 payout_invalid con el motivo.
     * Pide Idempotency-Key: si la respuesta se pierde, repítala con el mismo valor y contesta el
     * mismo pago, nunca uno nuevo.
     *
     * POST /v1/payouts
     *
     * @param array{
     *     issuer?: string,
     *     pay_on?: string,
     *     note?: string|null,
     *     exchange_rate?: 'official'|'fixed',
     *     invoices: list<array{uuid: string, amount?: float|int, reason?: string|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'payout',
     *     issuer: string,
     *     number: int,
     *     status: 'draft'|'pending_approval'|'approved'|'sending'|'paid'|'partially_paid'|'failed'|'canceled',
     *     pay_on: string,
     *     exchange_rate: 'official'|'fixed'|null,
     *     total: float|int,
     *     currency: 'MXN',
     *     note: string|null,
     *     source: 'app'|'api'|'assistant'|'rule'|'recurring',
     *     payout_mandate: string|null,
     *     signatures: array{required: int|null, given: int},
     *     app_url: string,
     *     transfers: list<array{id: string, livemode: bool, object: 'payout_transfer', issuer: string, payout: string, supplier_tax_id: string, supplier_name: string|null, payee_account: string, clabe: string, bank: string|null, amount: float|int, currency: 'MXN', concept: string, reference: string|null, status: 'queued'|'sending'|'in_transit'|'unknown'|'succeeded'|'failed'|'returning'|'returned'|'not_sent'|'removed', tracking_key: string|null, cep_url: string|null, failure_reason: string|null, invoices: list<array<string, mixed>>, sent_at: string|null, settled_at: string|null}>,
     *     cancel_reason: string|null,
     *     created_by_api: bool,
     *     created_at: string|null,
     *     approved_at: string|null,
     *     sent_at: string|null,
     *     settled_at: string|null,
     *     canceled_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pagos-a-proveedores/create-payout
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payouts', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar pagos a proveedores
     *
     * Los pagos del emisor, hechos en la app o por la API, los más recientes primero, con sus
     * transferencias.
     *
     * GET /v1/payouts
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'draft'|'pending_approval'|'approved'|'sending'|'paid'|'partially_paid'|'failed'|'canceled',
     *     pay_on_from?: string,
     *     pay_on_to?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'payout', issuer: string, number: int, status: 'draft'|'pending_approval'|'approved'|'sending'|'paid'|'partially_paid'|'failed'|'canceled', pay_on: string, exchange_rate: 'official'|'fixed'|null, total: float|int, currency: 'MXN', note: string|null, source: 'app'|'api'|'assistant'|'rule'|'recurring', payout_mandate: string|null, signatures: array<string, mixed>, app_url: string, transfers: list<array<string, mixed>>, cancel_reason: string|null, created_by_api: bool, created_at: string|null, approved_at: string|null, sent_at: string|null, settled_at: string|null, canceled_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pagos-a-proveedores/list-payouts
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/payouts', $params, $options);
    }

    /**
     * Ver un pago a proveedores
     *
     * Con sus firmas, cada transferencia, su clave de rastreo y su CEP cuando llega.
     *
     * GET /v1/payouts/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'payout',
     *     issuer: string,
     *     number: int,
     *     status: 'draft'|'pending_approval'|'approved'|'sending'|'paid'|'partially_paid'|'failed'|'canceled',
     *     pay_on: string,
     *     exchange_rate: 'official'|'fixed'|null,
     *     total: float|int,
     *     currency: 'MXN',
     *     note: string|null,
     *     source: 'app'|'api'|'assistant'|'rule'|'recurring',
     *     payout_mandate: string|null,
     *     signatures: array{required: int|null, given: int},
     *     app_url: string,
     *     transfers: list<array{id: string, livemode: bool, object: 'payout_transfer', issuer: string, payout: string, supplier_tax_id: string, supplier_name: string|null, payee_account: string, clabe: string, bank: string|null, amount: float|int, currency: 'MXN', concept: string, reference: string|null, status: 'queued'|'sending'|'in_transit'|'unknown'|'succeeded'|'failed'|'returning'|'returned'|'not_sent'|'removed', tracking_key: string|null, cep_url: string|null, failure_reason: string|null, invoices: list<array<string, mixed>>, sent_at: string|null, settled_at: string|null}>,
     *     cancel_reason: string|null,
     *     created_by_api: bool,
     *     created_at: string|null,
     *     approved_at: string|null,
     *     sent_at: string|null,
     *     settled_at: string|null,
     *     canceled_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pagos-a-proveedores/get-payout
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payouts/' . rawurlencode($id), [], $options);
    }

    /**
     * Cancelar un pago a proveedores
     *
     * Uno que preparó la API, mientras no ha salido nada (draft, pending_approval o approved): sus
     * facturas vuelven a Por pagar y llega payout.canceled. Uno preparado en la app se cancela en
     * la app (400 payout_not_from_api).
     *
     * POST /v1/payouts/{id}/cancel
     *
     * @param string $id
     * @param array{reason?: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'payout',
     *     issuer: string,
     *     number: int,
     *     status: 'draft'|'pending_approval'|'approved'|'sending'|'paid'|'partially_paid'|'failed'|'canceled',
     *     pay_on: string,
     *     exchange_rate: 'official'|'fixed'|null,
     *     total: float|int,
     *     currency: 'MXN',
     *     note: string|null,
     *     source: 'app'|'api'|'assistant'|'rule'|'recurring',
     *     payout_mandate: string|null,
     *     signatures: array{required: int|null, given: int},
     *     app_url: string,
     *     transfers: list<array{id: string, livemode: bool, object: 'payout_transfer', issuer: string, payout: string, supplier_tax_id: string, supplier_name: string|null, payee_account: string, clabe: string, bank: string|null, amount: float|int, currency: 'MXN', concept: string, reference: string|null, status: 'queued'|'sending'|'in_transit'|'unknown'|'succeeded'|'failed'|'returning'|'returned'|'not_sent'|'removed', tracking_key: string|null, cep_url: string|null, failure_reason: string|null, invoices: list<array<string, mixed>>, sent_at: string|null, settled_at: string|null}>,
     *     cancel_reason: string|null,
     *     created_by_api: bool,
     *     created_at: string|null,
     *     approved_at: string|null,
     *     sent_at: string|null,
     *     settled_at: string|null,
     *     canceled_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pagos-a-proveedores/cancel-payout
     */
    public function cancel(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payouts/' . rawurlencode($id) . '/cancel', ['body' => $params, 'idempotent' => true], $options);
    }
}
