<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Retenciones: $fiscalisto->retentions.
 */
final class Retentions
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Timbrar una constancia de retenciones
     *
     * Timbra una constancia de retenciones e información de pagos (Retenciones 2.0) con los folios
     * RET1, RET2… del emisor. Una vez por Idempotency-Key; con send_email y email la manda al
     * receptor al timbrarla.
     *
     * POST /v1/retentions
     *
     * @param array{
     *     issuer?: string,
     *     code: string,
     *     description?: string|null,
     *     recipient: array{foreign?: bool, tax_id?: string|null, legal_name: string, zip?: string, curp?: string|null},
     *     period: array{year: int, month?: int, from_month?: int, to_month?: int},
     *     totals: array{operation: float|int, taxed?: float|int, exempt?: float|int},
     *     taxes: list<array{tax: string, base: float|int, amount: float|int, payment_type?: string}>,
     *     dividends?: array{type: '01'|'02'|'03'|'04'|'05'|'06', isr_mexico: float|int, isr_foreign: float|int, foreign_retention?: float|int|null, company: 'nacional'|'extranjera', national_credit?: float|int|null, accumulated_national?: float|int|null, accumulated_foreign?: float|int|null},
     *     interest?: array{financial_system: bool, retirement: bool, derivatives: bool, nominal: float|int, real: float|int, loss: float|int},
     *     foreign_payment?: array{beneficiary: bool, country?: string|null, concept: '1'|'2'|'3'|'4'|'5'|'6'|'7'|'8'|'9', description: string, beneficiary_tax_id?: string|null, beneficiary_curp?: string|null, beneficiary_name?: string|null},
     *     trust_lease?: array{trustee_payment: float|int, income: float|int, deductions: float|int, withheld_total?: float|int|null, fibra_result?: float|int|null, other_amount?: float|int|null, other_description?: string|null},
     *     share_sale?: array{contract: string, gain: float|int, loss: float|int},
     *     prize?: array{state: string},
     *     trust?: array{income: array{concept: string, total: float|int, share: float|int, proportion: float|int}, deductions: array{concept: string, total: float|int, share: float|int, proportion: float|int}, withholding: array{amount: float|int, description: string}},
     *     retirement_plan?: array{financial_system: bool, contributions_last_year?: float|int|null, real_interest: float|int, early_withdrawals: bool, early_withdrawn?: float|int|null, exempt_withdrawn?: float|int|null, excess_withdrawn?: float|int|null, withdrawals: bool, withdrawn?: float|int|null, reference?: string|null, contributions?: list<array{type: 'a'|'b'|'c', amount: float|int, trustee_rfc?: string|null}>},
     *     mortgage_interest?: array{financial_institution: bool, outstanding_balance: float|int, deductible_proportion?: float|int|null, nominal_accrued?: float|int|null, nominal_accrued_paid?: float|int|null, real_deductible?: float|int|null, contract?: string|null},
     *     financial_derivatives?: array{gain: float|int, loss: float|int},
     *     send_email?: bool,
     *     email?: string,
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'retention',
     *     issuer: string,
     *     status: 'processing'|'valid'|'rejected'|'canceled',
     *     uuid: string|null,
     *     folio: int|null,
     *     internal_folio: string|null,
     *     date: string|null,
     *     code: string,
     *     description: string|null,
     *     recipient: array{foreign: bool, tax_id: string|null, legal_name: string|null, zip?: string, curp?: string|null},
     *     period: array{year: int, from_month: int, to_month: int},
     *     totals: array{operation: float|int|null, taxed: float|int|null, exempt: float|int|null, withheld: float|int|null},
     *     taxes: list<array{tax: string, base: float|int, amount: float|int, payment_type: string}>,
     *     dividends?: array<string, mixed>,
     *     interest?: array<string, mixed>,
     *     foreign_payment?: array<string, mixed>,
     *     trust_lease?: array<string, mixed>,
     *     share_sale?: array<string, mixed>,
     *     prize?: array<string, mixed>,
     *     trust?: array<string, mixed>,
     *     retirement_plan?: array<string, mixed>,
     *     mortgage_interest?: array<string, mixed>,
     *     financial_derivatives?: array<string, mixed>,
     *     cancellation: array{status: string, motive: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, sent_at: string|null}|null,
     *     error: array{message: string, sat_code: string|null, raw: string}|null,
     *     created_at: string|null,
     *     metadata: array<string, mixed>,
     *     warnings?: list<string>,
     *     email_error?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/retenciones/create-retention
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/retentions', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar constancias
     *
     * Las constancias del emisor, las más recientes primero.
     *
     * GET /v1/retentions
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'valid'|'canceled'|'rejected'|'processing',
     *     recipient?: string,
     *     year?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'retention', issuer: string, status: 'processing'|'valid'|'rejected'|'canceled', uuid: string|null, folio: int|null, internal_folio: string|null, date: string|null, code: string, description: string|null, recipient: array<string, mixed>, period: array<string, mixed>, totals: array<string, mixed>, taxes: list<array<string, mixed>>, dividends?: array<string, mixed>, interest?: array<string, mixed>, foreign_payment?: array<string, mixed>, trust_lease?: array<string, mixed>, share_sale?: array<string, mixed>, prize?: array<string, mixed>, trust?: array<string, mixed>, retirement_plan?: array<string, mixed>, mortgage_interest?: array<string, mixed>, financial_derivatives?: array<string, mixed>, cancellation: array<string, mixed>|null, email: array<string, mixed>|null, error: array<string, mixed>|null, created_at: string|null, metadata: array<string, mixed>, warnings?: list<string>, email_error?: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/retenciones/list-retentions
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/retentions', $params, $options);
    }

    /**
     * Ver una constancia
     *
     * Una constancia de retenciones con su estado, sus impuestos retenidos y, si se mandó, a
     * quién.
     *
     * GET /v1/retentions/{id}
     *
     * @param string $id
     * @param array{issuer?: string, refresh?: bool} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'retention',
     *     issuer: string,
     *     status: 'processing'|'valid'|'rejected'|'canceled',
     *     uuid: string|null,
     *     folio: int|null,
     *     internal_folio: string|null,
     *     date: string|null,
     *     code: string,
     *     description: string|null,
     *     recipient: array{foreign: bool, tax_id: string|null, legal_name: string|null, zip?: string, curp?: string|null},
     *     period: array{year: int, from_month: int, to_month: int},
     *     totals: array{operation: float|int|null, taxed: float|int|null, exempt: float|int|null, withheld: float|int|null},
     *     taxes: list<array{tax: string, base: float|int, amount: float|int, payment_type: string}>,
     *     dividends?: array<string, mixed>,
     *     interest?: array<string, mixed>,
     *     foreign_payment?: array<string, mixed>,
     *     trust_lease?: array<string, mixed>,
     *     share_sale?: array<string, mixed>,
     *     prize?: array<string, mixed>,
     *     trust?: array<string, mixed>,
     *     retirement_plan?: array<string, mixed>,
     *     mortgage_interest?: array<string, mixed>,
     *     financial_derivatives?: array<string, mixed>,
     *     cancellation: array{status: string, motive: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, sent_at: string|null}|null,
     *     error: array{message: string, sat_code: string|null, raw: string}|null,
     *     created_at: string|null,
     *     metadata: array<string, mixed>,
     *     warnings?: list<string>,
     *     email_error?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/retenciones/get-retention
     */
    public function get(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/retentions/' . rawurlencode($id), ['query' => $params], $options);
    }

    /**
     * Descargar el PDF
     *
     * La representación impresa de la constancia.
     *
     * GET /v1/retentions/{id}/pdf
     *
     * @param string $id
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/retenciones/get-retention-pdf
     */
    public function pdf(string $id, array $params = [], array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/retentions/' . rawurlencode($id) . '/pdf', ['query' => $params, 'as' => 'bytes'], $options);
    }

    /**
     * Descargar el XML
     *
     * El XML timbrado de la constancia, tal como lo tiene el SAT.
     *
     * GET /v1/retentions/{id}/xml
     *
     * @param string $id
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/retenciones/get-retention-xml
     */
    public function xml(string $id, array $params = [], array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/retentions/' . rawurlencode($id) . '/xml', ['query' => $params, 'as' => 'text'], $options);
    }

    /**
     * Enviar por correo
     *
     * Manda el PDF y el XML de la constancia a los correos de to (o al que se dio al timbrarla).
     * Dos envíos a la vez de la misma constancia: el segundo contesta email_failed.
     *
     * POST /v1/retentions/{id}/send
     *
     * @param string $id
     * @param array{to?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'retention',
     *     issuer: string,
     *     status: 'processing'|'valid'|'rejected'|'canceled',
     *     uuid: string|null,
     *     folio: int|null,
     *     internal_folio: string|null,
     *     date: string|null,
     *     code: string,
     *     description: string|null,
     *     recipient: array{foreign: bool, tax_id: string|null, legal_name: string|null, zip?: string, curp?: string|null},
     *     period: array{year: int, from_month: int, to_month: int},
     *     totals: array{operation: float|int|null, taxed: float|int|null, exempt: float|int|null, withheld: float|int|null},
     *     taxes: list<array{tax: string, base: float|int, amount: float|int, payment_type: string}>,
     *     dividends?: array<string, mixed>,
     *     interest?: array<string, mixed>,
     *     foreign_payment?: array<string, mixed>,
     *     trust_lease?: array<string, mixed>,
     *     share_sale?: array<string, mixed>,
     *     prize?: array<string, mixed>,
     *     trust?: array<string, mixed>,
     *     retirement_plan?: array<string, mixed>,
     *     mortgage_interest?: array<string, mixed>,
     *     financial_derivatives?: array<string, mixed>,
     *     cancellation: array{status: string, motive: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, sent_at: string|null}|null,
     *     error: array{message: string, sat_code: string|null, raw: string}|null,
     *     created_at: string|null,
     *     metadata: array<string, mixed>,
     *     warnings?: list<string>,
     *     email_error?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/retenciones/send-retention
     */
    public function send(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/retentions/' . rawurlencode($id) . '/send', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cancelar una constancia
     *
     * Se cancela en el momento (no espera aceptación). No usa timbres.
     *
     * POST /v1/retentions/{id}/cancel
     *
     * @param string $id
     * @param array{motive?: '01'|'02'|'03'|'04', substitution?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'retention',
     *     issuer: string,
     *     status: 'processing'|'valid'|'rejected'|'canceled',
     *     uuid: string|null,
     *     folio: int|null,
     *     internal_folio: string|null,
     *     date: string|null,
     *     code: string,
     *     description: string|null,
     *     recipient: array{foreign: bool, tax_id: string|null, legal_name: string|null, zip?: string, curp?: string|null},
     *     period: array{year: int, from_month: int, to_month: int},
     *     totals: array{operation: float|int|null, taxed: float|int|null, exempt: float|int|null, withheld: float|int|null},
     *     taxes: list<array{tax: string, base: float|int, amount: float|int, payment_type: string}>,
     *     dividends?: array<string, mixed>,
     *     interest?: array<string, mixed>,
     *     foreign_payment?: array<string, mixed>,
     *     trust_lease?: array<string, mixed>,
     *     share_sale?: array<string, mixed>,
     *     prize?: array<string, mixed>,
     *     trust?: array<string, mixed>,
     *     retirement_plan?: array<string, mixed>,
     *     mortgage_interest?: array<string, mixed>,
     *     financial_derivatives?: array<string, mixed>,
     *     cancellation: array{status: string, motive: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, sent_at: string|null}|null,
     *     error: array{message: string, sat_code: string|null, raw: string}|null,
     *     created_at: string|null,
     *     metadata: array<string, mixed>,
     *     warnings?: list<string>,
     *     email_error?: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/retenciones/cancel-retention
     */
    public function cancel(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/retentions/' . rawurlencode($id) . '/cancel', ['body' => $params, 'idempotent' => true], $options);
    }
}
