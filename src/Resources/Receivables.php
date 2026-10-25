<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cuentas por cobrar: $fiscalisto->receivables.
 */
final class Receivables
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver lo que le deben
     *
     * Lo que debe cada cliente, por moneda, de sus facturas abiertas (PPD con saldo y PUE por
     * cobrar), ordenado por RFC. Las facturas de cada uno: GET
     * /v1/invoices?customer=RFC&payment_status=open.
     *
     * GET /v1/receivables
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string, customer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'receivable', livemode: bool, issuer: string, customer: array<string, mixed>, currency: string, amount_due: float|int, open_invoices: int, oldest_invoice_date: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cuentas-por-cobrar/list-receivables
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/receivables', $params, $options);
    }
}
