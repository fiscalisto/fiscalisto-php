<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->openingBalances.
 */
final class OpeningBalances
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver los saldos iniciales
     *
     * Los saldos de cada cuenta con los que empiezan los libros del emisor (date), como Estados
     * financieros › Saldos iniciales en la app. Sin saldos iniciales, date es null.
     *
     * GET /v1/accounting/opening_balances
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'opening_balances',
     *     livemode: bool,
     *     issuer: string,
     *     date: string|null,
     *     lines: list<array{account: string, account_name: string, debit: float|int, credit: float|int}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-opening-balances
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/opening_balances', ['query' => $params], $options);
    }

    /**
     * Guardar los saldos iniciales
     *
     * Reemplaza los saldos iniciales: el día 1 del mes en que empiezan sus libros y el saldo
     * deudor o acreedor de cada cuenta (por su número); las dos columnas suman lo mismo o contesta
     * entry_unbalanced. Son los saldos finales de la balanza de su sistema anterior. Sin
     * renglones, los borra. Nada antes de esa fecha cuenta.
     *
     * POST /v1/accounting/opening_balances
     *
     * @param array{
     *     issuer?: string,
     *     date: string,
     *     lines: list<array{account: string, debit?: float|int, credit?: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'opening_balances',
     *     livemode: bool,
     *     issuer: string,
     *     date: string|null,
     *     lines: list<array{account: string, account_name: string, debit: float|int, credit: float|int}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/set-opening-balances
     */
    public function set(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/opening_balances', ['body' => $params, 'idempotent' => true], $options);
    }
}
