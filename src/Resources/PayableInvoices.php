<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Pagos a proveedores: $fiscalisto->payableInvoices.
 */
final class PayableInvoices
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar lo que falta por pagar
     *
     * Las facturas recibidas con algo por pagar, como Pagos › Por pagar, las más recientes
     * primero; con uuid, esas facturas (pagadas o no). Lo pagado cuenta complementos, notas de
     * crédito, pagos de Fiscalisto y pagos registrados a mano. Si el emisor no paga con Fintoc,
     * 400 payouts_not_enabled.
     *
     * GET /v1/payable_invoices
     *
     * @param array{
     *     issuer?: string,
     *     limit?: int,
     *     starting_after?: string,
     *     supplier_tax_id?: string,
     *     uuid?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'payable_invoice', uuid: string, sat_invoice: string, supplier_tax_id: string, supplier_name: string|null, series: string|null, folio: string|null, date: string, currency: string, total: float|int, paid: float|int, amount_due: float|int, payment_method: string|null, withheld: array<string, mixed>|null, early_payment: array<string, mixed>|null, in_payout: string|null, credit_notes_subtracted: list<array<string, mixed>>, credit_notes_to_review: list<array<string, mixed>>, payment_hold: array<string, mixed>|null, warnings: list<string>, app_url: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pagos-a-proveedores/list-payable-invoices
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/payable_invoices', $params, $options);
    }
}
