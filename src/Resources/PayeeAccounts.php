<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Pagos a proveedores: $fiscalisto->payeeAccounts.
 */
final class PayeeAccounts
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar cuentas de proveedores
     *
     * Las cuentas a las que se les paga a sus proveedores, verificadas con el banco, y si ya se
     * les puede pagar. Solo lectura: agregar o cambiar una CLABE se hace en la app, con su espera
     * y su aprobación.
     *
     * GET /v1/payee_accounts
     *
     * @param array{issuer?: string, supplier_tax_id?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'payee_account', issuer: string, supplier_tax_id: string, supplier_name: string|null, clabe: string, bank: string|null, holder_tax_id: string|null, holder_name: string|null, third_party: bool, verification: 'bank'|'by_hand'|'third_party'|null, verified_by_hand_reason: string|null, account_number: string|null, is_default: bool, status: 'verifying'|'pending_approval'|'holder_mismatch'|'failed'|'approved'|'rejected'|'replaced', usable: bool, usable_from: string|null, verified_at: string|null, created_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pagos-a-proveedores/list-payee-accounts
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payee_accounts', ['query' => $params], $options);
    }
}
