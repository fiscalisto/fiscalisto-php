<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cotizaciones: $fiscalisto->quotes.
 */
final class Quotes
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear una cotización
     *
     * Una cotización en borrador, con los conceptos y las condiciones de pago de una factura (se
     * revisan con las mismas reglas, así que siempre se puede facturar). customer es un cliente de
     * su catálogo, uno con sus datos fiscales (se agrega a sus clientes) o solo name y email si
     * aún no los tiene. Se manda con POST /v1/quotes/{id}/send.
     *
     * POST /v1/quotes
     *
     * @param array{
     *     issuer?: string,
     *     customer: string|array{tax_id: string, legal_name: string, tax_system: string, zip: string, email?: string|null, foreign?: array{country: string, tax_id: string}, ieps_taxpayer?: bool}|array{name: string, email?: string},
     *     items: list<array{product?: string, description?: string, product_key?: string, unit_key?: string, unit_name?: string|null, sku?: string|null, quantity?: float|int, unit_price?: float|int, discount?: float|int, taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08', iva?: '0'|'0.16'|'0.08'|'exento', ieps?: float|int, ieps_factor?: 'Tasa'|'Cuota', ieps_units?: float|int, iva_retention?: float|int, isr_retention?: float|int, predial?: list<string>, pedimentos?: list<string>, third_party?: array{tax_id: string, name: string, tax_system: string, zip: string}, iedu?: array{student_name: string, curp: string, level: 'Preescolar'|'Primaria'|'Secundaria'|'Profesional técnico'|'Bachillerato o su equivalente', rvoe: string, payer_tax_id?: string|null}, used_vehicle?: array{purchase_amount: float|int, sale_amount: float|int, vehicle_key: string, make: string, type: string, model: string, engine_number?: string, serial_number?: string, niv?: string, guide_value: float|int, customs?: list<array<string, mixed>>}, addenda?: array<string, mixed>}>,
     *     currency?: string,
     *     exchange_rate?: float|int,
     *     payment_form?: string,
     *     payment_method?: 'PUE'|'PPD',
     *     use?: string,
     *     notes?: string,
     *     valid_until?: string,
     *     terms?: string,
     *     auto_invoice?: bool,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'quote',
     *     issuer: string,
     *     number: string,
     *     version: int,
     *     status: 'draft'|'sent'|'viewed'|'accepted'|'rejected'|'expired'|'invoiced',
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     valid_until: string,
     *     terms: string|null,
     *     notes: string|null,
     *     auto_invoice: bool,
     *     customer_comment: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     decided_at: string|null,
     *     decided_by: 'customer'|'user'|null,
     *     invoice: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/create-quote
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/quotes', ['body' => $params], $options);
    }

    /**
     * Listar cotizaciones
     *
     * Las más recientes primero, cada una en su última versión.
     *
     * GET /v1/quotes
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'draft'|'sent'|'viewed'|'accepted'|'rejected'|'expired'|'invoiced',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'quote', issuer: string, number: string, version: int, status: 'draft'|'sent'|'viewed'|'accepted'|'rejected'|'expired'|'invoiced', url: string|null, customer: array<string, mixed>, currency: string, items: list<array<string, mixed>>, total: float|int|null, valid_until: string, terms: string|null, notes: string|null, auto_invoice: bool, customer_comment: string|null, sent_at: string|null, viewed_at: string|null, decided_at: string|null, decided_by: 'customer'|'user'|null, invoice: string|null, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/list-quotes
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/quotes', $params, $options);
    }

    /**
     * Ver una cotización
     *
     * Su última versión.
     *
     * GET /v1/quotes/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'quote',
     *     issuer: string,
     *     number: string,
     *     version: int,
     *     status: 'draft'|'sent'|'viewed'|'accepted'|'rejected'|'expired'|'invoiced',
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     valid_until: string,
     *     terms: string|null,
     *     notes: string|null,
     *     auto_invoice: bool,
     *     customer_comment: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     decided_at: string|null,
     *     decided_by: 'customer'|'user'|null,
     *     invoice: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/get-quote
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/quotes/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar una cotización
     *
     * Solo lo que mande cambia. Un borrador cambia ahí mismo; una que ya se envió se vuelve una
     * versión nueva en borrador (mismo número, version + 1) que el cliente ve al mandarla;
     * mientras, su liga muestra la anterior. Una aceptada, rechazada o facturada ya no cambia.
     *
     * POST /v1/quotes/{id}
     *
     * @param string $id
     * @param array{
     *     customer?: string|array{tax_id: string, legal_name: string, tax_system: string, zip: string, email?: string|null, foreign?: array{country: string, tax_id: string}, ieps_taxpayer?: bool}|array{name: string, email?: string},
     *     items?: list<array{product?: string, description?: string, product_key?: string, unit_key?: string, unit_name?: string|null, sku?: string|null, quantity?: float|int, unit_price?: float|int, discount?: float|int, taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08', iva?: '0'|'0.16'|'0.08'|'exento', ieps?: float|int, ieps_factor?: 'Tasa'|'Cuota', ieps_units?: float|int, iva_retention?: float|int, isr_retention?: float|int, predial?: list<string>, pedimentos?: list<string>, third_party?: array{tax_id: string, name: string, tax_system: string, zip: string}, iedu?: array{student_name: string, curp: string, level: 'Preescolar'|'Primaria'|'Secundaria'|'Profesional técnico'|'Bachillerato o su equivalente', rvoe: string, payer_tax_id?: string|null}, used_vehicle?: array{purchase_amount: float|int, sale_amount: float|int, vehicle_key: string, make: string, type: string, model: string, engine_number?: string, serial_number?: string, niv?: string, guide_value: float|int, customs?: list<array<string, mixed>>}, addenda?: array<string, mixed>}>,
     *     currency?: string,
     *     exchange_rate?: float|int,
     *     payment_form?: string,
     *     payment_method?: 'PUE'|'PPD',
     *     use?: string,
     *     notes?: string,
     *     valid_until?: string,
     *     terms?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'quote',
     *     issuer: string,
     *     number: string,
     *     version: int,
     *     status: 'draft'|'sent'|'viewed'|'accepted'|'rejected'|'expired'|'invoiced',
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     valid_until: string,
     *     terms: string|null,
     *     notes: string|null,
     *     auto_invoice: bool,
     *     customer_comment: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     decided_at: string|null,
     *     decided_by: 'customer'|'user'|null,
     *     invoice: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/update-quote
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/quotes/' . rawurlencode($id), ['body' => $params], $options);
    }

    /**
     * Borrar una cotización
     *
     * Solo una que nunca se envió; si no, 400 quote_not_draft.
     *
     * DELETE /v1/quotes/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/delete-quote
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/quotes/' . rawurlencode($id), [], $options);
    }

    /**
     * Mandar una cotización
     *
     * La manda por correo con su PDF y la liga donde el cliente la ve, la acepta, pide cambios o
     * la rechaza. Con send_email: false solo se marca enviada y contesta url, para que usted la
     * mande por WhatsApp o su propio correo.
     *
     * POST /v1/quotes/{id}/send
     *
     * @param string $id
     * @param array{send_email?: bool, to?: string, message?: string, auto_invoice?: bool} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'quote',
     *     issuer: string,
     *     number: string,
     *     version: int,
     *     status: 'draft'|'sent'|'viewed'|'accepted'|'rejected'|'expired'|'invoiced',
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     valid_until: string,
     *     terms: string|null,
     *     notes: string|null,
     *     auto_invoice: bool,
     *     customer_comment: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     decided_at: string|null,
     *     decided_by: 'customer'|'user'|null,
     *     invoice: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/send-quote
     */
    public function send(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/quotes/' . rawurlencode($id) . '/send', ['body' => $params], $options);
    }

    /**
     * Marcar aceptada
     *
     * El cliente le dijo que sí por teléfono, en persona… Llega quote.accepted. No timbra: para
     * eso, POST /v1/quotes/{id}/invoice.
     *
     * POST /v1/quotes/{id}/accept
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'quote',
     *     issuer: string,
     *     number: string,
     *     version: int,
     *     status: 'draft'|'sent'|'viewed'|'accepted'|'rejected'|'expired'|'invoiced',
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     valid_until: string,
     *     terms: string|null,
     *     notes: string|null,
     *     auto_invoice: bool,
     *     customer_comment: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     decided_at: string|null,
     *     decided_by: 'customer'|'user'|null,
     *     invoice: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/accept-quote
     */
    public function accept(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/quotes/' . rawurlencode($id) . '/accept', [], $options);
    }

    /**
     * Facturar una cotización
     *
     * Timbra la factura con los conceptos de la cotización y los datos fiscales del cliente, y la
     * deja facturada (invoice). Si no estaba aceptada, la marca aceptada. Una en otra moneda va al
     * tipo de cambio de hoy. Sin los datos fiscales del cliente, 400 quote_customer_missing;
     * rechazada o vencida, 400 quote_not_invoiceable. Si ya se facturó, contesta esa factura.
     *
     * POST /v1/quotes/{id}/invoice
     *
     * @param string $id
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
     *     payment_status: 'paid'|'partial'|'unpaid'|null,
     *     amount_due: float|int|null,
     *     amount_paid: float|int|null,
     *     related: array<string, mixed>|null,
     *     payment?: array{date: string|null, payment_form: string|null, currency: string, exchange_rate: float|int|null, amount: float|int, operation_number: string|null, documents: list<array<string, mixed>>}|null,
     *     payroll?: array{periodicity: string, period: array<string, mixed>, days: float|int, employer: array<string, mixed>, employee: array<string, mixed>, perceptions: list<array<string, mixed>>, deductions: list<array<string, mixed>>, other_payments: list<array<string, mixed>>},
     *     global?: array<string, mixed>,
     *     cancellation: array{status: string|null, motive: string|null, substitution: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, cc: string|null, sent_at: string|null}|null,
     *     error: array{message: string, sat_code: string|null, raw: string}|null,
     *     recurring_invoice: string|null,
     *     created_at: string|null,
     *     metadata: array<string, mixed>,
     *     warnings?: list<string>,
     *     email_error?: string,
     *     substitutes?: array{invoice: string, canceled: bool, cancel_error?: string},
     *     advance_application?: array{advance: string|null, advance_uuid: string, method: 'egreso'|'remanente', status: 'done'|'credit_note_pending', credit_note: string|null, credit_note_error?: string},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/invoice-quote
     */
    public function invoice(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/quotes/' . rawurlencode($id) . '/invoice', ['idempotent' => true], $options);
    }

    /**
     * Descargar el PDF
     *
     * El PDF de su última versión, con el diseño de PDF del emisor.
     *
     * GET /v1/quotes/{id}/pdf
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cotizaciones/get-quote-pdf
     */
    public function pdf(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/quotes/' . rawurlencode($id) . '/pdf', ['as' => 'bytes'], $options);
    }
}
