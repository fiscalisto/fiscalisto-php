<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Equipo: $fiscalisto->permissions.
 */
final class Permissions
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar permisos
     *
     * Cada permiso que un rol o una persona puede tener, con su nombre en la app, su grupo y si es
     * delicado.
     *
     * GET /v1/permissions
     *
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, object: 'permission', name: string, group: string, sensitive: bool}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/list-permissions
     */
    public function list(array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/permissions', [], $options);
    }
}
