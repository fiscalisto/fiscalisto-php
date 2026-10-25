<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Listas del SAT: $fiscalisto->satLists.
 */
final class SatLists
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Revisar un RFC en las listas del SAT
     *
     * Si el RFC aparece en la lista 69-B (operaciones simuladas), 69-B Bis o del art. 69 (no
     * localizados, créditos firmes, exigibles, cancelados, sentencias, CSD sin efectos). Las
     * listas se actualizan cada día con los archivos del SAT. No usa timbres.
     *
     * GET /v1/sat_lists/{tax_id}
     *
     * @param string $tax_id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_list_check',
     *     tax_id: string,
     *     name: string|null,
     *     listed: bool,
     *     risk: 'high'|'medium'|'none',
     *     lists: list<array{list: '69'|'69b'|'69b_bis', source: string, source_name: string, situation: string|null, published_on: string|null, details: array<string, mixed>|null}>,
     *     lists_updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-del-sat/get-sat-list-check
     */
    public function get(string $tax_id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_lists/' . rawurlencode($tax_id), [], $options);
    }

    /**
     * Revisar varios RFC en las listas del SAT
     *
     * Hasta 1,000 RFC en una solicitud, en el mismo orden en que los mandó (sin repetidos). No usa
     * timbres.
     *
     * POST /v1/sat_lists/check
     *
     * @param array{tax_ids: list<string>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{object: 'sat_list_check', tax_id: string, name: string|null, listed: bool, risk: 'high'|'medium'|'none', lists: list<array<string, mixed>>, lists_updated_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-del-sat/check-sat-lists
     */
    public function check(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_lists/check', ['body' => $params, 'idempotent' => true], $options);
    }
}
