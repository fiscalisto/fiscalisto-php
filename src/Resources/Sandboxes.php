<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Entornos de prueba: $fiscalisto->sandboxes.
 */
final class Sandboxes
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un entorno de prueba
     *
     * Un modo de pruebas propio para una persona o un proyecto: nace con el emisor de pruebas del
     * SAT y una llave fk_test_ (key.secret, una sola vez) que solo ve los emisores, webhooks y
     * eventos del entorno, y que reinicia solo los suyos. Se crea con una llave de pruebas de la
     * cuenta (no de otro entorno ni limitada a emisores). Hasta 25 por cuenta.
     *
     * POST /v1/sandboxes
     *
     * @param array{name: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'sandbox',
     *     livemode: false,
     *     name: string,
     *     issuers: int,
     *     issuer?: array{id: string, livemode: bool, object: 'issuer', tax_id: string, legal_name: string|null, tax_system: string|null, zip: string|null, status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived', requirement: string|null, certificate: array<string, mixed>|null, sat_downloads: array<string, mixed>, employer_registration: string|null, curp: string|null, stamps_as: string, sandbox: string|null, created_at: string|null, archived_at: string|null, metadata: array<string, mixed>}|null,
     *     key?: array{id: string, secret: string},
     *     created_at: string|null,
     *     deleted?: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/entornos-de-prueba/create-sandbox
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sandboxes', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar entornos de prueba
     *
     * GET /v1/sandboxes
     *
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, object: 'sandbox', livemode: false, name: string, issuers: int, issuer?: array<string, mixed>|null, key?: array<string, mixed>, created_at: string|null, deleted?: bool}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/entornos-de-prueba/list-sandboxes
     */
    public function list(array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sandboxes', [], $options);
    }

    /**
     * Ver un entorno de prueba
     *
     * GET /v1/sandboxes/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'sandbox',
     *     livemode: false,
     *     name: string,
     *     issuers: int,
     *     issuer?: array{id: string, livemode: bool, object: 'issuer', tax_id: string, legal_name: string|null, tax_system: string|null, zip: string|null, status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived', requirement: string|null, certificate: array<string, mixed>|null, sat_downloads: array<string, mixed>, employer_registration: string|null, curp: string|null, stamps_as: string, sandbox: string|null, created_at: string|null, archived_at: string|null, metadata: array<string, mixed>}|null,
     *     key?: array{id: string, secret: string},
     *     created_at: string|null,
     *     deleted?: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/entornos-de-prueba/get-sandbox
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sandboxes/' . rawurlencode($id), [], $options);
    }

    /**
     * Borrar un entorno de prueba
     *
     * Sus llaves dejan de funcionar al momento, sus emisores se archivan y sus webhooks se borran.
     * No toca nada de la cuenta ni de otros entornos.
     *
     * DELETE /v1/sandboxes/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/entornos-de-prueba/delete-sandbox
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/sandboxes/' . rawurlencode($id), [], $options);
    }
}
