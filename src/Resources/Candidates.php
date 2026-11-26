<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->candidates.
 */
final class Candidates
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar candidatos
     *
     * Las solicitudes que llegaron por la página de empleos, las más recientes primero, con sus
     * respuestas, su etapa y los requisitos que no cumple.
     *
     * GET /v1/candidates
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     vacancy?: string,
     *     stage?: string,
     *     'created[gte]'?: string,
     *     'created[gt]'?: string,
     *     'created[lte]'?: string,
     *     'created[lt]'?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'candidate', livemode: bool, issuer: string, vacancy: string, name: string, email: string, phone: string|null, stage: string, rating: int|null, note: string|null, meets_requirements: bool, unmet_requirements: list<string>, answers: list<array<string, mixed>>, employee: string|null, created_at: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-candidates
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/candidates', $params, $options);
    }

    /**
     * Ver un candidato
     *
     * Una solicitud (cnd_…), con las preguntas que contestó y sus archivos.
     *
     * GET /v1/candidates/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'candidate',
     *     livemode: bool,
     *     issuer: string,
     *     vacancy: string,
     *     name: string,
     *     email: string,
     *     phone: string|null,
     *     stage: string,
     *     rating: int|null,
     *     note: string|null,
     *     meets_requirements: bool,
     *     unmet_requirements: list<string>,
     *     answers: list<array{question: string, label: string, type: string, value: string|list<string>|null, file: array<string, mixed>|null}>,
     *     employee: string|null,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-candidate
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/candidates/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar un candidato
     *
     * Lo pasa a otra etapa, lo califica (1 a 5) o le pone una nota de su equipo. Lo que no manda
     * no cambia.
     *
     * POST /v1/candidates/{id}
     *
     * @param string $id
     * @param array{stage?: string, rating?: int|null, note?: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'candidate',
     *     livemode: bool,
     *     issuer: string,
     *     vacancy: string,
     *     name: string,
     *     email: string,
     *     phone: string|null,
     *     stage: string,
     *     rating: int|null,
     *     note: string|null,
     *     meets_requirements: bool,
     *     unmet_requirements: list<string>,
     *     answers: list<array{question: string, label: string, type: string, value: string|list<string>|null, file: array<string, mixed>|null}>,
     *     employee: string|null,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-candidate
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/candidates/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un candidato
     *
     * Borra la solicitud y sus archivos, por ejemplo cuando el candidato lo pide (derechos ARCO).
     * No se puede deshacer.
     *
     * DELETE /v1/candidates/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-candidate
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/candidates/' . rawurlencode($id), [], $options);
    }

    /**
     * Contratar a un candidato
     *
     * Con el empleado ya dado de alta (POST /v1/employees), cubre la vacante de la solicitud (como
     * POST /v1/payroll_org_chart/vacancies/{id}/fill), pasa al candidato a la etapa de contratados
     * y quita la vacante de la página. Falta su alta en el IMSS.
     *
     * POST /v1/candidates/{id}/hire
     *
     * @param string $id
     * @param array{employee: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'candidate',
     *     livemode: bool,
     *     issuer: string,
     *     vacancy: string,
     *     name: string,
     *     email: string,
     *     phone: string|null,
     *     stage: string,
     *     rating: int|null,
     *     note: string|null,
     *     meets_requirements: bool,
     *     unmet_requirements: list<string>,
     *     answers: list<array{question: string, label: string, type: string, value: string|list<string>|null, file: array<string, mixed>|null}>,
     *     employee: string|null,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/hire-candidate
     */
    public function hire(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/candidates/' . rawurlencode($id) . '/hire', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Descargar un archivo de un candidato
     *
     * El archivo que subió a una pregunta de tipo file (su CV, por ejemplo), tal como lo subió:
     * PDF, JPG, PNG o Word. answers[].file.url de candidate lleva esta ruta.
     *
     * GET /v1/candidates/{id}/files/{question}
     *
     * @param string $id
     * @param string $question
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-candidate-file
     */
    public function file(string $id, string $question, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/candidates/' . rawurlencode($id) . '/files/' . rawurlencode($question), ['as' => 'text'], $options);
    }
}
