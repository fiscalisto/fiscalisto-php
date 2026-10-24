<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cuenta: $fiscalisto->account.
 */
final class Account
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver la cuenta
     *
     * La cuenta API y la llave con que se hizo la solicitud. Útil para probar la llave.
     *
     * GET /v1/account
     *
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'account',
     *     name: string,
     *     key: array{id: string, name: string, issuers: list<string>|null},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cuenta/get-account
     */
    public function get(array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/account', [], $options);
    }
}
