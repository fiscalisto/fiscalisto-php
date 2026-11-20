<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Pagos a proveedores: $fiscalisto->payoutMandates.
 */
final class PayoutMandates
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar pagos recurrentes
     *
     * Los pagos recurrentes firmados en la app (o por firmar): a qué cuenta, cuánto como máximo,
     * qué día y qué meses, y los pagos que ya hicieron. Solo lectura.
     *
     * GET /v1/payout_mandates
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'payout_mandate', issuer: string, supplier_tax_id: string, supplier_name: string|null, payee_account: string, clabe: string, amount: float|int, currency: 'MXN', day: int, first_month: string, last_month: string, concept: string, status: 'pending_signatures'|'active'|'canceled'|'ended', next_pay_on: string|null, payouts: list<string>, created_at: string|null, activated_at: string|null, canceled_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pagos-a-proveedores/list-payout-mandates
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payout_mandates', ['query' => $params], $options);
    }
}
