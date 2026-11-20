<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->accountRenumberings.
 */
final class AccountRenumberings
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Renumerar el catálogo
     *
     * Cambia el número de todas las cuentas a la vez: con separator y widths (cada nivel rellenado
     * con ceros) o con mapping (el número nuevo de cada una). Las pólizas, saldos iniciales y
     * presupuestos siguen en las mismas cuentas. Si alguna no puede tomar su número (un nivel que
     * no cabe, el de una cuenta de mayor, dos cuentas en un número) no cambia ninguna y contesta
     * parameter_invalid; con dry_run solo dice qué cambiaría. Las subcuentas de banco conservan el
     * suyo.
     *
     * POST /v1/accounting/account_renumberings
     *
     * @param array{
     *     issuer?: string,
     *     separator?: '-'|'.'|'',
     *     widths?: list<int>,
     *     mapping?: list<array{from: string, to: string}>,
     *     dry_run?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'account_renumbering',
     *     livemode: bool,
     *     dry_run: bool,
     *     changes: int,
     *     problems: int,
     *     accounts: list<array{number: string, name: string, grouping_code: string, previous_number: string, problem: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/renumber-accounts
     */
    public function create(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/account_renumberings', ['body' => $params, 'idempotent' => true], $options);
    }
}
