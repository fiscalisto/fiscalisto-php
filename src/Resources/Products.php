<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Productos: $fiscalisto->products.
 */
final class Products
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un producto
     *
     * Un producto o servicio del catálogo del emisor, con su clave del SAT, su unidad, su precio y
     * sus impuestos, para usarlo en items con product.
     *
     * POST /v1/products
     *
     * @param array{
     *     issuer?: string,
     *     name?: string|null,
     *     description: string,
     *     product_key: string,
     *     unit_key?: string,
     *     unit_name?: string|null,
     *     sku?: string|null,
     *     unit_price?: float|int,
     *     open_price?: bool,
     *     taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08',
     *     iva?: '0'|'0.16'|'0.08'|'exento',
     *     ieps?: float|int|null,
     *     ieps_factor?: 'Tasa'|'Cuota',
     *     iva_retention?: float|int,
     *     isr_retention?: float|int,
     *     local_taxes?: list<array{retention: bool, name: string, rate: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'product',
     *     issuer: string,
     *     name: string|null,
     *     description: string,
     *     product_key: string,
     *     unit_key: string,
     *     unit_name: string|null,
     *     sku: string|null,
     *     unit_price: float|int,
     *     open_price: bool,
     *     taxability: string,
     *     iva: string,
     *     ieps: float|int|null,
     *     ieps_factor: string|null,
     *     iva_retention: float|int,
     *     isr_retention: float|int,
     *     local_taxes: list<array{retention: bool, name: string, rate: float|int}>,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/productos/create-product
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/products', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar productos
     *
     * Los productos del emisor, los más recientes primero. Filtre por sku o product_key.
     *
     * GET /v1/products
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     sku?: string,
     *     product_key?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'product', issuer: string, name: string|null, description: string, product_key: string, unit_key: string, unit_name: string|null, sku: string|null, unit_price: float|int, open_price: bool, taxability: string, iva: string, ieps: float|int|null, ieps_factor: string|null, iva_retention: float|int, isr_retention: float|int, local_taxes: list<array<string, mixed>>, created_at: string, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/productos/list-products
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/products', $params, $options);
    }

    /**
     * Ver un producto
     *
     * Un producto del catálogo.
     *
     * GET /v1/products/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'product',
     *     issuer: string,
     *     name: string|null,
     *     description: string,
     *     product_key: string,
     *     unit_key: string,
     *     unit_name: string|null,
     *     sku: string|null,
     *     unit_price: float|int,
     *     open_price: bool,
     *     taxability: string,
     *     iva: string,
     *     ieps: float|int|null,
     *     ieps_factor: string|null,
     *     iva_retention: float|int,
     *     isr_retention: float|int,
     *     local_taxes: list<array{retention: bool, name: string, rate: float|int}>,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/productos/get-product
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/products/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un producto
     *
     * Cambia solo los campos que manda. Las facturas ya timbradas no cambian.
     *
     * POST /v1/products/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string|null,
     *     description?: string,
     *     product_key?: string,
     *     unit_key?: string,
     *     unit_name?: string|null,
     *     sku?: string|null,
     *     unit_price?: float|int,
     *     open_price?: bool,
     *     taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08',
     *     iva?: '0'|'0.16'|'0.08'|'exento',
     *     ieps?: float|int|null,
     *     ieps_factor?: 'Tasa'|'Cuota',
     *     iva_retention?: float|int,
     *     isr_retention?: float|int,
     *     local_taxes?: list<array{retention: bool, name: string, rate: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'product',
     *     issuer: string,
     *     name: string|null,
     *     description: string,
     *     product_key: string,
     *     unit_key: string,
     *     unit_name: string|null,
     *     sku: string|null,
     *     unit_price: float|int,
     *     open_price: bool,
     *     taxability: string,
     *     iva: string,
     *     ieps: float|int|null,
     *     ieps_factor: string|null,
     *     iva_retention: float|int,
     *     isr_retention: float|int,
     *     local_taxes: list<array{retention: bool, name: string, rate: float|int}>,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/productos/update-product
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/products/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un producto
     *
     * Lo quita del catálogo. Las facturas que lo usaron siguen igual.
     *
     * DELETE /v1/products/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/productos/delete-product
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/products/' . rawurlencode($id), [], $options);
    }
}
