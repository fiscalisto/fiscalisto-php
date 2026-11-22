<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->climateSurveys.
 */
final class ClimateSurveys
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar encuestas de clima laboral
     *
     * Las encuestas NOM-035 y de clima del emisor (cls_…), las más recientes primero, con a
     * cuántos se les pidió y cuántos contestaron.
     *
     * GET /v1/climate_surveys
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'climate_survey', livemode: bool, issuer: string, kind: string, title: string, branch: string|null, centro: string, guide: string|null, guide_i: bool, sample: bool, status: string, closes_on: string|null, workers: int|null, invited: int, answered: int, created_at: string, opened_at: string|null, closed_at: string|null, questions?: list<array<string, mixed>>, report?: array<string, mixed>, results?: array<string, mixed>, invites?: list<array<string, mixed>>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-climate-surveys
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/climate_surveys', $params, $options);
    }

    /**
     * Crear una encuesta de clima laboral
     *
     * kind nom035 aplica la guía que le toca al centro de trabajo por cuántos trabajan ahí hoy: la
     * Guía II de 16 a 50 y la Guía III con más de 50 (numeral 7.1), y la Guía I para identificar a
     * quien vivió un acontecimiento traumático severo (numeral 5.5). Un centro tiene una sola
     * encuesta NOM-035 abierta a la vez. kind clima es una encuesta propia con sus preguntas
     * (scale, nps para el eNPS, choice o text). Queda en borrador salvo con open true. Las
     * respuestas llegan solo desde el portal del empleado y nunca con nombre.
     *
     * POST /v1/climate_surveys
     *
     * @param array{
     *     issuer?: string,
     *     kind: 'nom035'|'clima',
     *     title?: string|null,
     *     branch?: string|null,
     *     guide_i?: bool,
     *     sample?: bool,
     *     questions?: list<array{id: string, text: string, type: 'scale'|'nps'|'choice'|'text', options?: list<string>, required?: bool}>,
     *     closes_on?: string|null,
     *     open?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_survey',
     *     livemode: bool,
     *     issuer: string,
     *     kind: string,
     *     title: string,
     *     branch: string|null,
     *     centro: string,
     *     guide: string|null,
     *     guide_i: bool,
     *     sample: bool,
     *     status: string,
     *     closes_on: string|null,
     *     workers: int|null,
     *     invited: int,
     *     answered: int,
     *     created_at: string,
     *     opened_at: string|null,
     *     closed_at: string|null,
     *     questions?: list<array{id: string, text: string, type: string, options: list<string>|null, required: bool}>,
     *     report?: array{address: string|null, activity: string|null, objective: string|null, activities: string|null, conclusions: string|null, responsible: string|null, license: string|null},
     *     results?: array{invited: int, answered: int, min_group: int, hidden: bool, nom035: array<string, mixed>|null, climate: list<array<string, mixed>>|null, traumatic: array<string, mixed>|null},
     *     invites?: list<array{employee: string, name: string, answered: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-climate-survey
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_surveys', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver una encuesta de clima laboral
     *
     * La encuesta con sus resultados: con la NOM-035, la calificación final y la de cada categoría
     * y dominio con su nivel de riesgo según las tablas de la norma, y si pide un Programa de
     * intervención (de medio para arriba, numeral 8.3); con la de clima, cada pregunta y el eNPS.
     * Los resultados se muestran desde 5 respuestas (hidden true antes), y los departamentos con
     * menos se dejan fuera, para que no se distinga lo que contestó cada quien. invites dice a
     * quién se le pidió y si ya contestó, no qué.
     *
     * GET /v1/climate_surveys/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_survey',
     *     livemode: bool,
     *     issuer: string,
     *     kind: string,
     *     title: string,
     *     branch: string|null,
     *     centro: string,
     *     guide: string|null,
     *     guide_i: bool,
     *     sample: bool,
     *     status: string,
     *     closes_on: string|null,
     *     workers: int|null,
     *     invited: int,
     *     answered: int,
     *     created_at: string,
     *     opened_at: string|null,
     *     closed_at: string|null,
     *     questions?: list<array{id: string, text: string, type: string, options: list<string>|null, required: bool}>,
     *     report?: array{address: string|null, activity: string|null, objective: string|null, activities: string|null, conclusions: string|null, responsible: string|null, license: string|null},
     *     results?: array{invited: int, answered: int, min_group: int, hidden: bool, nom035: array<string, mixed>|null, climate: list<array<string, mixed>>|null, traumatic: array<string, mixed>|null},
     *     invites?: list<array{employee: string, name: string, answered: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-climate-survey
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/climate_surveys/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar una encuesta de clima laboral
     *
     * Cambia un borrador. Una encuesta abierta o cerrada ya no cambia, porque hay quien contestó
     * esas preguntas: ciérrela y haga otra.
     *
     * POST /v1/climate_surveys/{id}
     *
     * @param string $id
     * @param array{
     *     issuer?: string,
     *     kind: 'nom035'|'clima',
     *     title?: string|null,
     *     branch?: string|null,
     *     guide_i?: bool,
     *     sample?: bool,
     *     questions?: list<array{id: string, text: string, type: 'scale'|'nps'|'choice'|'text', options?: list<string>, required?: bool}>,
     *     closes_on?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_survey',
     *     livemode: bool,
     *     issuer: string,
     *     kind: string,
     *     title: string,
     *     branch: string|null,
     *     centro: string,
     *     guide: string|null,
     *     guide_i: bool,
     *     sample: bool,
     *     status: string,
     *     closes_on: string|null,
     *     workers: int|null,
     *     invited: int,
     *     answered: int,
     *     created_at: string,
     *     opened_at: string|null,
     *     closed_at: string|null,
     *     questions?: list<array{id: string, text: string, type: string, options: list<string>|null, required: bool}>,
     *     report?: array{address: string|null, activity: string|null, objective: string|null, activities: string|null, conclusions: string|null, responsible: string|null, license: string|null},
     *     results?: array{invited: int, answered: int, min_group: int, hidden: bool, nom035: array<string, mixed>|null, climate: list<array<string, mixed>>|null, traumatic: array<string, mixed>|null},
     *     invites?: list<array{employee: string, name: string, answered: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-climate-survey
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_surveys/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una encuesta de clima laboral
     *
     * La borra si nadie la ha contestado. Con respuestas se conserva: los resultados se guardan al
     * menos un año (numeral 5.8).
     *
     * DELETE /v1/climate_surveys/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: 'climate_survey', deleted: bool}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-climate-survey
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/climate_surveys/' . rawurlencode($id), [], $options);
    }

    /**
     * Abrir una encuesta de clima laboral
     *
     * Invita a quien trabaja hoy en el centro (o a la muestra, con sample) y la encuesta aparece
     * en su portal. Con la NOM-035 no se abre si el centro ya tiene otra abierta.
     *
     * POST /v1/climate_surveys/{id}/open
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_survey',
     *     livemode: bool,
     *     issuer: string,
     *     kind: string,
     *     title: string,
     *     branch: string|null,
     *     centro: string,
     *     guide: string|null,
     *     guide_i: bool,
     *     sample: bool,
     *     status: string,
     *     closes_on: string|null,
     *     workers: int|null,
     *     invited: int,
     *     answered: int,
     *     created_at: string,
     *     opened_at: string|null,
     *     closed_at: string|null,
     *     questions?: list<array{id: string, text: string, type: string, options: list<string>|null, required: bool}>,
     *     report?: array{address: string|null, activity: string|null, objective: string|null, activities: string|null, conclusions: string|null, responsible: string|null, license: string|null},
     *     results?: array{invited: int, answered: int, min_group: int, hidden: bool, nom035: array<string, mixed>|null, climate: list<array<string, mixed>>|null, traumatic: array<string, mixed>|null},
     *     invites?: list<array{employee: string, name: string, answered: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/open-climate-survey
     */
    public function open(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_surveys/' . rawurlencode($id) . '/open', ['idempotent' => true], $options);
    }

    /**
     * Cerrar una encuesta de clima laboral
     *
     * Deja de recibir respuestas. Una NOM-035 cerrada cuenta como la identificación del centro de
     * trabajo, y la siguiente toca dos años después (numeral 7.9).
     *
     * POST /v1/climate_surveys/{id}/close
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_survey',
     *     livemode: bool,
     *     issuer: string,
     *     kind: string,
     *     title: string,
     *     branch: string|null,
     *     centro: string,
     *     guide: string|null,
     *     guide_i: bool,
     *     sample: bool,
     *     status: string,
     *     closes_on: string|null,
     *     workers: int|null,
     *     invited: int,
     *     answered: int,
     *     created_at: string,
     *     opened_at: string|null,
     *     closed_at: string|null,
     *     questions?: list<array{id: string, text: string, type: string, options: list<string>|null, required: bool}>,
     *     report?: array{address: string|null, activity: string|null, objective: string|null, activities: string|null, conclusions: string|null, responsible: string|null, license: string|null},
     *     results?: array{invited: int, answered: int, min_group: int, hidden: bool, nom035: array<string, mixed>|null, climate: list<array<string, mixed>>|null, traumatic: array<string, mixed>|null},
     *     invites?: list<array{employee: string, name: string, answered: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/close-climate-survey
     */
    public function close(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_surveys/' . rawurlencode($id) . '/close', ['idempotent' => true], $options);
    }

    /**
     * Guardar el informe de una encuesta
     *
     * Solo de la NOM-035: lo que pide el informe de resultados además de lo que calcula Fiscalisto
     * (numeral 7.7): domicilio y actividad del centro, objetivo, actividades, conclusiones y el
     * responsable de la evaluación. Lo que no manda no cambia.
     *
     * POST /v1/climate_surveys/{id}/report
     *
     * @param string $id
     * @param array{
     *     address?: string|null,
     *     activity?: string|null,
     *     objective?: string|null,
     *     activities?: string|null,
     *     conclusions?: string|null,
     *     responsible?: string|null,
     *     license?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'climate_survey',
     *     livemode: bool,
     *     issuer: string,
     *     kind: string,
     *     title: string,
     *     branch: string|null,
     *     centro: string,
     *     guide: string|null,
     *     guide_i: bool,
     *     sample: bool,
     *     status: string,
     *     closes_on: string|null,
     *     workers: int|null,
     *     invited: int,
     *     answered: int,
     *     created_at: string,
     *     opened_at: string|null,
     *     closed_at: string|null,
     *     questions?: list<array{id: string, text: string, type: string, options: list<string>|null, required: bool}>,
     *     report?: array{address: string|null, activity: string|null, objective: string|null, activities: string|null, conclusions: string|null, responsible: string|null, license: string|null},
     *     results?: array{invited: int, answered: int, min_group: int, hidden: bool, nom035: array<string, mixed>|null, climate: list<array<string, mixed>>|null, traumatic: array<string, mixed>|null},
     *     invites?: list<array{employee: string, name: string, answered: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-climate-survey-report
     */
    public function updateReport(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_surveys/' . rawurlencode($id) . '/report', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar acontecimientos traumáticos
     *
     * Quienes contestaron «Sí» en la Guía I, con su nombre, porque el patrón debe canalizar a
     * quien lo requiera para su atención (numeral 5.5), y si requiere valoración clínica según la
     * guía. Es lo único de una encuesta que lleva nombre.
     *
     * GET /v1/climate_surveys/{id}/traumatic_events
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{object: 'climate_traumatic_event', survey: string, employee: string, name: string, needs_attention: bool, answered_on: string, referred_to: string|null, referred_on: string|null, note: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-climate-traumatic-events
     */
    public function traumaticEvents(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/climate_surveys/' . rawurlencode($id) . '/traumatic_events', [], $options);
    }

    /**
     * Anotar a dónde se canalizó a un trabajador
     *
     * A dónde se canalizó a quien vivió un acontecimiento traumático severo (el IMSS, un médico,
     * un psicólogo), cuándo y una nota. Lo que no manda se borra.
     *
     * POST /v1/climate_surveys/{id}/referrals
     *
     * @param string $id
     * @param array{
     *     employee: string,
     *     referred_to?: string|null,
     *     referred_on?: string|null,
     *     note?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'climate_traumatic_event',
     *     survey: string,
     *     employee: string,
     *     name: string,
     *     needs_attention: bool,
     *     answered_on: string,
     *     referred_to: string|null,
     *     referred_on: string|null,
     *     note: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/refer-climate-traumatic-event
     */
    public function refer(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate_surveys/' . rawurlencode($id) . '/referrals', ['body' => $params, 'idempotent' => true], $options);
    }
}
