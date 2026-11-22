<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Reglas: $fiscalisto->supplierGroups.
 */
final class SupplierGroups
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un grupo de proveedores
     *
     * Un grupo de proveedores (fletes, materia prima…), como Proveedores › Grupos en la app. Cada
     * proveedor está en un solo grupo: los de suppliers salen del que tenían. Una regla vale para
     * todo el grupo con la condición supplierGroup.
     *
     * POST /v1/supplier_groups
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     color?: 'info'|'warning'|'positive'|'critical'|'muted',
     *     suppliers?: list<string>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'supplier_group',
     *     issuer: string,
     *     name: string,
     *     color: string,
     *     suppliers: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/create-supplier-group
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/supplier_groups', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar grupos de proveedores
     *
     * Los grupos de proveedores, con cuántos proveedores tiene cada uno.
     *
     * GET /v1/supplier_groups
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'supplier_group', issuer: string, name: string, color: string, suppliers: int, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/list-supplier-groups
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/supplier_groups', $params, $options);
    }

    /**
     * Ver un grupo de proveedores
     *
     * Un grupo de proveedores.
     *
     * GET /v1/supplier_groups/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'supplier_group',
     *     issuer: string,
     *     name: string,
     *     color: string,
     *     suppliers: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/get-supplier-group
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/supplier_groups/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un grupo de proveedores
     *
     * Cambia solo lo que manda: su nombre, su color, los proveedores que entran (add_suppliers) y
     * los que salen (remove_suppliers).
     *
     * POST /v1/supplier_groups/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     color?: 'info'|'warning'|'positive'|'critical'|'muted',
     *     add_suppliers?: list<string>,
     *     remove_suppliers?: list<string>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'supplier_group',
     *     issuer: string,
     *     name: string,
     *     color: string,
     *     suppliers: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/update-supplier-group
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/supplier_groups/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar un grupo de proveedores
     *
     * Sus proveedores se quedan sin grupo, y las reglas que lo usan ya no aplican a nadie.
     *
     * DELETE /v1/supplier_groups/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/delete-supplier-group
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/supplier_groups/' . rawurlencode($id), [], $options);
    }
}
