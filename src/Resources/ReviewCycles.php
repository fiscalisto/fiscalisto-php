<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->reviewCycles.
 */
final class ReviewCycles
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar ciclos de evaluación
     *
     * Los ciclos de evaluación de desempeño del emisor (rvc_…), los más recientes primero, con
     * cuántas personas y cuántas evaluaciones van enviadas.
     *
     * GET /v1/review_cycles
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     'created[gte]'?: string,
     *     'created[gt]'?: string,
     *     'created[lte]'?: string,
     *     'created[lt]'?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'review_cycle', livemode: bool, issuer: string, title: string, status: string, period_start: string|null, period_end: string|null, closes_on: string|null, people: int, evaluations: int, evaluations_done: int, created_at: string, branch?: string|null, department?: string|null, rules?: array<string, mixed>, competencies?: list<array<string, mixed>>, peers_count?: int, share_results?: bool, opened_at?: string|null, closed_at?: string|null, participants?: list<array<string, mixed>>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-review-cycles
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/review_cycles', $params, $options);
    }

    /**
     * Crear un ciclo de evaluación
     *
     * Lo crea en borrador con todas las personas que trabajan hoy en el emisor, o en la sucursal o
     * el departamento que diga. Ninguna ley pide evaluar el desempeño, así que la escala, quién
     * evalúa, los pesos y las competencias los decide usted; lo que no manda toma los valores por
     * omisión. Ábralo con POST /v1/review_cycles/{id}/open.
     *
     * POST /v1/review_cycles
     *
     * @param array{
     *     issuer?: string,
     *     title: string,
     *     period_start?: string|null,
     *     period_end?: string|null,
     *     closes_on?: string|null,
     *     rules?: array{scale: array{max: int, labels: list<string>}, raters: array{self: bool, manager: bool, peer: bool, report: bool}, rater_weights: array{self: float|int, manager: float|int, peer: float|int, report: float|int}, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description?: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     branch?: string|null,
     *     department?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_cycle',
     *     livemode: bool,
     *     issuer: string,
     *     title: string,
     *     status: string,
     *     period_start: string|null,
     *     period_end: string|null,
     *     closes_on: string|null,
     *     people: int,
     *     evaluations: int,
     *     evaluations_done: int,
     *     created_at: string,
     *     branch?: string|null,
     *     department?: string|null,
     *     rules?: array{scale: array<string, mixed>, raters: array<string, mixed>, rater_weights: array<string, mixed>, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     opened_at?: string|null,
     *     closed_at?: string|null,
     *     participants?: list<array{employee: string, name: string, position: string|null, department: string|null, manager: string|null, peers: list<string>, raters: list<array<string, mixed>>, objectives: list<array<string, mixed>>, competencies_score: float|int|null, objectives_score: float|int|null, final: float|int|null, calibrated: float|int|null, calibration_note: string|null, potential: int|null, result: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-review-cycle
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_cycles', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver un ciclo de evaluación
     *
     * El ciclo con sus reglas, competencias y cada persona: su jefe, quién la evalúa y si ya envió
     * su evaluación (no qué contestó), sus objetivos y su resultado. Con el ciclo abierto el
     * resultado se calcula con lo que va llegando; al cerrarlo queda guardado.
     *
     * GET /v1/review_cycles/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_cycle',
     *     livemode: bool,
     *     issuer: string,
     *     title: string,
     *     status: string,
     *     period_start: string|null,
     *     period_end: string|null,
     *     closes_on: string|null,
     *     people: int,
     *     evaluations: int,
     *     evaluations_done: int,
     *     created_at: string,
     *     branch?: string|null,
     *     department?: string|null,
     *     rules?: array{scale: array<string, mixed>, raters: array<string, mixed>, rater_weights: array<string, mixed>, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     opened_at?: string|null,
     *     closed_at?: string|null,
     *     participants?: list<array{employee: string, name: string, position: string|null, department: string|null, manager: string|null, peers: list<string>, raters: list<array<string, mixed>>, objectives: list<array<string, mixed>>, competencies_score: float|int|null, objectives_score: float|int|null, final: float|int|null, calibrated: float|int|null, calibration_note: string|null, potential: int|null, result: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-review-cycle
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/review_cycles/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar un ciclo de evaluación
     *
     * En borrador cambia todo. Abierto, solo el nombre, el periodo, la fecha límite, compañeros
     * por persona y share_results: la escala, las competencias y quién evalúa ya no cambian porque
     * hay quien ya contestó con ellas. Cerrado ya no cambia.
     *
     * POST /v1/review_cycles/{id}
     *
     * @param string $id
     * @param array{
     *     issuer?: string,
     *     title: string,
     *     period_start?: string|null,
     *     period_end?: string|null,
     *     closes_on?: string|null,
     *     rules?: array{scale: array{max: int, labels: list<string>}, raters: array{self: bool, manager: bool, peer: bool, report: bool}, rater_weights: array{self: float|int, manager: float|int, peer: float|int, report: float|int}, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description?: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_cycle',
     *     livemode: bool,
     *     issuer: string,
     *     title: string,
     *     status: string,
     *     period_start: string|null,
     *     period_end: string|null,
     *     closes_on: string|null,
     *     people: int,
     *     evaluations: int,
     *     evaluations_done: int,
     *     created_at: string,
     *     branch?: string|null,
     *     department?: string|null,
     *     rules?: array{scale: array<string, mixed>, raters: array<string, mixed>, rater_weights: array<string, mixed>, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     opened_at?: string|null,
     *     closed_at?: string|null,
     *     participants?: list<array{employee: string, name: string, position: string|null, department: string|null, manager: string|null, peers: list<string>, raters: list<array<string, mixed>>, objectives: list<array<string, mixed>>, competencies_score: float|int|null, objectives_score: float|int|null, final: float|int|null, calibrated: float|int|null, calibration_note: string|null, potential: int|null, result: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-review-cycle
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_cycles/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un ciclo de evaluación
     *
     * Lo borra con sus personas y objetivos si nadie ha enviado una evaluación. Con evaluaciones,
     * ciérrelo.
     *
     * DELETE /v1/review_cycles/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: 'review_cycle', deleted: bool}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-review-cycle
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/review_cycles/' . rawurlencode($id), [], $options);
    }

    /**
     * Abrir un ciclo de evaluación
     *
     * Arma quién evalúa a quién: la persona misma, su jefe en el organigrama, sus compañeros (los
     * elegidos o, si no, peers_count al azar entre quienes tienen el mismo jefe) y las personas a
     * su cargo, según rules.raters. A cada evaluador le aparece en su portal lo que le toca, con
     * el aviso review si lo tiene encendido.
     *
     * POST /v1/review_cycles/{id}/open
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_cycle',
     *     livemode: bool,
     *     issuer: string,
     *     title: string,
     *     status: string,
     *     period_start: string|null,
     *     period_end: string|null,
     *     closes_on: string|null,
     *     people: int,
     *     evaluations: int,
     *     evaluations_done: int,
     *     created_at: string,
     *     branch?: string|null,
     *     department?: string|null,
     *     rules?: array{scale: array<string, mixed>, raters: array<string, mixed>, rater_weights: array<string, mixed>, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     opened_at?: string|null,
     *     closed_at?: string|null,
     *     participants?: list<array{employee: string, name: string, position: string|null, department: string|null, manager: string|null, peers: list<string>, raters: list<array<string, mixed>>, objectives: list<array<string, mixed>>, competencies_score: float|int|null, objectives_score: float|int|null, final: float|int|null, calibrated: float|int|null, calibration_note: string|null, potential: int|null, result: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/open-review-cycle
     */
    public function open(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_cycles/' . rawurlencode($id) . '/open', ['idempotent' => true], $options);
    }

    /**
     * Cerrar un ciclo de evaluación
     *
     * Deja de recibir evaluaciones y guarda el resultado de cada persona como quedó. Con
     * share_results, cada persona lo ve en su portal.
     *
     * POST /v1/review_cycles/{id}/close
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_cycle',
     *     livemode: bool,
     *     issuer: string,
     *     title: string,
     *     status: string,
     *     period_start: string|null,
     *     period_end: string|null,
     *     closes_on: string|null,
     *     people: int,
     *     evaluations: int,
     *     evaluations_done: int,
     *     created_at: string,
     *     branch?: string|null,
     *     department?: string|null,
     *     rules?: array{scale: array<string, mixed>, raters: array<string, mixed>, rater_weights: array<string, mixed>, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     opened_at?: string|null,
     *     closed_at?: string|null,
     *     participants?: list<array{employee: string, name: string, position: string|null, department: string|null, manager: string|null, peers: list<string>, raters: list<array<string, mixed>>, objectives: list<array<string, mixed>>, competencies_score: float|int|null, objectives_score: float|int|null, final: float|int|null, calibrated: float|int|null, calibration_note: string|null, potential: int|null, result: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/close-review-cycle
     */
    public function close(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_cycles/' . rawurlencode($id) . '/close', ['idempotent' => true], $options);
    }

    /**
     * Elegir a quién se evalúa
     *
     * En borrador: reemplaza la lista de personas del ciclo. Quien sale pierde sus objetivos en el
     * ciclo.
     *
     * POST /v1/review_cycles/{id}/participants
     *
     * @param string $id
     * @param array{employees: list<string>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_cycle',
     *     livemode: bool,
     *     issuer: string,
     *     title: string,
     *     status: string,
     *     period_start: string|null,
     *     period_end: string|null,
     *     closes_on: string|null,
     *     people: int,
     *     evaluations: int,
     *     evaluations_done: int,
     *     created_at: string,
     *     branch?: string|null,
     *     department?: string|null,
     *     rules?: array{scale: array<string, mixed>, raters: array<string, mixed>, rater_weights: array<string, mixed>, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     opened_at?: string|null,
     *     closed_at?: string|null,
     *     participants?: list<array{employee: string, name: string, position: string|null, department: string|null, manager: string|null, peers: list<string>, raters: list<array<string, mixed>>, objectives: list<array<string, mixed>>, competencies_score: float|int|null, objectives_score: float|int|null, final: float|int|null, calibrated: float|int|null, calibration_note: string|null, potential: int|null, result: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/set-review-participants
     */
    public function setParticipants(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_cycles/' . rawurlencode($id) . '/participants', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Elegir los compañeros que evalúan a alguien
     *
     * Los compañeros que evalúan a una persona. Con el ciclo abierto agrega las evaluaciones de
     * los nuevos y quita las que no se han enviado de los que salen.
     *
     * POST /v1/review_cycles/{id}/peers
     *
     * @param string $id
     * @param array{employee: string, peers: list<string>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_cycle',
     *     livemode: bool,
     *     issuer: string,
     *     title: string,
     *     status: string,
     *     period_start: string|null,
     *     period_end: string|null,
     *     closes_on: string|null,
     *     people: int,
     *     evaluations: int,
     *     evaluations_done: int,
     *     created_at: string,
     *     branch?: string|null,
     *     department?: string|null,
     *     rules?: array{scale: array<string, mixed>, raters: array<string, mixed>, rater_weights: array<string, mixed>, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     opened_at?: string|null,
     *     closed_at?: string|null,
     *     participants?: list<array{employee: string, name: string, position: string|null, department: string|null, manager: string|null, peers: list<string>, raters: list<array<string, mixed>>, objectives: list<array<string, mixed>>, competencies_score: float|int|null, objectives_score: float|int|null, final: float|int|null, calibrated: float|int|null, calibration_note: string|null, potential: int|null, result: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/set-review-peers
     */
    public function setPeers(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_cycles/' . rawurlencode($id) . '/peers', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Calibrar el resultado de una persona
     *
     * Con el ciclo abierto o cerrado: una calificación calibrada en lugar de la calculada (con la
     * nota de por qué cambia) y su potencial para la matriz de 9 cuadros. Lo que no manda no
     * cambia.
     *
     * POST /v1/review_cycles/{id}/calibrations
     *
     * @param string $id
     * @param array{
     *     employee: string,
     *     calibrated?: float|int|null,
     *     note?: string|null,
     *     potential?: int|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'review_cycle',
     *     livemode: bool,
     *     issuer: string,
     *     title: string,
     *     status: string,
     *     period_start: string|null,
     *     period_end: string|null,
     *     closes_on: string|null,
     *     people: int,
     *     evaluations: int,
     *     evaluations_done: int,
     *     created_at: string,
     *     branch?: string|null,
     *     department?: string|null,
     *     rules?: array{scale: array<string, mixed>, raters: array<string, mixed>, rater_weights: array<string, mixed>, objectives_weight: float|int, anonymous_min: int, box_cuts: list<float|int>},
     *     competencies?: list<array{id: string, name: string, description: string|null}>,
     *     peers_count?: int,
     *     share_results?: bool,
     *     opened_at?: string|null,
     *     closed_at?: string|null,
     *     participants?: list<array{employee: string, name: string, position: string|null, department: string|null, manager: string|null, peers: list<string>, raters: list<array<string, mixed>>, objectives: list<array<string, mixed>>, competencies_score: float|int|null, objectives_score: float|int|null, final: float|int|null, calibrated: float|int|null, calibration_note: string|null, potential: int|null, result: float|int|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/calibrate-review
     */
    public function calibrate(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/review_cycles/' . rawurlencode($id) . '/calibrations', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver el resultado de una persona
     *
     * Su calificación por competencia y por tipo de evaluador, y los comentarios. Compañeros y
     * personas a su cargo se promedian juntos y nunca llevan nombre; con menos respuestas que
     * rules.anonymous_min no cuentan ni se muestran.
     *
     * GET /v1/review_cycles/{id}/results/{employee}
     *
     * @param string $id
     * @param string $employee
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'review_result',
     *     cycle: string,
     *     employee: string,
     *     name: string,
     *     final: float|int|null,
     *     competencies_score: float|int|null,
     *     objectives_score: float|int|null,
     *     relations: list<array{relation: string, answers: int, score: float|int|null, hidden: bool}>,
     *     competencies: list<array{id: string, name: string, score: float|int|null, by_relation: array<string, mixed>}>,
     *     comments: list<array{relation: string, text: string, name: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-review-result
     */
    public function result(string $id, string $employee, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/review_cycles/' . rawurlencode($id) . '/results/' . rawurlencode($employee), [], $options);
    }
}
