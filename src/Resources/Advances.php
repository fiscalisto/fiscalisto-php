<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Anticipos: $fiscalisto->advances.
 */
final class Advances
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Timbrar un anticipo
     *
     * La factura del anticipo: un concepto «Anticipo del bien o servicio» (84111506, ACT). amount
     * es lo que pagó el cliente con IVA.
     *
     * POST /v1/advances
     *
     * @param array{
     *     issuer?: string,
     *     customer: mixed,
     *     use?: string,
     *     amount: float|int,
     *     iva?: '0'|'0.16'|'0.08'|'exento',
     *     payment_form: string,
     *     currency?: string,
     *     exchange_rate?: float|int,
     *     series?: string,
     *     notes?: string,
     *     send_email?: bool,
     *     email_cc?: mixed,
     *     metadata?: mixed,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'invoice',
     *     issuer: string,
     *     type: 'I'|'E'|'P'|'T'|'N',
     *     status: 'processing'|'pending'|'valid'|'rejected'|'canceled',
     *     uuid: string|null,
     *     series: string|null,
     *     folio: string|null,
     *     date: string|null,
     *     customer: array{tax_id: string|null, legal_name: string|null, tax_system?: string, zip?: string, foreign?: array<string, mixed>},
     *     use: string|null,
     *     payment_form: string|null,
     *     payment_method: string|null,
     *     currency: string,
     *     exchange_rate: float|int|null,
     *     items: list<array<string, mixed>>,
     *     subtotal: float|int|null,
     *     discount: float|int|null,
     *     taxes: array{iva: float|int|null, ieps: float|null, iva_withheld: float|null, isr_withheld: float|null, local_transferred: float|null, local_withheld: float|null}|null,
     *     total: float|int|null,
     *     related: array<string, mixed>|null,
     *     payment?: array{date: string|null, payment_form: string|null, currency: string, exchange_rate: float|int|null, amount: float|int, operation_number: string|null, documents: list<array<string, mixed>>}|null,
     *     payroll?: array{periodicity: string, period: array<string, mixed>, days: float|int, employer: array<string, mixed>, employee: array<string, mixed>, perceptions: list<array<string, mixed>>, deductions: list<array<string, mixed>>, other_payments: list<array<string, mixed>>},
     *     global?: array<string, mixed>,
     *     cancellation: array{status: string|null, motive: string|null, substitution: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, cc: string|null, sent_at: string|null}|null,
     *     error: array{message: string, sat_code: string|null, raw: string}|null,
     *     created_at: string|null,
     *     metadata: array<string, mixed>,
     *     warnings?: list<string>,
     *     email_error?: string,
     *     substitutes?: array{invoice: string, canceled: bool, cancel_error?: string},
     *     advance_application?: array{advance: string|null, advance_uuid: string, method: 'egreso'|'remanente', status: 'done'|'credit_note_pending', credit_note: string|null, credit_note_error?: string},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/anticipos/create-advance
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/advances', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar anticipos sin aplicar
     *
     * GET /v1/advances
     *
     * @param array{issuer?: string, customer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{object: 'advance', uuid: string, date: string, series: string|null, folio: string|null, customer: array<string, mixed>, amount: float|int, total: float|int, iva: string, currency: string}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/anticipos/list-advances
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/advances', ['query' => $params], $options);
    }

    /**
     * Aplicar un anticipo
     *
     * Timbra la factura de lo vendido (el cuerpo de POST /v1/invoices) relacionada 07 al anticipo.
     * Con method egreso, también la nota de aplicación. La misma Idempotency-Key continúa donde se
     * quedó.
     *
     * POST /v1/advances/{id}/apply
     *
     * @param string $id
     * @param array{
     *     method?: 'egreso'|'remanente',
     *     remainder?: array{paid_now: bool, payment_form?: string},
     *     issuer?: string,
     *     customer: string|array{tax_id: string, legal_name: string, tax_system: string, zip: string, email?: string|null, foreign?: array{country: string, tax_id: string}, ieps_taxpayer?: bool},
     *     items: list<array{product?: string, description?: string, product_key?: string, unit_key?: string, unit_name?: string|null, sku?: string|null, quantity?: float|int, unit_price?: float|int, discount?: float|int, taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08', iva?: '0'|'0.16'|'0.08'|'exento', ieps?: float|int, ieps_factor?: 'Tasa'|'Cuota', ieps_units?: float|int, iva_retention?: float|int, isr_retention?: float|int, predial?: list<string>, pedimentos?: list<string>, third_party?: array{tax_id: string, name: string, tax_system: string, zip: string}, iedu?: array{student_name: string, curp: string, level: 'Preescolar'|'Primaria'|'Secundaria'|'Profesional técnico'|'Bachillerato o su equivalente', rvoe: string, payer_tax_id?: string|null}, used_vehicle?: array{purchase_amount: float|int, sale_amount: float|int, vehicle_key: string, make: string, type: string, model: string, engine_number?: string, serial_number?: string, niv?: string, guide_value: float|int, customs?: list<array<string, mixed>>}, addenda?: array<string, mixed>}>,
     *     type?: 'I'|'T',
     *     carta_porte?: array{modes?: list<'01'|'02'|'03'|'04'>, international?: array{direction: 'Entrada'|'Salida', country: string, via: string, regimes: list<string>}, istmo?: array{origin: string, destination: string}, reverse_logistics?: bool, origin: array{tax_id: string, name?: string, foreign?: array<string, mixed>, date_time: string, distance_km?: float|int, station?: array<string, mixed>, navigation?: 'Altura'|'Cabotaje', address: array<string, mixed>}, destinations: list<array{tax_id: string, name?: string, foreign?: array<string, mixed>, date_time: string, distance_km?: float|int, station?: array<string, mixed>, navigation?: 'Altura'|'Cabotaje', address: array<string, mixed>}>, goods: list<array{product_key: string, description: string, quantity: float|int, unit_key: string, weight_kg: float|int, dimensions?: string, hazmat?: array<string, mixed>, cofepris?: array<string, mixed>, value?: float|int, currency?: string, tariff?: string, cce_uuid?: string, material?: array<string, mixed>, customs_docs?: list<array<string, mixed>>, guides?: list<array<string, mixed>>, quantities?: list<array<string, mixed>>, detail?: array<string, mixed>, stcc?: string}>, vehicle?: array{config: string, plate: string, year: int, gross_weight: float|int, permit_type: string, permit_number: string, insurer: string, policy: string, env_insurer?: string, env_policy?: string, cargo_insurer?: string, cargo_policy?: string, premium?: float|int, trailers?: list<array<string, mixed>>}, sea?: array{permit_type?: string, permit_number?: string, insurer?: string, policy?: string, vessel_type: string, registration: string, imo: string, year?: int, vessel_name?: string, flag: string, gross_tonnage: float|int, cargo_type: string, length?: float|int, beam?: float|int, draft?: float|int, depth?: float|int, line?: string, agent_name: string, agent_authorization: string, voyage?: string, bill_of_lading?: string, temp_permit?: string, containers?: list<array<string, mixed>>}, air?: array{permit_type: string, permit_number: string, aircraft?: string, insurer?: string, policy?: string, waybill: string, contract_place?: string, carrier: string, shipper?: array<string, mixed>, rate_charge?: float|int}, rail?: array{service: string, traffic: string, insurer?: string, policy?: string, rights?: list<array<string, mixed>>, cars: list<array<string, mixed>>}, drivers: list<array{tax_id: string|'', license: string, name: string, foreign?: array<string, mixed>}>, figures?: list<array{type: '02'|'03'|'04'|'05', tax_id?: string, foreign?: array<string, mixed>, name: string, parts?: list<string>, address?: array<string, mixed>}>},
     *     ine?: array{process: 'Ordinario'|'Precampaña'|'Campaña', committee?: 'Ejecutivo Nacional'|'Ejecutivo Estatal'|'Directivo Estatal', accounting_id?: string, entities?: list<array{key: string, scope?: 'Local'|'Federal', accounting_ids?: list<string>}>},
     *     leyendas?: list<array{text: string, disposition?: string, norm?: string}>,
     *     donation?: array{in_kind?: bool, deducted?: bool},
     *     local_taxes?: list<array{retention: bool, name: string, rate: float|int, amount: float|int}>,
     *     export?: '01'|'02'|'03'|'04',
     *     comercio_exterior?: array{motive?: '05', owners?: list<array{tax_id: string, country: string}>, incoterm?: string, certificate?: string, usd_rate: float|int, issuer_curp?: string, issuer_address?: array{street: string, exterior?: string, interior?: string, zip?: string}, receiver_address?: array{street: string, exterior?: string, interior?: string, colony?: string, locality?: string, municipality?: string, state?: string, country: string, zip: string}, recipient?: array{name?: string, tax_id?: string, address: array<string, mixed>}, goods: list<array{id?: string, tariff?: string, unit: string, quantity?: float|int, unit_value_usd?: float|int}>, notes?: string},
     *     global?: array{periodicity: string, months: string, year: int},
     *     use?: string,
     *     payment_form?: string,
     *     payment_method?: 'PUE'|'PPD',
     *     paid_later?: bool,
     *     currency?: string,
     *     series?: string,
     *     notes?: string,
     *     pdf_language?: 'es'|'en'|'bi',
     *     addenda?: array{type: 'walmart'|'soriana'|'liverpool'|'homedepot'|'chedraui'|'generic', values: array<string, mixed>, customer?: array<string, mixed>},
     *     related?: array{relationship: string, uuids: list<string>},
     *     exchange_rate?: float|int,
     *     folio?: int,
     *     continue_sequence?: bool,
     *     date?: string,
     *     send_email?: bool,
     *     email_cc?: string|null,
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'invoice',
     *     issuer: string,
     *     type: 'I'|'E'|'P'|'T'|'N',
     *     status: 'processing'|'pending'|'valid'|'rejected'|'canceled',
     *     uuid: string|null,
     *     series: string|null,
     *     folio: string|null,
     *     date: string|null,
     *     customer: array{tax_id: string|null, legal_name: string|null, tax_system?: string, zip?: string, foreign?: array<string, mixed>},
     *     use: string|null,
     *     payment_form: string|null,
     *     payment_method: string|null,
     *     currency: string,
     *     exchange_rate: float|int|null,
     *     items: list<array<string, mixed>>,
     *     subtotal: float|int|null,
     *     discount: float|int|null,
     *     taxes: array{iva: float|int|null, ieps: float|null, iva_withheld: float|null, isr_withheld: float|null, local_transferred: float|null, local_withheld: float|null}|null,
     *     total: float|int|null,
     *     related: array<string, mixed>|null,
     *     payment?: array{date: string|null, payment_form: string|null, currency: string, exchange_rate: float|int|null, amount: float|int, operation_number: string|null, documents: list<array<string, mixed>>}|null,
     *     payroll?: array{periodicity: string, period: array<string, mixed>, days: float|int, employer: array<string, mixed>, employee: array<string, mixed>, perceptions: list<array<string, mixed>>, deductions: list<array<string, mixed>>, other_payments: list<array<string, mixed>>},
     *     global?: array<string, mixed>,
     *     cancellation: array{status: string|null, motive: string|null, substitution: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, cc: string|null, sent_at: string|null}|null,
     *     error: array{message: string, sat_code: string|null, raw: string}|null,
     *     created_at: string|null,
     *     metadata: array<string, mixed>,
     *     warnings?: list<string>,
     *     email_error?: string,
     *     substitutes?: array{invoice: string, canceled: bool, cancel_error?: string},
     *     advance_application?: array{advance: string|null, advance_uuid: string, method: 'egreso'|'remanente', status: 'done'|'credit_note_pending', credit_note: string|null, credit_note_error?: string},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/anticipos/apply-advance
     */
    public function apply(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/advances/' . rawurlencode($id) . '/apply', ['body' => $params, 'idempotent' => true], $options);
    }
}
