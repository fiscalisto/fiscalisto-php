<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Equipo: $fiscalisto->invitations.
 */
final class Invitations
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar invitaciones
     *
     * Las invitaciones pendientes de la empresa, las más antiguas primero.
     *
     * GET /v1/invitations
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, object: 'invitation', livemode: bool, issuer: string, email: string, role: string, all_permissions: bool, permissions_added: list<string>, permissions_removed: list<string>, tax_ids: list<string>|null, branches: list<string>|null, status: 'pending'|'canceled', expires_at: string}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/list-invitations
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/invitations', ['query' => $params], $options);
    }

    /**
     * Invitar a alguien a la empresa
     *
     * Le manda un correo con un enlace para entrar a la empresa con ese rol, válido 7 días, como
     * Invitar en Ajustes › Miembros. Invitar otra vez al mismo correo reemplaza la invitación. Una
     * invitación con permisos delicados (equipo, credenciales, seguridad, plan) o como propietario
     * se hace en la app.
     *
     * POST /v1/invitations
     *
     * @param array{
     *     issuer?: string,
     *     email: string,
     *     role: string,
     *     all_permissions?: bool,
     *     permissions_added?: list<string>,
     *     permissions_removed?: list<string>,
     *     tax_ids?: list<string>|null,
     *     branches?: list<string>|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'invitation',
     *     livemode: bool,
     *     issuer: string,
     *     email: string,
     *     role: string,
     *     all_permissions: bool,
     *     permissions_added: list<string>,
     *     permissions_removed: list<string>,
     *     tax_ids: list<string>|null,
     *     branches: list<string>|null,
     *     status: 'pending'|'canceled',
     *     expires_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/create-invitation
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/invitations', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cancelar una invitación
     *
     * Su enlace deja de servir. Contesta la invitación con status canceled.
     *
     * DELETE /v1/invitations/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'invitation',
     *     livemode: bool,
     *     issuer: string,
     *     email: string,
     *     role: string,
     *     all_permissions: bool,
     *     permissions_added: list<string>,
     *     permissions_removed: list<string>,
     *     tax_ids: list<string>|null,
     *     branches: list<string>|null,
     *     status: 'pending'|'canceled',
     *     expires_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/equipo/cancel-invitation
     */
    public function cancel(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/invitations/' . rawurlencode($id), [], $options);
    }
}
