<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->trainingCourses.
 */
final class TrainingCourses
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar cursos de capacitación
     *
     * Los cursos del emisor (trc_…), los más recientes primero, con cuántos lo tomaron, aprobaron,
     * tienen su constancia y faltan por entregar (due) o ya pasaron los 20 días hábiles (late).
     *
     * GET /v1/training_courses
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'training_course', livemode: bool, issuer: string, name: string, thematic_area: string, hours: float|int, modality: string, trainer_kind: string, trainer_name: string|null, start_date: string, end_date: string, canceled: bool, trainer_registration?: string|null, instructor_name?: string|null, validity_months?: int|null, passing_score?: float|int|null, place?: string|null, objective?: string|null, signers_problem?: string|null, participants?: list<array<string, mixed>>, counts?: array<string, mixed>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-training-courses
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/training_courses', $params, $options);
    }

    /**
     * Registrar un curso de capacitación
     *
     * Lo que pide la constancia DC-3 (artículo 24, fracción IV): nombre, área temática del
     * catálogo de la STPS, horas, periodo y quién lo imparte (con un instructor interno la
     * constancia dice el nombre de la empresa como agente capacitador), con quiénes lo tomaron
     * (employees).
     *
     * POST /v1/training_courses
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality?: 'presencial'|'en_linea'|'mixta',
     *     start_date: string,
     *     end_date: string,
     *     trainer_kind?: 'internal'|'external'|'supplier'|'foreign'|'stps',
     *     trainer_name?: string|null,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     employees?: list<string>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'training_course',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality: string,
     *     trainer_kind: string,
     *     trainer_name: string|null,
     *     start_date: string,
     *     end_date: string,
     *     canceled: bool,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     signers_problem?: string|null,
     *     participants?: list<array{id: string, object: 'training_participant', employee: string, name: string, occupation: string|null, result: string, score: float|int|null, note: string|null, folio: int|null, issued_at: string|null, delivered_at: string|null, delivered_via: string|null, status: string, deliver_by: string|null, expires_on: string|null, blocker: string|null}>,
     *     counts?: array{participants: int, passed: int, pending: int, issued: int, delivered: int, due: int, late: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-training-course
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/training_courses', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver un curso de capacitación
     *
     * Un curso (trc_…) con quienes lo tomaron (trp_…): su resultado, el folio de su constancia, el
     * día límite para entregarla (20 días hábiles desde el fin del curso, artículo 24, fracción
     * III), si ya se entregó y, cuando todavía no se puede emitir, por qué (blocker).
     *
     * GET /v1/training_courses/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'training_course',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality: string,
     *     trainer_kind: string,
     *     trainer_name: string|null,
     *     start_date: string,
     *     end_date: string,
     *     canceled: bool,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     signers_problem?: string|null,
     *     participants?: list<array{id: string, object: 'training_participant', employee: string, name: string, occupation: string|null, result: string, score: float|int|null, note: string|null, folio: int|null, issued_at: string|null, delivered_at: string|null, delivered_via: string|null, status: string, deliver_by: string|null, expires_on: string|null, blocker: string|null}>,
     *     counts?: array{participants: int, passed: int, pending: int, issued: int, delivered: int, due: int, late: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-training-course
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/training_courses/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar un curso de capacitación
     *
     * Cambia sus datos; employees reemplaza la lista (quien ya tiene su constancia se queda). Las
     * constancias ya emitidas guardan lo que decían.
     *
     * POST /v1/training_courses/{id}
     *
     * @param string $id
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality?: 'presencial'|'en_linea'|'mixta',
     *     start_date: string,
     *     end_date: string,
     *     trainer_kind?: 'internal'|'external'|'supplier'|'foreign'|'stps',
     *     trainer_name?: string|null,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     employees?: list<string>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'training_course',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality: string,
     *     trainer_kind: string,
     *     trainer_name: string|null,
     *     start_date: string,
     *     end_date: string,
     *     canceled: bool,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     signers_problem?: string|null,
     *     participants?: list<array{id: string, object: 'training_participant', employee: string, name: string, occupation: string|null, result: string, score: float|int|null, note: string|null, folio: int|null, issued_at: string|null, delivered_at: string|null, delivered_via: string|null, status: string, deliver_by: string|null, expires_on: string|null, blocker: string|null}>,
     *     counts?: array{participants: int, passed: int, pending: int, issued: int, delivered: int, due: int, late: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-training-course
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/training_courses/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un curso de capacitación
     *
     * Lo borra si nadie tiene su constancia; si alguien la tiene, lo cancela (canceled true),
     * porque las copias se conservan a disposición de la STPS (artículo 26, fracción III).
     *
     * DELETE /v1/training_courses/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: 'training_course', deleted: bool, canceled: bool}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-training-course
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/training_courses/' . rawurlencode($id), [], $options);
    }

    /**
     * Quién tomó un curso
     *
     * Reemplaza la lista de quienes lo tomaron (emp_…). Quien ya tiene su constancia se queda.
     *
     * POST /v1/training_courses/{id}/participants
     *
     * @param string $id
     * @param array{employees: list<string>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'training_course',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality: string,
     *     trainer_kind: string,
     *     trainer_name: string|null,
     *     start_date: string,
     *     end_date: string,
     *     canceled: bool,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     signers_problem?: string|null,
     *     participants?: list<array{id: string, object: 'training_participant', employee: string, name: string, occupation: string|null, result: string, score: float|int|null, note: string|null, folio: int|null, issued_at: string|null, delivered_at: string|null, delivered_via: string|null, status: string, deliver_by: string|null, expires_on: string|null, blocker: string|null}>,
     *     counts?: array{participants: int, passed: int, pending: int, issued: int, delivered: int, due: int, late: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/set-training-participants
     */
    public function setParticipants(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/training_courses/' . rawurlencode($id) . '/participants', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Calificar un curso
     *
     * El resultado de cada quien: pending, passed, failed o sufficiency (aprobó el examen de
     * suficiencia, artículo 24, fracción III, inciso b), con su calificación. A quien ya tiene su
     * constancia no se le puede poner failed.
     *
     * POST /v1/training_courses/{id}/results
     *
     * @param string $id
     * @param array{
     *     results: list<array{employee: string, result: 'pending'|'passed'|'failed'|'sufficiency', score?: float|int|null, note?: string|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'training_course',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality: string,
     *     trainer_kind: string,
     *     trainer_name: string|null,
     *     start_date: string,
     *     end_date: string,
     *     canceled: bool,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     signers_problem?: string|null,
     *     participants?: list<array{id: string, object: 'training_participant', employee: string, name: string, occupation: string|null, result: string, score: float|int|null, note: string|null, folio: int|null, issued_at: string|null, delivered_at: string|null, delivered_via: string|null, status: string, deliver_by: string|null, expires_on: string|null, blocker: string|null}>,
     *     counts?: array{participants: int, passed: int, pending: int, issued: int, delivered: int, due: int, late: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/set-training-results
     */
    public function setResults(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/training_courses/' . rawurlencode($id) . '/results', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Emitir constancias DC-3
     *
     * Emite la constancia de quienes aprobaron (o de los que mande en employees), cada una con el
     * folio siguiente del emisor. Pide que el curso haya terminado (salvo el examen de
     * suficiencia), el CURP y la ocupación de cada quien y quién firma; lo que falte se lee en
     * blocker de cada participante.
     *
     * POST /v1/training_courses/{id}/issue
     *
     * @param string $id
     * @param array{employees?: list<string>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'training_course',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality: string,
     *     trainer_kind: string,
     *     trainer_name: string|null,
     *     start_date: string,
     *     end_date: string,
     *     canceled: bool,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     signers_problem?: string|null,
     *     participants?: list<array{id: string, object: 'training_participant', employee: string, name: string, occupation: string|null, result: string, score: float|int|null, note: string|null, folio: int|null, issued_at: string|null, delivered_at: string|null, delivered_via: string|null, status: string, deliver_by: string|null, expires_on: string|null, blocker: string|null}>,
     *     counts?: array{participants: int, passed: int, pending: int, issued: int, delivered: int, due: int, late: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/issue-training-certificates
     */
    public function issue(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/training_courses/' . rawurlencode($id) . '/issue', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Marcar constancias como entregadas
     *
     * Anota que se entregaron (en papel, por correo o en el portal del empleado) y el día. Por
     * omisión todas las emitidas sin entregar.
     *
     * POST /v1/training_courses/{id}/deliver
     *
     * @param string $id
     * @param array{
     *     employees?: list<string>,
     *     delivered_on?: string,
     *     via?: 'paper'|'email'|'portal',
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'training_course',
     *     livemode: bool,
     *     issuer: string,
     *     name: string,
     *     thematic_area: string,
     *     hours: float|int,
     *     modality: string,
     *     trainer_kind: string,
     *     trainer_name: string|null,
     *     start_date: string,
     *     end_date: string,
     *     canceled: bool,
     *     trainer_registration?: string|null,
     *     instructor_name?: string|null,
     *     validity_months?: int|null,
     *     passing_score?: float|int|null,
     *     place?: string|null,
     *     objective?: string|null,
     *     signers_problem?: string|null,
     *     participants?: list<array{id: string, object: 'training_participant', employee: string, name: string, occupation: string|null, result: string, score: float|int|null, note: string|null, folio: int|null, issued_at: string|null, delivered_at: string|null, delivered_via: string|null, status: string, deliver_by: string|null, expires_on: string|null, blocker: string|null}>,
     *     counts?: array{participants: int, passed: int, pending: int, issued: int, delivered: int, due: int, late: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/deliver-training-certificates
     */
    public function deliver(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/training_courses/' . rawurlencode($id) . '/deliver', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Descargar constancias DC-3
     *
     * Las constancias emitidas del curso en el formato DC-3 de la STPS, una página cada una con su
     * reverso de catálogos, listas para firmar. El logo de la empresa va si lo tiene (artículo 25:
     * solo logotipos).
     *
     * GET /v1/training_courses/{id}/pdf
     *
     * @param string $id
     * @param array{employees?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-training-certificates-pdf
     */
    public function pdf(string $id, array $params = [], array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/training_courses/' . rawurlencode($id) . '/pdf', ['query' => $params, 'as' => 'bytes'], $options);
    }
}
