<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->reviewObjectives.
 */
final class ReviewObjectives
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Agregar un objetivo
     *
     * Un objetivo de una persona en un ciclo, con su meta, unidad y peso (hasta 20 por persona).
     * Su jefe lo califica al evaluarla y la persona anota su avance en su portal. Ya no se agregan
     * cuando el jefe la evaluó.
     *
     * POST /v1/review_objectives
     *
     * @param array{
     *     cycle: string,
     *     employee: string,
     *     title: string,
     *     target?: float|int|null,
     *     actual?: float|int|null,
     *     unit?: string|null,
     *     lower_better?: bool,
     *     weight?: float|int,
     *     note?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_objective',
     *     cycle: string,
     *     employee: string,
     *     title: string,
     *     target: float|int|null,
     *     actual: float|int|null,
     *     unit: string|null,
     *     lower_better: bool,
     *     weight: float|int,
     *     note: string|null,
     *     achievement: float|int|null,
     *     score: float|int|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-review-objective
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_objectives', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar un objetivo
     *
     * Reemplaza el objetivo con lo que manda: lo que no manda queda vacío o con su valor por
     * omisión.
     *
     * POST /v1/review_objectives/{id}
     *
     * @param string $id
     * @param array{
     *     title: string,
     *     target?: float|int|null,
     *     actual?: float|int|null,
     *     unit?: string|null,
     *     lower_better?: bool,
     *     weight?: float|int,
     *     note?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_objective',
     *     cycle: string,
     *     employee: string,
     *     title: string,
     *     target: float|int|null,
     *     actual: float|int|null,
     *     unit: string|null,
     *     lower_better: bool,
     *     weight: float|int,
     *     note: string|null,
     *     achievement: float|int|null,
     *     score: float|int|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-review-objective
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_objectives/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un objetivo
     *
     * Lo borra, salvo que su jefe ya lo haya calificado.
     *
     * DELETE /v1/review_objectives/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: 'review_objective', deleted: bool}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-review-objective
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/review_objectives/' . rawurlencode($id), [], $options);
    }
}
