<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->hiring.
 */
final class Hiring
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Página de empleos
     *
     * Como «Nómina › Empleos» de la app: la página de empleos del emisor (careers_url, si se ve,
     * su texto, el correo de contacto), las etapas de sus candidatos, qué hacer con quien no
     * cumple un requisito, sus formularios (jbf_…) y sus vacantes con lo que publican y cuántos
     * candidatos hay en cada etapa.
     *
     * GET /v1/hiring
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'hiring',
     *     livemode: bool,
     *     issuer: string,
     *     careers_url: string,
     *     enabled: bool,
     *     intro: string|null,
     *     contact_email: string|null,
     *     stages: list<string>,
     *     unmet_requirements: 'flag'|'warn',
     *     default_form: string|null,
     *     forms: list<array{id: string, object: 'job_form', name: string, questions: list<array<string, mixed>>}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, status: 'pending_approval'|'approved'|'rejected'|'filled', published: bool, url: string|null, description: string|null, requirements: list<string>, employment_type: 'full_time'|'part_time'|'fixed_term'|'project'|'internship'|null, workplace: 'on_site'|'hybrid'|'remote'|null, show_salary: bool, closes_on: string|null, form: string|null, candidates: list<array<string, mixed>>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-hiring
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/hiring', ['query' => $params], $options);
    }

    /**
     * Configurar la página de empleos
     *
     * Enciende o apaga la página, cambia su texto y correo de contacto, las etapas de los
     * candidatos (al menos dos; la primera es donde llegan), unmet_requirements y el formulario
     * predeterminado. Lo que no manda no cambia. Contesta hiring.
     *
     * POST /v1/hiring/settings
     *
     * @param array{
     *     issuer?: string,
     *     enabled?: bool,
     *     intro?: string|null,
     *     contact_email?: string|null,
     *     stages?: list<string>,
     *     unmet_requirements?: 'flag'|'warn',
     *     default_form?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'hiring',
     *     livemode: bool,
     *     issuer: string,
     *     careers_url: string,
     *     enabled: bool,
     *     intro: string|null,
     *     contact_email: string|null,
     *     stages: list<string>,
     *     unmet_requirements: 'flag'|'warn',
     *     default_form: string|null,
     *     forms: list<array{id: string, object: 'job_form', name: string, questions: list<array<string, mixed>>}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, status: 'pending_approval'|'approved'|'rejected'|'filled', published: bool, url: string|null, description: string|null, requirements: list<string>, employment_type: 'full_time'|'part_time'|'fixed_term'|'project'|'internship'|null, workplace: 'on_site'|'hybrid'|'remote'|null, show_salary: bool, closes_on: string|null, form: string|null, candidates: list<array<string, mixed>>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-hiring-settings
     */
    public function updateSettings(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/hiring/settings', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Crear un formulario de solicitud
     *
     * Las preguntas que llena quien se postula, del tipo que sea (texto, párrafo, número, fecha,
     * lista, varias opciones, sí o no, correo, teléfono, enlace o archivo), obligatorias u
     * opcionales, con sus reglas y las que son requisito. nombre y correo van siempre. Una
     * pregunta que la Ley Federal del Trabajo no deja pedir (art. 133: edad, género, estado civil,
     * embarazo…) se guarda, pero la app la señala.
     *
     * POST /v1/hiring/forms
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     questions: list<array{id?: string, label: string, help?: string|null, type: 'text'|'longtext'|'number'|'date'|'select'|'multiselect'|'yesno'|'email'|'phone'|'url'|'file', required: bool, options?: list<string>, files?: list<'pdf'|'image'|'doc'>, rules?: array{min_length?: int|null, max_length?: int|null, format?: 'any'|'digits'|'alnum'|null, min?: float|int|null, max?: float|null, integer?: bool|null, dates?: 'any'|'past'|'future'|'between'|null, days?: int|null, from?: string|null, to?: string|null, example?: string|null}|null, requirement?: array{answers?: list<string>, min?: float|int|null}|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'job_form',
     *     name: string,
     *     questions: list<array{id: string, label: string, help: string|null, type: 'text'|'longtext'|'number'|'date'|'select'|'multiselect'|'yesno'|'email'|'phone'|'url'|'file', required: bool, options: list<string>, files: list<'pdf'|'image'|'doc'>, rules: array<string, mixed>|null, requirement: array<string, mixed>|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-job-form
     */
    public function createForm(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/hiring/forms', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar un formulario de solicitud
     *
     * Cambia su nombre y sus preguntas. Las solicitudes que ya llegaron conservan las preguntas
     * que contestaron.
     *
     * POST /v1/hiring/forms/{id}
     *
     * @param string $id
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     questions: list<array{id?: string, label: string, help?: string|null, type: 'text'|'longtext'|'number'|'date'|'select'|'multiselect'|'yesno'|'email'|'phone'|'url'|'file', required: bool, options?: list<string>, files?: list<'pdf'|'image'|'doc'>, rules?: array{min_length?: int|null, max_length?: int|null, format?: 'any'|'digits'|'alnum'|null, min?: float|int|null, max?: float|null, integer?: bool|null, dates?: 'any'|'past'|'future'|'between'|null, days?: int|null, from?: string|null, to?: string|null, example?: string|null}|null, requirement?: array{answers?: list<string>, min?: float|int|null}|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'job_form',
     *     name: string,
     *     questions: list<array{id: string, label: string, help: string|null, type: 'text'|'longtext'|'number'|'date'|'select'|'multiselect'|'yesno'|'email'|'phone'|'url'|'file', required: bool, options: list<string>, files: list<'pdf'|'image'|'doc'>, rules: array<string, mixed>|null, requirement: array<string, mixed>|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-job-form
     */
    public function updateForm(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/hiring/forms/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Archivar un formulario de solicitud
     *
     * Deja de usarse: sus vacantes piden el predeterminado desde ahora. Las solicitudes que ya
     * llegaron no cambian.
     *
     * DELETE /v1/hiring/forms/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-job-form
     */
    public function deleteForm(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/hiring/forms/' . rawurlencode($id), [], $options);
    }
}
