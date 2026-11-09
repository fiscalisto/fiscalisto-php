<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Listas de precios: $fiscalisto->priceLists.
 */
final class PriceLists
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear una lista de precios
     *
     * Parte del precio del catálogo (o de base_list, otra lista), lo mueve adjust_percent y lo
     * redondea a round_to; con starts_on y ends_on es una promoción. items le pone precios propios
     * por producto, por presentación (unit, una caja) y desde min_quantity (escalones de mayoreo),
     * cada uno con unit_price o discount_percent. is_default: la tienen los clientes sin otra.
     * Hasta 100.
     *
     * POST /v1/price_lists
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     description?: string|null,
     *     base_list?: string|null,
     *     adjust_percent?: float|int,
     *     round_to?: float|int|null,
     *     starts_on?: string|null,
     *     ends_on?: string|null,
     *     is_default?: bool,
     *     items?: list<array{product: string, unit?: string|null, min_quantity?: float|int, unit_price?: float|int, discount_percent?: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'price_list',
     *     issuer: string,
     *     name: string,
     *     description: string|null,
     *     base_list: string|null,
     *     adjust_percent: float|int,
     *     round_to: float|int|null,
     *     starts_on: string|null,
     *     ends_on: string|null,
     *     is_default: bool,
     *     active: bool,
     *     groups: int,
     *     customers: int,
     *     items: list<array{product: string, unit: string|null, min_quantity: float|int, unit_price: float|int|null, discount_percent: float|null}>|null,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/create-price-list
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/price_lists', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar listas de precios
     *
     * Las listas de precios en el orden de la app, con cuántos grupos y clientes la tienen. items
     * viene al ver una.
     *
     * GET /v1/price_lists
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'price_list', issuer: string, name: string, description: string|null, base_list: string|null, adjust_percent: float|int, round_to: float|int|null, starts_on: string|null, ends_on: string|null, is_default: bool, active: bool, groups: int, customers: int, items: list<array<string, mixed>>|null, created_at: string|null, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/list-price-lists
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/price_lists', $params, $options);
    }

    /**
     * Ver una lista de precios
     *
     * Una lista de precios con sus precios propios (items).
     *
     * GET /v1/price_lists/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'price_list',
     *     issuer: string,
     *     name: string,
     *     description: string|null,
     *     base_list: string|null,
     *     adjust_percent: float|int,
     *     round_to: float|int|null,
     *     starts_on: string|null,
     *     ends_on: string|null,
     *     is_default: bool,
     *     active: bool,
     *     groups: int,
     *     customers: int,
     *     items: list<array{product: string, unit: string|null, min_quantity: float|int, unit_price: float|int|null, discount_percent: float|null}>|null,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/get-price-list
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/price_lists/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar una lista de precios
     *
     * Cambia solo lo que manda; items reemplaza todos sus precios propios. Las facturas,
     * cotizaciones y pedidos ya hechos no cambian.
     *
     * POST /v1/price_lists/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     description?: string|null,
     *     base_list?: string|null,
     *     adjust_percent?: float|int,
     *     round_to?: float|int|null,
     *     starts_on?: string|null,
     *     ends_on?: string|null,
     *     is_default?: bool,
     *     items?: list<array{product: string, unit?: string|null, min_quantity?: float|int, unit_price?: float|int, discount_percent?: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'price_list',
     *     issuer: string,
     *     name: string,
     *     description: string|null,
     *     base_list: string|null,
     *     adjust_percent: float|int,
     *     round_to: float|int|null,
     *     starts_on: string|null,
     *     ends_on: string|null,
     *     is_default: bool,
     *     active: bool,
     *     groups: int,
     *     customers: int,
     *     items: list<array{product: string, unit: string|null, min_quantity: float|int, unit_price: float|int|null, discount_percent: float|null}>|null,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/update-price-list
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/price_lists/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar una lista de precios
     *
     * La archiva: sus grupos y clientes pasan a la lista que aplica a todos (o al precio del
     * catálogo).
     *
     * DELETE /v1/price_lists/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/delete-price-list
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/price_lists/' . rawurlencode($id), [], $options);
    }
}
