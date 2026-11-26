<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Equipo: $fiscalisto->members.
 */
final class Members
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar miembros
     *
     * Quién entra a la empresa en la app, con su rol, sus permisos y los RFC y sucursales a su
     * alcance, como Ajustes › Miembros. Todos, los más antiguos primero. Pide que quien creó la
     * llave tenga el permiso de ver el equipo.
     *
     * GET /v1/members
     *
     * @param array{
     *     issuer?: string,
     *     'created[gte]'?: string,
     *     'created[gt]'?: string,
     *     'created[lte]'?: string,
     *     'created[lt]'?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, object: 'member', livemode: bool, issuer: string, name: string|null, email: string, role: string, all_permissions: bool, permissions_added: list<string>, permissions_removed: list<string>, tax_ids: list<string>|null, branches: list<string>|null, permissions: list<string>, two_factor_enabled: bool, created_at: string}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/list-members
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/members', ['query' => $params], $options);
    }

    /**
     * Ver un miembro
     *
     * Su rol, sus permisos (los agregados, los quitados y los que tiene al final) y su alcance.
     *
     * GET /v1/members/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'member',
     *     livemode: bool,
     *     issuer: string,
     *     name: string|null,
     *     email: string,
     *     role: string,
     *     all_permissions: bool,
     *     permissions_added: list<string>,
     *     permissions_removed: list<string>,
     *     tax_ids: list<string>|null,
     *     branches: list<string>|null,
     *     permissions: list<string>,
     *     two_factor_enabled: bool,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/get-member
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/members/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar el acceso de un miembro
     *
     * Su rol, los permisos que se le agregan o quitan y los RFC y sucursales a su alcance; lo que
     * no mande se queda como está. Nadie da más de lo que tiene quien creó la llave. Dar, quitar o
     * tocar un permiso delicado (equipo, credenciales, seguridad, plan) contesta 403
     * team_change_requires_app: se hace en la app, que confirma la identidad.
     *
     * POST /v1/members/{id}
     *
     * @param string $id
     * @param array{
     *     role?: string,
     *     all_permissions?: bool,
     *     permissions_added?: list<string>,
     *     permissions_removed?: list<string>,
     *     tax_ids?: list<string>|null,
     *     branches?: list<string>|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'member',
     *     livemode: bool,
     *     issuer: string,
     *     name: string|null,
     *     email: string,
     *     role: string,
     *     all_permissions: bool,
     *     permissions_added: list<string>,
     *     permissions_removed: list<string>,
     *     tax_ids: list<string>|null,
     *     branches: list<string>|null,
     *     permissions: list<string>,
     *     two_factor_enabled: bool,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/update-member
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/members/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar a un miembro
     *
     * La persona deja de entrar a la empresa y sus invitaciones se cancelan; lo que hizo se queda
     * con su nombre. Lo que le esperaba (pasos de aprobación que la nombran, aprobaciones
     * pendientes, avisos, ausencias, viáticos que aprueba) pasa a `transfer_to` o, sin él, a
     * cualquiera con el permiso. Siempre queda al menos un propietario; quitar a alguien con
     * permisos delicados se hace en la app.
     *
     * DELETE /v1/members/{id}
     *
     * @param string $id
     * @param array{transfer_to?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/delete-member
     */
    public function delete(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/members/' . rawurlencode($id), ['query' => $params], $options);
    }
}
