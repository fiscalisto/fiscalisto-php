<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Equipo: $fiscalisto->roles.
 */
final class Roles
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar roles
     *
     * Propietario, los roles de Fiscalisto (como se editaron en la empresa) y los suyos, con sus
     * permisos y cuántas personas los tienen.
     *
     * GET /v1/roles
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, object: 'role', livemode: bool, issuer: string, name: string, description: string|null, all_permissions: bool, permissions: list<string>, type: 'owner'|'starter'|'custom', members: float|int, invitations: float|int}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/list-roles
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/roles', ['query' => $params], $options);
    }

    /**
     * Crear un rol
     *
     * Un rol de la empresa con su nombre y sus permisos (GET /v1/permissions), como Ajustes ›
     * Roles. No puede tener permisos que no tenga quien creó la llave; uno con permisos delicados
     * se hace en la app.
     *
     * POST /v1/roles
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     description?: string|null,
     *     all_permissions?: bool,
     *     permissions?: list<string>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'role',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     description: string|null,
     *     all_permissions: bool,
     *     permissions: list<string>,
     *     type: 'owner'|'starter'|'custom',
     *     members: float|int,
     *     invitations: float|int,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/create-role
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/roles', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar un rol
     *
     * Su nombre, su descripción o sus permisos; lo que no mande se queda. Cambia el acceso de
     * todos los que lo tienen. Propietario no se cambia.
     *
     * POST /v1/roles/{id}
     *
     * @param string $id
     * @param array{
     *     issuer?: string,
     *     description?: string|null,
     *     all_permissions?: bool,
     *     permissions?: list<string>,
     *     name?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'role',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     description: string|null,
     *     all_permissions: bool,
     *     permissions: list<string>,
     *     type: 'owner'|'starter'|'custom',
     *     members: float|int,
     *     invitations: float|int,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/update-role
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/roles/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un rol
     *
     * Solo uno de la empresa (type custom), cuando nadie lo tiene ni lo da una invitación
     * pendiente.
     *
     * DELETE /v1/roles/{id}
     *
     * @param string $id
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/delete-role
     */
    public function delete(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/roles/' . rawurlencode($id), ['query' => $params], $options);
    }
}
