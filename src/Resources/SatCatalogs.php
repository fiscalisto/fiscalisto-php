<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Catálogos del SAT: $fiscalisto->satCatalogs.
 */
final class SatCatalogs
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Consultar un catálogo del SAT
     *
     * product_keys y unit_keys se buscan con q (texto o clave). Los demás vienen completos:
     * tax_systems, cfdi_uses, payment_forms, payment_methods, relationship_types,
     * cancellation_motives, export_types, tax_objects, retention_codes.
     *
     * GET /v1/sat_catalogs/{name}
     *
     * @param string $name
     * @param array{q?: string, limit?: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{code: string, description: string}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/catalogos-del-sat/get-sat-catalog
     */
    public function get(string $name, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_catalogs/' . rawurlencode($name), ['query' => $params], $options);
    }
}
