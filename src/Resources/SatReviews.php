<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->satReviews.
 */
final class SatReviews
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Registrar una revisión del SAT
     *
     * Como «Registrar oficio» en Revisiones del SAT: una carta invitación, requerimiento u oficio
     * que el SAT mandó al RFC del emisor, con la fecha en que se lo notificaron. Fiscalisto
     * calcula el plazo en días hábiles desde que surte efectos la notificación (sin sábados,
     * domingos ni los inhábiles del SAT) y avisa por correo 5, 3 y 1 día hábil antes. Sin
     * requests, lleva lo que el SAT suele pedir en ese tipo. No responde nada al SAT. No usa
     * timbres.
     *
     * POST /v1/sat_reviews
     *
     * @param array{
     *     issuer?: string,
     *     type: 'invitation_letter'|'return_clarification'|'missing_returns'|'desk_audit'|'field_audit'|'electronic_audit'|'supplier_69b'|'presumption_69b'|'csd_restriction'|'tax_discrepancy'|'refund'|'other',
     *     notices: list<array{step?: string, notified_on: string, business_days?: int|null, extension?: bool, answered_on?: string|null}>,
     *     requests?: list<array{key: 'working_paper'|'tax_discrepancy'|'issued_invoices'|'received_invoices'|'retentions'|'tax_returns'|'electronic_accounting'|'materiality'|'bank_statements'|'contracts'|'inventory'|'assets_and_staff'|'articles_and_power'|'written_answer'|'other', name?: string, done?: bool, note?: string}>,
     *     status?: 'open'|'answered'|'concluded'|'assessed'|'in_defense'|'closed',
     *     reference?: string|null,
     *     order_number?: string|null,
     *     authority?: string|null,
     *     period_start?: string|null,
     *     period_end?: string|null,
     *     amount?: float|int|null,
     *     notes?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_review',
     *     issuer: string,
     *     type: 'invitation_letter'|'return_clarification'|'missing_returns'|'desk_audit'|'field_audit'|'electronic_audit'|'supplier_69b'|'presumption_69b'|'csd_restriction'|'tax_discrepancy'|'refund'|'other',
     *     type_name: string,
     *     status: 'open'|'answered'|'concluded'|'assessed'|'in_defense'|'closed',
     *     status_name: string,
     *     reference: string|null,
     *     order_number: string|null,
     *     authority: string|null,
     *     period_start: string|null,
     *     period_end: string|null,
     *     amount: float|int|null,
     *     due_on: string|null,
     *     business_days_left: int|null,
     *     sat_must_conclude_by: string|null,
     *     notices: list<array{step: string, name: string, notified_on: string, effective_on: string, business_days: int|null, extension: bool, due_on: string|null, business_days_left: int|null, answered_on: string|null, law: string, conclusive_agreement_until: string|null}>,
     *     requests: list<array{key: 'working_paper'|'tax_discrepancy'|'issued_invoices'|'received_invoices'|'retentions'|'tax_returns'|'electronic_accounting'|'materiality'|'bank_statements'|'contracts'|'inventory'|'assets_and_staff'|'articles_and_power'|'written_answer'|'other', name: string, made_by: 'fiscalisto'|'you', done: bool, note: string|null, have: string|null, documents: int, ready: bool}>,
     *     ready: int,
     *     total: int,
     *     answer: array{status: 'processing'|'completed'|'failed'|'expired', size_bytes: int|null, error: string|null, created_at: string, completed_at: string|null, expires_at: string|null}|null,
     *     notes: string|null,
     *     created_at: string,
     *     updated_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/create-sat-review
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_reviews', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar revisiones del SAT
     *
     * Las revisiones del RFC del emisor, primero las que siguen abiertas, después las más
     * recientes, cada una con su plazo y lo que pide. Una página, hasta 500.
     *
     * GET /v1/sat_reviews
     *
     * @param array{
     *     issuer?: string,
     *     status?: 'open'|'answered'|'concluded'|'assessed'|'in_defense'|'closed',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'sat_review', issuer: string, type: 'invitation_letter'|'return_clarification'|'missing_returns'|'desk_audit'|'field_audit'|'electronic_audit'|'supplier_69b'|'presumption_69b'|'csd_restriction'|'tax_discrepancy'|'refund'|'other', type_name: string, status: 'open'|'answered'|'concluded'|'assessed'|'in_defense'|'closed', status_name: string, reference: string|null, order_number: string|null, authority: string|null, period_start: string|null, period_end: string|null, amount: float|int|null, due_on: string|null, business_days_left: int|null, sat_must_conclude_by: string|null, notices: list<array<string, mixed>>, requests: list<array<string, mixed>>, ready: int, total: int, answer: array<string, mixed>|null, notes: string|null, created_at: string, updated_at: string}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/list-sat-reviews
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_reviews', ['query' => $params], $options);
    }

    /**
     * Ver una revisión del SAT
     *
     * Una revisión con cada oficio y su plazo, lo que pide con cuánto de eso tiene Fiscalisto
     * (ready de total) y su última respuesta armada.
     *
     * GET /v1/sat_reviews/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_review',
     *     issuer: string,
     *     type: 'invitation_letter'|'return_clarification'|'missing_returns'|'desk_audit'|'field_audit'|'electronic_audit'|'supplier_69b'|'presumption_69b'|'csd_restriction'|'tax_discrepancy'|'refund'|'other',
     *     type_name: string,
     *     status: 'open'|'answered'|'concluded'|'assessed'|'in_defense'|'closed',
     *     status_name: string,
     *     reference: string|null,
     *     order_number: string|null,
     *     authority: string|null,
     *     period_start: string|null,
     *     period_end: string|null,
     *     amount: float|int|null,
     *     due_on: string|null,
     *     business_days_left: int|null,
     *     sat_must_conclude_by: string|null,
     *     notices: list<array{step: string, name: string, notified_on: string, effective_on: string, business_days: int|null, extension: bool, due_on: string|null, business_days_left: int|null, answered_on: string|null, law: string, conclusive_agreement_until: string|null}>,
     *     requests: list<array{key: 'working_paper'|'tax_discrepancy'|'issued_invoices'|'received_invoices'|'retentions'|'tax_returns'|'electronic_accounting'|'materiality'|'bank_statements'|'contracts'|'inventory'|'assets_and_staff'|'articles_and_power'|'written_answer'|'other', name: string, made_by: 'fiscalisto'|'you', done: bool, note: string|null, have: string|null, documents: int, ready: bool}>,
     *     ready: int,
     *     total: int,
     *     answer: array{status: 'processing'|'completed'|'failed'|'expired', size_bytes: int|null, error: string|null, created_at: string, completed_at: string|null, expires_at: string|null}|null,
     *     notes: string|null,
     *     created_at: string,
     *     updated_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-sat-review
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_reviews/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar una revisión del SAT
     *
     * Cambia solo lo que manda. notices y requests reemplazan la lista: mande todos sus oficios
     * (con answered_on en el que ya respondió) y todo lo que pide (con done en lo que ya tiene).
     *
     * POST /v1/sat_reviews/{id}
     *
     * @param string $id
     * @param array{
     *     type?: 'invitation_letter'|'return_clarification'|'missing_returns'|'desk_audit'|'field_audit'|'electronic_audit'|'supplier_69b'|'presumption_69b'|'csd_restriction'|'tax_discrepancy'|'refund'|'other',
     *     notices?: list<array{step?: string, notified_on: string, business_days?: int|null, extension?: bool, answered_on?: string|null}>,
     *     requests?: list<array{key: 'working_paper'|'tax_discrepancy'|'issued_invoices'|'received_invoices'|'retentions'|'tax_returns'|'electronic_accounting'|'materiality'|'bank_statements'|'contracts'|'inventory'|'assets_and_staff'|'articles_and_power'|'written_answer'|'other', name?: string, done?: bool, note?: string}>,
     *     status?: 'open'|'answered'|'concluded'|'assessed'|'in_defense'|'closed',
     *     reference?: string|null,
     *     order_number?: string|null,
     *     authority?: string|null,
     *     period_start?: string|null,
     *     period_end?: string|null,
     *     amount?: float|int|null,
     *     notes?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_review',
     *     issuer: string,
     *     type: 'invitation_letter'|'return_clarification'|'missing_returns'|'desk_audit'|'field_audit'|'electronic_audit'|'supplier_69b'|'presumption_69b'|'csd_restriction'|'tax_discrepancy'|'refund'|'other',
     *     type_name: string,
     *     status: 'open'|'answered'|'concluded'|'assessed'|'in_defense'|'closed',
     *     status_name: string,
     *     reference: string|null,
     *     order_number: string|null,
     *     authority: string|null,
     *     period_start: string|null,
     *     period_end: string|null,
     *     amount: float|int|null,
     *     due_on: string|null,
     *     business_days_left: int|null,
     *     sat_must_conclude_by: string|null,
     *     notices: list<array{step: string, name: string, notified_on: string, effective_on: string, business_days: int|null, extension: bool, due_on: string|null, business_days_left: int|null, answered_on: string|null, law: string, conclusive_agreement_until: string|null}>,
     *     requests: list<array{key: 'working_paper'|'tax_discrepancy'|'issued_invoices'|'received_invoices'|'retentions'|'tax_returns'|'electronic_accounting'|'materiality'|'bank_statements'|'contracts'|'inventory'|'assets_and_staff'|'articles_and_power'|'written_answer'|'other', name: string, made_by: 'fiscalisto'|'you', done: bool, note: string|null, have: string|null, documents: int, ready: bool}>,
     *     ready: int,
     *     total: int,
     *     answer: array{status: 'processing'|'completed'|'failed'|'expired', size_bytes: int|null, error: string|null, created_at: string, completed_at: string|null, expires_at: string|null}|null,
     *     notes: string|null,
     *     created_at: string,
     *     updated_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/update-sat-review
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_reviews/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una revisión del SAT
     *
     * Borra de Fiscalisto el seguimiento, sus avisos y los enlaces de sus asesores; su trámite en
     * el SAT sigue igual. No se puede deshacer.
     *
     * DELETE /v1/sat_reviews/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/delete-sat-review
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/sat_reviews/' . rawurlencode($id), [], $options);
    }

    /**
     * Armar la respuesta
     *
     * Como «Armar respuesta»: arma en segundo plano un ZIP con lo que la revisión pide: los XML y
     * la relación de CFDI del periodo, el papel de trabajo, la contabilidad electrónica con el
     * número de orden, las declaraciones, los documentos subidos en la app y un índice de qué
     * archivo responde a cada cosa. Contesta la revisión con answer.status processing; consulte
     * GET /v1/sat_reviews/{id} hasta que sea completed y descárguelo con GET
     * /v1/sat_reviews/{id}/answer. Una a la vez (answer_running). No usa timbres.
     *
     * POST /v1/sat_reviews/{id}/answer
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_review',
     *     issuer: string,
     *     type: 'invitation_letter'|'return_clarification'|'missing_returns'|'desk_audit'|'field_audit'|'electronic_audit'|'supplier_69b'|'presumption_69b'|'csd_restriction'|'tax_discrepancy'|'refund'|'other',
     *     type_name: string,
     *     status: 'open'|'answered'|'concluded'|'assessed'|'in_defense'|'closed',
     *     status_name: string,
     *     reference: string|null,
     *     order_number: string|null,
     *     authority: string|null,
     *     period_start: string|null,
     *     period_end: string|null,
     *     amount: float|int|null,
     *     due_on: string|null,
     *     business_days_left: int|null,
     *     sat_must_conclude_by: string|null,
     *     notices: list<array{step: string, name: string, notified_on: string, effective_on: string, business_days: int|null, extension: bool, due_on: string|null, business_days_left: int|null, answered_on: string|null, law: string, conclusive_agreement_until: string|null}>,
     *     requests: list<array{key: 'working_paper'|'tax_discrepancy'|'issued_invoices'|'received_invoices'|'retentions'|'tax_returns'|'electronic_accounting'|'materiality'|'bank_statements'|'contracts'|'inventory'|'assets_and_staff'|'articles_and_power'|'written_answer'|'other', name: string, made_by: 'fiscalisto'|'you', done: bool, note: string|null, have: string|null, documents: int, ready: bool}>,
     *     ready: int,
     *     total: int,
     *     answer: array{status: 'processing'|'completed'|'failed'|'expired', size_bytes: int|null, error: string|null, created_at: string, completed_at: string|null, expires_at: string|null}|null,
     *     notes: string|null,
     *     created_at: string,
     *     updated_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/arm-sat-review-answer
     */
    public function armAnswer(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_reviews/' . rawurlencode($id) . '/answer', ['idempotent' => true], $options);
    }

    /**
     * Descargar la respuesta
     *
     * El ZIP de la última respuesta armada, cuando answer.status es completed (si no,
     * answer_not_ready). Se guarda 30 días.
     *
     * GET /v1/sat_reviews/{id}/answer
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/download-sat-review-answer
     */
    public function downloadAnswer(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_reviews/' . rawurlencode($id) . '/answer', ['as' => 'text'], $options);
    }
}
