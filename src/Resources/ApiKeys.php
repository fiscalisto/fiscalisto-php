<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Llaves de API: $fiscalisto->apiKeys.
 */
final class ApiKeys
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear una llave
     *
     * Una llave nueva con permisos por recurso, para dar a cada uno de sus clientes (o a cada
     * servidor) la suya. La respuesta trae la llave completa (secret) una sola vez. Nunca tiene
     * más que la llave que la crea: el mismo modo y entorno de prueba, en cada recurso como mucho
     * su acceso, dentro de sus emisores y sus IP, y vence antes o al mismo tiempo. Una llave de
     * producción solo la crea otra de producción. Hasta 30 por hora por cuenta.
     *
     * POST /v1/api_keys
     *
     * @param array{
     *     name: string,
     *     permissions: array<string, mixed>,
     *     issuers?: list<string>,
     *     allowed_ips?: list<string>,
     *     lifetime_hours?: int|null,
     *     expires_at?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'api_key',
     *     name: string|null,
     *     redacted: string,
     *     permissions: array<string, mixed>,
     *     issuers: list<string>,
     *     allowed_ips: list<string>,
     *     lifetime_hours: int|null,
     *     expires_at: string|null,
     *     created_at: string|null,
     *     last_used_at: string|null,
     *     rolled: bool,
     *     sandbox: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/llaves-de-api/create-api-key
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/api_keys', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar llaves
     *
     * Las llaves vigentes del modo que la llave puede manejar (las que no tienen más que ella), la
     * más nueva primero. Sin el secreto. Hasta 50 por modo.
     *
     * GET /v1/api_keys
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     'created[gte]'?: string,
     *     'created[gt]'?: string,
     *     'created[lte]'?: string,
     *     'created[lt]'?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'api_key', name: string|null, redacted: string, permissions: array<string, mixed>, issuers: list<string>, allowed_ips: list<string>, lifetime_hours: int|null, expires_at: string|null, created_at: string|null, last_used_at: string|null, rolled: bool, sandbox: string|null, secret?: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/llaves-de-api/list-api-keys
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/api_keys', $params, $options);
    }

    /**
     * Ver una llave
     *
     * Sus permisos, emisores, IP, vencimiento y último uso. El secreto solo viene al crearla o
     * cambiarla.
     *
     * GET /v1/api_keys/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'api_key',
     *     name: string|null,
     *     redacted: string,
     *     permissions: array<string, mixed>,
     *     issuers: list<string>,
     *     allowed_ips: list<string>,
     *     lifetime_hours: int|null,
     *     expires_at: string|null,
     *     created_at: string|null,
     *     last_used_at: string|null,
     *     rolled: bool,
     *     sandbox: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/llaves-de-api/get-api-key
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/api_keys/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar una llave
     *
     * Cambia su nombre, sus permisos, sus emisores o sus IP, con el mismo secreto. Solo cambia lo
     * que mande, con los mismos límites que al crearla. Su vencimiento no se cambia.
     *
     * POST /v1/api_keys/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     permissions?: array<string, mixed>,
     *     issuers?: list<string>,
     *     allowed_ips?: list<string>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'api_key',
     *     name: string|null,
     *     redacted: string,
     *     permissions: array<string, mixed>,
     *     issuers: list<string>,
     *     allowed_ips: list<string>,
     *     lifetime_hours: int|null,
     *     expires_at: string|null,
     *     created_at: string|null,
     *     last_used_at: string|null,
     *     rolled: bool,
     *     sandbox: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/llaves-de-api/update-api-key
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/api_keys/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Revocar una llave
     *
     * Deja de funcionar en ese momento. No se puede deshacer.
     *
     * DELETE /v1/api_keys/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/llaves-de-api/revoke-api-key
     */
    public function revoke(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/api_keys/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar una llave
     *
     * Una llave nueva con el mismo nombre, permisos, emisores, IP y duración, que la respuesta
     * trae una sola vez. La anterior sigue funcionando el tiempo que elija (expires_in), 24 horas
     * por omisión, para que la cambie sin cortar el servicio. Si se filtró, mande expires_in: 0.
     *
     * POST /v1/api_keys/{id}/roll
     *
     * @param string $id
     * @param array{expires_in?: int} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'api_key',
     *     name: string|null,
     *     redacted: string,
     *     permissions: array<string, mixed>,
     *     issuers: list<string>,
     *     allowed_ips: list<string>,
     *     lifetime_hours: int|null,
     *     expires_at: string|null,
     *     created_at: string|null,
     *     last_used_at: string|null,
     *     rolled: bool,
     *     sandbox: string|null,
     *     secret?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/llaves-de-api/roll-api-key
     */
    public function roll(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/api_keys/' . rawurlencode($id) . '/roll', ['body' => $params, 'idempotent' => true], $options);
    }
}
