<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Sucursales: $fiscalisto->branches.
 */
final class Branches
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear una sucursal
     *
     * Otro lugar desde donde factura el emisor, con su propio código postal: sus facturas llevan
     * ese CP en LugarExpedicion (y su zona horaria en la Fecha, y el IVA 8 % si es de la franja
     * fronteriza), su dirección en el PDF y, si las da, sus propias series. Un CP que ya tiene
     * otra sucursal contesta branch_exists; el del domicilio fiscal del emisor no es sucursal (es
     * la Matriz). Hasta 200 por emisor.
     *
     * POST /v1/branches
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     zip: string,
     *     address?: array{street?: string|null, exterior?: string|null, interior?: string|null, neighborhood?: string|null, city?: string|null, state?: string|null},
     *     phone?: string|null,
     *     email?: string|null,
     *     series?: array{invoice?: string|null, credit_note?: string|null, payment?: string|null, transfer?: string|null},
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'branch',
     *     issuer: string,
     *     name: string,
     *     zip: string,
     *     address: array{street: string|null, exterior: string|null, interior: string|null, neighborhood: string|null, city: string|null, state: string|null},
     *     phone: string|null,
     *     email: string|null,
     *     series: array{invoice: string|null, credit_note: string|null, payment: string|null, transfer: string|null},
     *     archived: bool,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/sucursales/create-branch
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/branches', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar sucursales
     *
     * Las sucursales del emisor, las más recientes primero. Las archivadas solo con
     * include_archived=true.
     *
     * GET /v1/branches
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     include_archived?: bool,
     *     zip?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'branch', issuer: string, name: string, zip: string, address: array<string, mixed>, phone: string|null, email: string|null, series: array<string, mixed>, archived: bool, created_at: string|null, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/sucursales/list-branches
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/branches', $params, $options);
    }

    /**
     * Ver una sucursal
     *
     * Una sucursal del emisor.
     *
     * GET /v1/branches/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'branch',
     *     issuer: string,
     *     name: string,
     *     zip: string,
     *     address: array{street: string|null, exterior: string|null, interior: string|null, neighborhood: string|null, city: string|null, state: string|null},
     *     phone: string|null,
     *     email: string|null,
     *     series: array{invoice: string|null, credit_note: string|null, payment: string|null, transfer: string|null},
     *     archived: bool,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/sucursales/get-branch
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/branches/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar una sucursal
     *
     * Cambia solo los campos que manda; una serie en null vuelve a la del emisor. archived: true
     * la archiva (ya no se factura desde ella y sus facturas la siguen nombrando), false la
     * restaura. El código postal de una sucursal que ya facturó no cambia: si se mudó, archívela y
     * cree otra.
     *
     * POST /v1/branches/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     zip?: string,
     *     address?: array{street?: string|null, exterior?: string|null, interior?: string|null, neighborhood?: string|null, city?: string|null, state?: string|null},
     *     phone?: string|null,
     *     email?: string|null,
     *     series?: array{invoice?: string|null, credit_note?: string|null, payment?: string|null, transfer?: string|null},
     *     archived?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'branch',
     *     issuer: string,
     *     name: string,
     *     zip: string,
     *     address: array{street: string|null, exterior: string|null, interior: string|null, neighborhood: string|null, city: string|null, state: string|null},
     *     phone: string|null,
     *     email: string|null,
     *     series: array{invoice: string|null, credit_note: string|null, payment: string|null, transfer: string|null},
     *     archived: bool,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/sucursales/update-branch
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/branches/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una sucursal
     *
     * Solo una que nunca facturó; con facturas contesta branch_has_invoices: archívela con
     * archived: true.
     *
     * DELETE /v1/branches/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/sucursales/delete-branch
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/branches/' . rawurlencode($id), [], $options);
    }
}
