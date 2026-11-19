<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Declaraciones del SAT: $fiscalisto->satRefreshes.
 */
final class SatRefreshes
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar consultas al SAT
     *
     * Las consultas al SAT que pidió (declaraciones, opinión de cumplimiento, constancia y buzón),
     * de la más reciente a la más antigua, con cómo van. No usa timbres.
     *
     * GET /v1/sat_refreshes
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     document?: 'declarations'|'compliance_opinion'|'tax_status_certificate'|'sat_mailbox',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{object: 'sat_refresh', id: string, livemode: bool, issuer: string, document: 'declarations'|'compliance_opinion'|'tax_status_certificate'|'sat_mailbox', status: 'processing'|'completed'|'failed', result: array<string, mixed>|null, error: string|null, charged: bool, timbre_held: bool, created_at: string, completed_at: string|null, refreshed_at: string, next_refresh_at: string, url: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/list-sat-refreshes
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/sat_refreshes', $params, $options);
    }

    /**
     * Ver una consulta al SAT
     *
     * Cómo va una consulta al SAT (srf_…): processing mientras se consulta, completed con lo que
     * trajo en result o failed con el motivo en error (su timbre regresó). No usa timbres.
     *
     * GET /v1/sat_refreshes/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_refresh',
     *     id: string,
     *     livemode: bool,
     *     issuer: string,
     *     document: 'declarations'|'compliance_opinion'|'tax_status_certificate'|'sat_mailbox',
     *     status: 'processing'|'completed'|'failed',
     *     result: array{found: int, downloaded: int, pending: int, warning: string|null, completes_at: string|null}|array{url: string}|null,
     *     error: string|null,
     *     charged: bool,
     *     timbre_held: bool,
     *     created_at: string,
     *     completed_at: string|null,
     *     refreshed_at: string,
     *     next_refresh_at: string,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/get-sat-refresh
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_refreshes/' . rawurlencode($id), [], $options);
    }
}
