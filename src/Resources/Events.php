<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Eventos: $fiscalisto->events.
 */
final class Events
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar eventos
     *
     * Los de los últimos 30 días, los más recientes primero.
     *
     * GET /v1/events
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     type?: 'invoice.stamped'|'invoice.failed'|'invoice.canceled'|'invoice.cancellation_pending'|'invoice.cancellation_rejected'|'invoice.cancellation_failed'|'invoice.paid'|'invoice.partially_paid'|'invoice.email_bounced'|'invoice.email_complained'|'retention.stamped'|'retention.failed'|'retention.canceled'|'invoice_batch.completed'|'payroll_batch.completed'|'customer_data_request.completed'|'sat_download.completed'|'sat_download.failed'|'sat_declaration.created'|'sat_declaration.updated'|'sat_refresh.completed'|'sat_refresh.failed'|'ticket.invoiced'|'ticket.included_in_global'|'recurring_invoice.failed'|'quote.viewed'|'quote.accepted'|'quote.changes_requested'|'quote.rejected'|'quote.withdrawn'|'sales_order.confirmed'|'sales_order.customer_confirmed'|'sales_order.delivered'|'sales_order.paid'|'sales_order.canceled'|'supplier_invoice.received'|'supplier_invoice.approved'|'supplier_invoice.rejected'|'supplier_invoice.scheduled'|'supplier_invoice.paid'|'portal_supplier.approved'|'payout.approved'|'payout.paid'|'payout.partially_paid'|'payout.failed'|'payout.canceled'|'payout_transfer.succeeded'|'payout_transfer.failed'|'payout_transfer.returned'|'issuer.ready'|'balance.low'|'usage.high'|'test_clock.ready'|'rule.matched'|'invoice.*'|'invoice_batch.*'|'payroll_batch.*'|'recurring_invoice.*'|'quote.*'|'sales_order.*'|'supplier_invoice.*'|'portal_supplier.*'|'payout.*'|'payout_transfer.*'|'ticket.*'|'retention.*'|'customer_data_request.*'|'sat_download.*'|'sat_declaration.*'|'sat_refresh.*'|'issuer.*'|'balance.*'|'usage.*'|'test_clock.*'|'rule.*',
     *     object?: string,
     *     delivery_success?: bool,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'event', type: string, api_version: string, livemode: bool, created_at: string, data: array<string, mixed>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/eventos/list-events
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/events', $params, $options);
    }

    /**
     * Ver un evento
     *
     * Un evento de los últimos 30 días, con el objeto como estaba cuando pasó.
     *
     * GET /v1/events/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'event',
     *     type: string,
     *     api_version: string,
     *     livemode: bool,
     *     created_at: string,
     *     data: array{object: array<string, mixed>},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/eventos/get-event
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/events/' . rawurlencode($id), [], $options);
    }

    /**
     * Reenviar un evento
     *
     * Manda otra vez, ahora, un evento de los últimos 30 días: a un webhook (endpoint) o a todos
     * los encendidos que escuchan ese tipo. Es un intento aparte, firmado con el mismo webhook-id:
     * no cambia los reintentos automáticos, y si llega, ya no se reintenta. Úselo después de
     * arreglar su servidor, con GET /v1/events?delivery_success=false.
     *
     * POST /v1/events/{id}/resend
     *
     * @param string $id
     * @param array{endpoint?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{object: 'event_resend', event: string, deliveries: int}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/eventos/resend-event
     */
    public function resend(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/events/' . rawurlencode($id) . '/resend', ['body' => $params, 'idempotent' => true], $options);
    }
}
