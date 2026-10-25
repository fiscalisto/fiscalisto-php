<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Tiendas en línea: $fiscalisto->storeConnections.
 */
final class StoreConnections
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Conectar una tienda
     *
     * Shopify: con el dominio y las llaves de la app de la tienda (Dev Dashboard, permisos
     * read_orders y write_orders) registra los webhooks y queda active. Mercado Libre: queda
     * pending hasta que el vendedor autorice en authorize_url. Desde entonces cada pedido pagado
     * es un ticket (folio SHOP-1001 o ML-…), que su comprador factura en el portal o entra en la
     * factura global; un pedido cancelado o reembolsado completo cancela su ticket.
     *
     * POST /v1/store_connections
     *
     * @param array{
     *     issuer?: string,
     *     platform: 'shopify'|'mercadolibre',
     *     shop?: string,
     *     client_id?: string,
     *     client_secret?: string,
     *     access_token?: string,
     *     return_url?: string,
     *     settings?: array{product_key?: string, unit_key?: string, iva?: '0'|'0.16'|'0.08'|'exento', description?: string, folio_prefix?: string, payment_form?: string, payment_forms?: array<string, mixed>, auto_invoice?: bool},
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'store_connection',
     *     issuer: string,
     *     platform: 'shopify'|'mercadolibre',
     *     shop: string|null,
     *     status: 'pending'|'active'|'disconnected',
     *     authorize_url: string|null,
     *     settings: array{product_key: string|null, unit_key: string|null, iva: '0'|'0.16'|'0.08'|'exento', description: string|null, folio_prefix: string, payment_form: string|null, payment_forms: array<string, mixed>, auto_invoice: bool|null},
     *     orders_count: int,
     *     last_order_at: string|null,
     *     last_error: array{message: string, at: string|null}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tiendas-en-linea/create-store-connection
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/store_connections', ['body' => $params], $options);
    }

    /**
     * Listar tiendas
     *
     * Las más recientes primero, también las desconectadas.
     *
     * GET /v1/store_connections
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'store_connection', issuer: string, platform: 'shopify'|'mercadolibre', shop: string|null, status: 'pending'|'active'|'disconnected', authorize_url: string|null, settings: array<string, mixed>, orders_count: int, last_order_at: string|null, last_error: array<string, mixed>|null, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tiendas-en-linea/list-store-connections
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/store_connections', $params, $options);
    }

    /**
     * Ver una tienda
     *
     * GET /v1/store_connections/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'store_connection',
     *     issuer: string,
     *     platform: 'shopify'|'mercadolibre',
     *     shop: string|null,
     *     status: 'pending'|'active'|'disconnected',
     *     authorize_url: string|null,
     *     settings: array{product_key: string|null, unit_key: string|null, iva: '0'|'0.16'|'0.08'|'exento', description: string|null, folio_prefix: string, payment_form: string|null, payment_forms: array<string, mixed>, auto_invoice: bool|null},
     *     orders_count: int,
     *     last_order_at: string|null,
     *     last_error: array{message: string, at: string|null}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tiendas-en-linea/get-store-connection
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/store_connections/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar cómo se vuelven tickets sus pedidos
     *
     * Cuenta para los pedidos que lleguen; los tickets ya hechos no cambian.
     *
     * POST /v1/store_connections/{id}
     *
     * @param string $id
     * @param array{
     *     settings: array{product_key?: string, unit_key?: string, iva?: '0'|'0.16'|'0.08'|'exento', description?: string, folio_prefix?: string, payment_form?: string, payment_forms?: array<string, mixed>, auto_invoice?: bool},
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'store_connection',
     *     issuer: string,
     *     platform: 'shopify'|'mercadolibre',
     *     shop: string|null,
     *     status: 'pending'|'active'|'disconnected',
     *     authorize_url: string|null,
     *     settings: array{product_key: string|null, unit_key: string|null, iva: '0'|'0.16'|'0.08'|'exento', description: string|null, folio_prefix: string, payment_form: string|null, payment_forms: array<string, mixed>, auto_invoice: bool|null},
     *     orders_count: int,
     *     last_order_at: string|null,
     *     last_error: array{message: string, at: string|null}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tiendas-en-linea/update-store-connection
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/store_connections/' . rawurlencode($id), ['body' => $params], $options);
    }

    /**
     * Desconectar una tienda
     *
     * Sus pedidos dejan de llegar y se borran sus llaves y webhooks. Los tickets que ya hizo
     * siguen.
     *
     * DELETE /v1/store_connections/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'store_connection',
     *     issuer: string,
     *     platform: 'shopify'|'mercadolibre',
     *     shop: string|null,
     *     status: 'pending'|'active'|'disconnected',
     *     authorize_url: string|null,
     *     settings: array{product_key: string|null, unit_key: string|null, iva: '0'|'0.16'|'0.08'|'exento', description: string|null, folio_prefix: string, payment_form: string|null, payment_forms: array<string, mixed>, auto_invoice: bool|null},
     *     orders_count: int,
     *     last_order_at: string|null,
     *     last_error: array{message: string, at: string|null}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tiendas-en-linea/delete-store-connection
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/store_connections/' . rawurlencode($id), [], $options);
    }

    /**
     * Traer pedidos pagados
     *
     * Los pedidos pagados desde una fecha (hasta 31 días, 200 a la vez) que no llegaron por
     * webhook: la tienda se conectó después o estuvo caída. Un pedido que ya es ticket no se
     * repite.
     *
     * POST /v1/store_connections/{id}/import_orders
     *
     * @param string $id
     * @param array{since?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'store_import',
     *     livemode: bool,
     *     store_connection: string,
     *     since: string,
     *     tickets: int,
     *     invoiced: int,
     *     skipped: list<array{order: string, reason: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/tiendas-en-linea/import-store-orders
     */
    public function importOrders(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/store_connections/' . rawurlencode($id) . '/import_orders', ['body' => $params], $options);
    }
}
