<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Facturas: $fiscalisto->invoices.
 */
final class Invoices
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Timbrar una factura
     *
     * Revisa la factura con las reglas del SAT, la sella y la timbra en una sola llamada. Responde
     * con la factura timbrada (status valid) o, si el PAC tarda, en processing (escuche
     * invoice.stamped). Lo que puede omitir tiene el valor usual: PUE, MXN, uso G03 (S01 con
     * régimen 616), objeto de impuesto 02, IVA 16%, cantidad 1, unidad E48.
     *
     * POST /v1/invoices
     *
     * @param array{
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
     * @see https://fiscalisto.com/docs/api/referencia/facturas/create-invoice
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/invoices', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar facturas
     *
     * Las más recientes primero.
     *
     * GET /v1/invoices
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'valid'|'pending'|'canceled'|'rejected'|'processing',
     *     type?: 'I'|'E'|'P'|'T'|'N',
     *     customer?: string,
     *     created_gte?: string,
     *     created_lte?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'invoice', issuer: string, type: 'I'|'E'|'P'|'T'|'N', status: 'processing'|'pending'|'valid'|'rejected'|'canceled', uuid: string|null, series: string|null, folio: string|null, date: string|null, customer: array<string, mixed>, use: string|null, payment_form: string|null, payment_method: string|null, currency: string, exchange_rate: float|int|null, items: list<array<string, mixed>>, subtotal: float|int|null, discount: float|int|null, taxes: array<string, mixed>|null, total: float|int|null, related: array<string, mixed>|null, payment?: array<string, mixed>|null, payroll?: array<string, mixed>, global?: array<string, mixed>, cancellation: array<string, mixed>|null, email: array<string, mixed>|null, error: array<string, mixed>|null, created_at: string|null, metadata: array<string, mixed>, warnings?: list<string>, email_error?: string, substitutes?: array<string, mixed>, advance_application?: array<string, mixed>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas/list-invoices
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/invoices', $params, $options);
    }

    /**
     * Ver una factura
     *
     * Por su id (inv_…) o por su folio fiscal (UUID).
     *
     * GET /v1/invoices/{id}
     *
     * @param string $id
     * @param array{issuer?: string, refresh?: bool} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
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
     * @see https://fiscalisto.com/docs/api/referencia/facturas/get-invoice
     */
    public function get(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/invoices/' . rawurlencode($id), ['query' => $params], $options);
    }

    /**
     * Descargar el PDF
     *
     * GET /v1/invoices/{id}/pdf
     *
     * @param string $id
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas/get-invoice-pdf
     */
    public function pdf(string $id, array $params = [], array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/invoices/' . rawurlencode($id) . '/pdf', ['query' => $params, 'as' => 'bytes'], $options);
    }

    /**
     * Descargar el XML
     *
     * El CFDI timbrado, tal como lo tiene el SAT.
     *
     * GET /v1/invoices/{id}/xml
     *
     * @param string $id
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas/get-invoice-xml
     */
    public function xml(string $id, array $params = [], array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/invoices/' . rawurlencode($id) . '/xml', ['query' => $params, 'as' => 'text'], $options);
    }

    /**
     * Enviar por correo
     *
     * Manda el PDF y el XML con el diseño de Fiscalisto. Sin `to`, al correo del cliente. Con la
     * misma Idempotency-Key no se manda dos veces.
     *
     * POST /v1/invoices/{id}/send
     *
     * @param string $id
     * @param array{to?: string, cc?: string|null} $params
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
     * @see https://fiscalisto.com/docs/api/referencia/facturas/send-invoice
     */
    public function send(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/invoices/' . rawurlencode($id) . '/send', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cancelar una factura
     *
     * Pide la cancelación al SAT. Si el cliente debe aceptarla queda en pending (escuche
     * invoice.canceled o invoice.cancellation_rejected). Usa un timbre la primera vez que el SAT
     * acepta la solicitud; repetirla, o pedirla otra vez después de un rechazo, no. Nunca se niega
     * por falta de timbres.
     *
     * POST /v1/invoices/{id}/cancel
     *
     * @param string $id
     * @param array{motive?: '01'|'02'|'03'|'04', substitution?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
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
     * @see https://fiscalisto.com/docs/api/referencia/facturas/cancel-invoice
     */
    public function cancel(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/invoices/' . rawurlencode($id) . '/cancel', ['body' => $params], $options);
    }

    /**
     * Sustituir una factura
     *
     * Timbra la factura corregida (el mismo cuerpo que POST /v1/invoices, relacionada 04) y
     * cancela la anterior con motivo 01.
     *
     * POST /v1/invoices/{id}/substitute
     *
     * @param string $id
     * @param array{
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
     * @see https://fiscalisto.com/docs/api/referencia/facturas/substitute-invoice
     */
    public function substitute(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/invoices/' . rawurlencode($id) . '/substitute', ['body' => $params, 'idempotent' => true], $options);
    }
}
