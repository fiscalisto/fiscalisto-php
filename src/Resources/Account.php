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
     *     api_version: string,
     *     latest_api_version: string,
     *     key: array{id: string, name: string, issuers: list<string>|null, read_only: bool, expires_at: string|null, sandbox: string|null},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cuenta/get-account
     */
    public function get(array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/account', [], $options);
    }

    /**
     * Cambiar la versión de la API
     *
     * Mueve la versión de la API de la cuenta: la que reciben sus solicitudes sin el encabezado
     * Fiscalisto-Version y sus webhooks sin api_version propio. Antes, pruebe la nueva mandando
     * Fiscalisto-Version en sus solicitudes. Con una llave de la cuenta con todos los permisos (no
     * de un entorno de prueba). Queda en Desarrolladores › Actividad.
     *
     * POST /v1/account
     *
     * @param array{api_version: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'account',
     *     name: string,
     *     api_version: string,
     *     latest_api_version: string,
     *     key: array{id: string, name: string, issuers: list<string>|null, read_only: bool, expires_at: string|null, sandbox: string|null},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cuenta/update-account
     */
    public function update(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/account', ['body' => $params, 'idempotent' => true], $options);
    }
}
