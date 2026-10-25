<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Autofactura: $fiscalisto->tickets.
 */
final class Tickets
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Registrar un ticket
     *
     * Una venta que su comprador factura él mismo: con el código (code) y el total en el portal
     * del emisor (url, que puede incrustar en su página con fiscalisto.js), da sus datos fiscales
     * y la factura se timbra al momento con los timbres de su cuenta. Lo que nadie factura entra
     * solo en la factura global del periodo. Registrar otra vez el mismo folio con el mismo total
     * contesta el ticket que ya existe (los reintentos son seguros); con otro total, 409.
     *
     * POST /v1/tickets
     *
     * @param array{
     *     issuer?: string,
     *     folio: string,
     *     total: float|int,
     *     tip?: float|int,
     *     payment_form: string,
     *     sold_at?: string,
     *     product?: string,
     *     description?: string,
     *     product_key?: string,
     *     unit_key?: string,
     *     iva?: '0'|'0.16'|'0.08'|'exento',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'ticket',
     *     issuer: string,
     *     folio: string,
     *     code: string,
     *     status: 'pending'|'invoiced'|'global'|'cancelled',
     *     url: string|null,
     *     total: float|int,
     *     tip: float|int,
     *     payment_form: string,
     *     description: string,
     *     product_key: string,
     *     sold_at: string,
     *     invoiceable_until: string,
     *     invoice: string|null,
     *     global_invoice: string|null,
     *     customer: array{tax_id: string, legal_name: string|null}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/autofactura/create-ticket
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/tickets', ['body' => $params], $options);
    }

    /**
     * Listar tickets
     *
     * Del más reciente al más antiguo por fecha de venta.
     *
     * GET /v1/tickets
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'pending'|'invoiced'|'global'|'cancelled',
     *     sold_at_gte?: string,
     *     sold_at_lte?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'ticket', issuer: string, folio: string, code: string, status: 'pending'|'invoiced'|'global'|'cancelled', url: string|null, total: float|int, tip: float|int, payment_form: string, description: string, product_key: string, sold_at: string, invoiceable_until: string, invoice: string|null, global_invoice: string|null, customer: array<string, mixed>|null, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/autofactura/list-tickets
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/tickets', $params, $options);
    }

    /**
     * Ver un ticket
     *
     * GET /v1/tickets/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'ticket',
     *     issuer: string,
     *     folio: string,
     *     code: string,
     *     status: 'pending'|'invoiced'|'global'|'cancelled',
     *     url: string|null,
     *     total: float|int,
     *     tip: float|int,
     *     payment_form: string,
     *     description: string,
     *     product_key: string,
     *     sold_at: string,
     *     invoiceable_until: string,
     *     invoice: string|null,
     *     global_invoice: string|null,
     *     customer: array{tax_id: string, legal_name: string|null}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/autofactura/get-ticket
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/tickets/' . rawurlencode($id), [], $options);
    }

    /**
     * Cancelar un ticket
     *
     * Una venta que no se hizo (devolución, error): ya no se puede facturar ni entra en la factura
     * global. Solo mientras esté pendiente.
     *
     * DELETE /v1/tickets/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'ticket',
     *     issuer: string,
     *     folio: string,
     *     code: string,
     *     status: 'pending'|'invoiced'|'global'|'cancelled',
     *     url: string|null,
     *     total: float|int,
     *     tip: float|int,
     *     payment_form: string,
     *     description: string,
     *     product_key: string,
     *     sold_at: string,
     *     invoiceable_until: string,
     *     invoice: string|null,
     *     global_invoice: string|null,
     *     customer: array{tax_id: string, legal_name: string|null}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/autofactura/cancel-ticket
     */
    public function cancel(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/tickets/' . rawurlencode($id), [], $options);
    }
}
