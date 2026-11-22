<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->climateComplaints.
 */
final class ClimateComplaints
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar quejas del buzón
     *
     * Las quejas que mandaron los trabajadores desde su portal (numeral 8.1 b)): de violencia
     * laboral, del entorno u otra. Llevan nombre solo si quien la mandó la firmó.
     *
     * GET /v1/climate_complaints
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string, status?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'climate_complaint', livemode: bool, issuer: string, kind: string, body: string, employee: string|null, name: string|null, received_on: string, status: string, note: string|null, closed_on: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-climate-complaints
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/climate_complaints', $params, $options);
    }

    /**
     * Atender una queja del buzón
     *
     * Su estado y qué se hizo. Al marcarla atendida se anota el día. Lo que no manda no cambia.
     *
     * POST /v1/climate_complaints/{id}
     *
     * @param string $id
     * @param array{status?: 'nueva'|'en_atencion'|'atendida', note?: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_complaint',
     *     livemode: bool,
     *     issuer: string,
     *     kind: string,
     *     body: string,
     *     employee: string|null,
     *     name: string|null,
     *     received_on: string,
     *     status: string,
     *     note: string|null,
     *     closed_on: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-climate-complaint
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_complaints/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }
}
