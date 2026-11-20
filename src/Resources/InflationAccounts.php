<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->inflationAccounts.
 */
final class InflationAccounts
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Cambiar cómo cuenta una cuenta en el ajuste por inflación
     *
     * Marca cuentas de balance como crédito (credit), deuda (debt) o ninguno (none) para el ajuste
     * anual por inflación, por ejemplo un préstamo a un socio persona moral o una deuda de un
     * gasto no deducible. treatment null regresa al de su código agrupador. Una cuenta de
     * resultados contesta parameter_invalid.
     *
     * POST /v1/accounting/inflation_accounts
     *
     * @param array{
     *     issuer?: string,
     *     accounts: list<array{account: string, treatment: 'credit'|'debt'|'none'|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'inflation_accounts',
     *     livemode: bool,
     *     issuer: string,
     *     accounts: list<array{account: string, name: string, grouping_code: string, treatment: 'credit'|'debt'|'none', changed: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/save-inflation-accounts
     */
    public function save(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/inflation_accounts', ['body' => $params, 'idempotent' => true], $options);
    }
}
