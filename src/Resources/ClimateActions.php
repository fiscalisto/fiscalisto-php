<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->climateActions.
 */
final class ClimateActions
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar acciones del Programa de intervención
     *
     * Las acciones del emisor (cla_…), las pendientes primero y por fecha, o solo las de una
     * encuesta con survey.
     *
     * GET /v1/climate_actions
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     survey?: string,
     *     'created[gte]'?: string,
     *     'created[gt]'?: string,
     *     'created[lte]'?: string,
     *     'created[lt]'?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'climate_action', livemode: bool, issuer: string, survey: string|null, area: string, level: string, action: string, owner: string|null, due_on: string|null, status: string, done_on: string|null, evaluation: string|null, created_at: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-climate-actions
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/climate_actions', $params, $options);
    }

    /**
     * Agregar una acción del Programa de intervención
     *
     * Lo que pide el programa (numeral 8.4): el área que atiende, la acción, su nivel (primer
     * nivel la organización, segundo los grupos, tercero cada persona, numeral 8.5), el
     * responsable y la fecha. Al marcarla done se anota el día, y evaluation dice cómo resultó.
     *
     * POST /v1/climate_actions
     *
     * @param array{
     *     issuer?: string,
     *     survey?: string|null,
     *     area: string,
     *     level?: 'primer'|'segundo'|'tercer',
     *     action: string,
     *     owner?: string|null,
     *     due_on?: string|null,
     *     status?: 'pending'|'in_progress'|'done',
     *     evaluation?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_action',
     *     livemode: bool,
     *     issuer: string,
     *     survey: string|null,
     *     area: string,
     *     level: string,
     *     action: string,
     *     owner: string|null,
     *     due_on: string|null,
     *     status: string,
     *     done_on: string|null,
     *     evaluation: string|null,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-climate-action
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_actions', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar una acción del Programa de intervención
     *
     * Reemplaza la acción con lo que manda: lo que no manda queda vacío o con su valor por
     * omisión.
     *
     * POST /v1/climate_actions/{id}
     *
     * @param string $id
     * @param array{
     *     issuer?: string,
     *     survey?: string|null,
     *     area: string,
     *     level?: 'primer'|'segundo'|'tercer',
     *     action: string,
     *     owner?: string|null,
     *     due_on?: string|null,
     *     status?: 'pending'|'in_progress'|'done',
     *     evaluation?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_action',
     *     livemode: bool,
     *     issuer: string,
     *     survey: string|null,
     *     area: string,
     *     level: string,
     *     action: string,
     *     owner: string|null,
     *     due_on: string|null,
     *     status: string,
     *     done_on: string|null,
     *     evaluation: string|null,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-climate-action
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_actions/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una acción del Programa de intervención
     *
     * La borra. No se puede deshacer.
     *
     * DELETE /v1/climate_actions/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: 'climate_action', deleted: bool}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-climate-action
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/climate_actions/' . rawurlencode($id), [], $options);
    }
}
