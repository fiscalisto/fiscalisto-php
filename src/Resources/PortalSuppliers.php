<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Portal de proveedores: $fiscalisto->portalSuppliers.
 */
final class PortalSuppliers
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar proveedores del portal
     *
     * Los proveedores invitados o registrados en el Portal de proveedores del emisor, los más
     * recientes primero: su alta, sus documentos, la cuenta a la que se le paga y su calificación.
     *
     * GET /v1/portal_suppliers
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'invited'|'onboarding'|'in_review'|'approved'|'rejected'|'suspended',
     *     tax_id?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'portal_supplier', issuer: string, tax_id: string, name: string|null, emails: list<string>, phone: string|null, status: 'invited'|'onboarding'|'in_review'|'approved'|'rejected'|'suspended', repse: bool, documents: array<string, mixed>, bank_account: array<string, mixed>|null, score: array<string, mixed>, last_seen_at: string|null, created_at: string|null, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/portal-de-proveedores/list-portal-suppliers
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/portal_suppliers', $params, $options);
    }

    /**
     * Ver un proveedor del portal
     *
     * Su alta, sus documentos, su cuenta bancaria y su calificación por partes.
     *
     * GET /v1/portal_suppliers/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'portal_supplier',
     *     issuer: string,
     *     tax_id: string,
     *     name: string|null,
     *     emails: list<string>,
     *     phone: string|null,
     *     status: 'invited'|'onboarding'|'in_review'|'approved'|'rejected'|'suspended',
     *     repse: bool,
     *     documents: array{complete: bool, missing: int, pending: int, expired: int, expiring: int},
     *     bank_account: array{clabe: string, bank: string|null, holder: string|null, status: 'pending'|'approved'|'rejected', previous_clabe: string|null}|null,
     *     score: array{value: int|null, level: 'excellent'|'good'|'fair'|'poor'|null, parts: list<array<string, mixed>>},
     *     last_seen_at: string|null,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/portal-de-proveedores/get-portal-supplier
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/portal_suppliers/' . rawurlencode($id), [], $options);
    }
}
