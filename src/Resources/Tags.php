<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Etiquetas: $fiscalisto->tags.
 */
final class Tags
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear una etiqueta
     *
     * Una palabra suya para juntar facturas y órdenes de compra: una obra, un evento, un cliente,
     * «Urgente». Es la misma lista de Etiquetas en la app. Un nombre que ya existe (sin importar
     * mayúsculas ni acentos) contesta tag_exists con su id. Hasta 200 por empresa.
     *
     * POST /v1/tags
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     color?: 'info'|'positive'|'warning'|'critical'|'muted',
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'tag',
     *     metadata: array<string, mixed>,
     *     issuer: string,
     *     name: string,
     *     color: 'info'|'positive'|'warning'|'critical'|'muted',
     *     purchase_orders: int,
     *     invoices: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/etiquetas/create-tag
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/tags', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar etiquetas
     *
     * Las etiquetas del emisor, las más recientes primero, con cuántas órdenes de compra y
     * facturas lleva cada una.
     *
     * GET /v1/tags
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     'created[gte]'?: string,
     *     'created[gt]'?: string,
     *     'created[lte]'?: string,
     *     'created[lt]'?: string,
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'tag', metadata: array<string, mixed>, issuer: string, name: string, color: 'info'|'positive'|'warning'|'critical'|'muted', purchase_orders: int, invoices: int, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/etiquetas/list-tags
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/tags', $params, $options);
    }

    /**
     * Ver una etiqueta
     *
     * Una etiqueta del emisor.
     *
     * GET /v1/tags/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'tag',
     *     metadata: array<string, mixed>,
     *     issuer: string,
     *     name: string,
     *     color: 'info'|'positive'|'warning'|'critical'|'muted',
     *     purchase_orders: int,
     *     invoices: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/etiquetas/get-tag
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/tags/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar una etiqueta
     *
     * Cambia su nombre o su color; se ve así en todas sus facturas y órdenes. Un nombre que ya
     * tiene otra contesta tag_exists.
     *
     * POST /v1/tags/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     color?: 'info'|'positive'|'warning'|'critical'|'muted',
     *     metadata?: array<string, mixed>|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'tag',
     *     metadata: array<string, mixed>,
     *     issuer: string,
     *     name: string,
     *     color: 'info'|'positive'|'warning'|'critical'|'muted',
     *     purchase_orders: int,
     *     invoices: int,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/etiquetas/update-tag
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/tags/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una etiqueta
     *
     * Se quita de sus facturas y órdenes de compra, que no cambian en nada más, y se borran sus
     * etiquetas automáticas. No se puede deshacer.
     *
     * DELETE /v1/tags/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/etiquetas/delete-tag
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/tags/' . rawurlencode($id), [], $options);
    }
}
