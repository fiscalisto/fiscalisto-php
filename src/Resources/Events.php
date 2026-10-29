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
     *     type?: 'invoice.stamped'|'invoice.failed'|'invoice.canceled'|'invoice.cancellation_pending'|'invoice.cancellation_rejected'|'invoice.paid'|'invoice.partially_paid'|'invoice.email_bounced'|'invoice.email_complained'|'retention.stamped'|'retention.failed'|'retention.canceled'|'invoice_batch.completed'|'payroll_batch.completed'|'customer_data_request.completed'|'sat_download.completed'|'sat_download.failed'|'sat_declaration.created'|'sat_declaration.updated'|'ticket.invoiced'|'ticket.included_in_global'|'recurring_invoice.failed'|'quote.viewed'|'quote.accepted'|'quote.changes_requested'|'quote.rejected'|'quote.withdrawn'|'issuer.ready'|'balance.low'|'test_clock.ready'|'invoice.*'|'invoice_batch.*'|'payroll_batch.*'|'recurring_invoice.*'|'quote.*'|'ticket.*'|'retention.*'|'customer_data_request.*'|'sat_download.*'|'sat_declaration.*'|'issuer.*'|'balance.*'|'test_clock.*',
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
}
