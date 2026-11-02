<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Centros de costo: $fiscalisto->costCenters.
 */
final class CostCenters
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un centro de costo
     *
     * Una parte del negocio del emisor que quiere ver por separado: una obra, un proyecto, una
     * sucursal, un área. Sus facturas lo toman con cost_center al crearlas, o después con POST
     * /v1/invoices/{id} y POST /v1/sat_invoices/{id}. Un nombre que ya existe contesta
     * cost_center_exists. Hasta 500 por emisor.
     *
     * POST /v1/cost_centers
     *
     * @param array{issuer?: string, name: string, code?: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'cost_center',
     *     issuer: string,
     *     name: string,
     *     code: string|null,
     *     archived: bool,
     *     invoices: int,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/centros-de-costo/create-cost-center
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/cost_centers', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar centros de costo
     *
     * Los centros de costo del emisor, los más recientes primero, con cuántas facturas tiene cada
     * uno. Los archivados solo con include_archived=true.
     *
     * GET /v1/cost_centers
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     include_archived?: bool,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'cost_center', issuer: string, name: string, code: string|null, archived: bool, invoices: int, created_at: string|null, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/centros-de-costo/list-cost-centers
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/cost_centers', $params, $options);
    }

    /**
     * Ver un centro de costo
     *
     * Un centro de costo del emisor.
     *
     * GET /v1/cost_centers/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'cost_center',
     *     issuer: string,
     *     name: string,
     *     code: string|null,
     *     archived: bool,
     *     invoices: int,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/centros-de-costo/get-cost-center
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/cost_centers/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un centro de costo
     *
     * Cambia solo lo que manda. archived: true lo archiva (ya no se ponen facturas en él y las
     * suyas lo conservan), false lo restaura.
     *
     * POST /v1/cost_centers/{id}
     *
     * @param string $id
     * @param array{name?: string, code?: string|null, archived?: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'cost_center',
     *     issuer: string,
     *     name: string,
     *     code: string|null,
     *     archived: bool,
     *     invoices: int,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/centros-de-costo/update-cost-center
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/cost_centers/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un centro de costo
     *
     * Sus facturas pasan a move_to (así junta dos en uno) o se quedan sin centro de costo. No se
     * puede deshacer; para dejar de usarlo sin tocar sus facturas, archívelo.
     *
     * DELETE /v1/cost_centers/{id}
     *
     * @param string $id
     * @param array{move_to?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/centros-de-costo/delete-cost-center
     */
    public function delete(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/cost_centers/' . rawurlencode($id), ['query' => $params], $options);
    }
}
