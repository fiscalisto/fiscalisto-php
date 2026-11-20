<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->ledgerBankAccounts.
 */
final class LedgerBankAccounts
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar las cuentas de banco de la contabilidad
     *
     * Las cuentas de banco del emisor que la contabilidad lleva aparte, cada una su propia
     * subcuenta de Bancos (102-01-<últimos 4>): las de sus cuentas bancarias y las que ya tienen
     * pólizas. Lo que la conciliación identifica en el estado de cuenta (depósitos ligados a su
     * CFDI, retiros marcados como pago de facturas) pasa de Bancos a esa cuenta; lo que ningún
     * estado de cuenta explica se queda en Bancos.
     *
     * GET /v1/accounting/bank_accounts
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{object: 'ledger_bank_account', livemode: bool, issuer: string, last4: string, name: string, account: string, currency: string}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-ledger-bank-accounts
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/bank_accounts', ['query' => $params], $options);
    }

    /**
     * Cambiar la moneda de una cuenta de banco
     *
     * Cambia la moneda (y el nombre) de una cuenta de banco de la contabilidad, por sus últimos 4
     * dígitos. Una cuenta en otra moneda se revalúa en las revaluaciones cambiarias con el saldo
     * de su último estado de cuenta.
     *
     * POST /v1/accounting/bank_accounts/{last_four}
     *
     * @param string $last_four
     * @param array{issuer?: string, currency: string, name?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'ledger_bank_account',
     *     livemode: bool,
     *     issuer: string,
     *     last4: string,
     *     name: string,
     *     account: string,
     *     currency: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/update-ledger-bank-account
     */
    public function update(string $last_four, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/bank_accounts/' . rawurlencode($last_four), ['body' => $params, 'idempotent' => true], $options);
    }
}
