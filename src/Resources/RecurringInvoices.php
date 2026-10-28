<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Facturas recurrentes: $fiscalisto->recurringInvoices.
 */
final class RecurringInvoices
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear una factura recurrente
     *
     * Una factura que el emisor timbra solo en cada fecha (cada interval meses en day_of_month, o
     * cada interval semanas o días), a la hora que elija, con los timbres de su cuenta, y la manda
     * al cliente si send_email. Cada una es una factura normal (invoice.stamped, con
     * recurring_invoice) y nunca se timbra dos veces el mismo periodo. invoice es el cuerpo de
     * POST /v1/invoices: se revisa ahora, con las mismas reglas.
     *
     * POST /v1/recurring_invoices
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     schedule: array{frequency: 'monthly'|'weekly'|'daily', interval?: int, day_of_month?: int|'last', start_date?: string, hour?: int, time_zone?: 'America/Mexico_City'|'America/Cancun'|'America/Mazatlan'|'America/Hermosillo'|'America/Tijuana'|'America/Ciudad_Juarez'},
     *     invoice: array{issuer?: string, branch?: string, warehouse?: string, customer: string|array{tax_id: string, legal_name: string, tax_system: string, zip: string, email?: string|null, foreign?: array<string, mixed>, ieps_taxpayer?: bool}, items: list<array{product?: string, description?: string, product_key?: string, unit_key?: string, unit_name?: string|null, sku?: string|null, quantity?: float|int, unit_price?: float|int, discount?: float|int, taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08', iva?: '0'|'0.16'|'0.08'|'exento', ieps?: float|int, ieps_factor?: 'Tasa'|'Cuota', ieps_units?: float|int, iva_retention?: float|int, isr_retention?: float|int, predial?: list<string>, pedimentos?: list<string>, third_party?: array<string, mixed>, iedu?: array<string, mixed>, used_vehicle?: array<string, mixed>, addenda?: array<string, mixed>}>, type?: 'I'|'T', carta_porte?: array{modes?: list<'01'|'02'|'03'|'04'>, international?: array<string, mixed>, istmo?: array<string, mixed>, reverse_logistics?: bool, origin: array<string, mixed>, destinations: list<array<string, mixed>>, goods: list<array<string, mixed>>, vehicle?: array<string, mixed>, sea?: array<string, mixed>, air?: array<string, mixed>, rail?: array<string, mixed>, drivers: list<array<string, mixed>>, figures?: list<array<string, mixed>>}, ine?: array{process: 'Ordinario'|'Precampaña'|'Campaña', committee?: 'Ejecutivo Nacional'|'Ejecutivo Estatal'|'Directivo Estatal', accounting_id?: string, entities?: list<array<string, mixed>>}, leyendas?: list<array{text: string, disposition?: string, norm?: string}>, donation?: array{in_kind?: bool, deducted?: bool}, local_taxes?: list<array{retention: bool, name: string, rate: float|int, amount: float|int}>, export?: '01'|'02'|'03'|'04', comercio_exterior?: array{motive?: '05', owners?: list<array<string, mixed>>, incoterm?: string, certificate?: string, usd_rate: float|int, issuer_curp?: string, issuer_address?: array<string, mixed>, receiver_address?: array<string, mixed>, recipient?: array<string, mixed>, goods: list<array<string, mixed>>, notes?: string}, global?: array{periodicity: string, months: string, year: int}, use?: string, payment_form?: string, payment_method?: 'PUE'|'PPD', paid_later?: bool, currency?: string, series?: string, notes?: string, pdf_language?: 'es'|'en'|'bi', addenda?: array{type: 'walmart'|'soriana'|'liverpool'|'homedepot'|'chedraui'|'generic', values: array<string, mixed>, customer?: array<string, mixed>}, related?: array{relationship: string, uuids: list<string>}, exchange_rate?: float|int, folio?: int, continue_sequence?: bool, date?: string, send_email?: bool, email_cc?: string|null, metadata?: array<string, mixed>},
     *     send_email?: bool,
     *     catch_up?: 'all'|'latest',
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'recurring_invoice',
     *     issuer: string,
     *     name: string,
     *     status: 'active'|'paused',
     *     schedule: array{frequency: 'monthly'|'weekly'|'daily', interval: int, day_of_month: int|'last'|null, hour: int, time_zone: string},
     *     next_invoice_on: string,
     *     last_invoiced_on: string|null,
     *     last_invoice: string|null,
     *     last_error: array{message: string|null}|null,
     *     send_email: bool,
     *     catch_up: 'all'|'latest',
     *     customer: array{tax_id: string, legal_name: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas-recurrentes/create-recurring-invoice
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/recurring_invoices', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar facturas recurrentes
     *
     * Las más recientes primero.
     *
     * GET /v1/recurring_invoices
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'active'|'paused',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'recurring_invoice', issuer: string, name: string, status: 'active'|'paused', schedule: array<string, mixed>, next_invoice_on: string, last_invoiced_on: string|null, last_invoice: string|null, last_error: array<string, mixed>|null, send_email: bool, catch_up: 'all'|'latest', customer: array<string, mixed>, currency: string, items: list<array<string, mixed>>, total: float|int|null, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas-recurrentes/list-recurring-invoices
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/recurring_invoices', $params, $options);
    }

    /**
     * Ver una factura recurrente
     *
     * Una factura recurrente: su calendario, la próxima fecha, la última factura que timbró y, si
     * falló, por qué en last_error.
     *
     * GET /v1/recurring_invoices/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'recurring_invoice',
     *     issuer: string,
     *     name: string,
     *     status: 'active'|'paused',
     *     schedule: array{frequency: 'monthly'|'weekly'|'daily', interval: int, day_of_month: int|'last'|null, hour: int, time_zone: string},
     *     next_invoice_on: string,
     *     last_invoiced_on: string|null,
     *     last_invoice: string|null,
     *     last_error: array{message: string|null}|null,
     *     send_email: bool,
     *     catch_up: 'all'|'latest',
     *     customer: array{tax_id: string, legal_name: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas-recurrentes/get-recurring-invoice
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/recurring_invoices/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar o pausar una factura recurrente
     *
     * Solo lo que mande cambia. invoice reemplaza la factura completa desde la siguiente vez.
     * active: false la pausa; active: true la reanuda desde hoy, sin timbrar las fechas que
     * pasaron en pausa. schedule.start_date mueve la siguiente fecha.
     *
     * POST /v1/recurring_invoices/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     schedule?: array{frequency?: 'monthly'|'weekly'|'daily', interval?: int, day_of_month?: int|'last', start_date?: string, hour?: int, time_zone?: 'America/Mexico_City'|'America/Cancun'|'America/Mazatlan'|'America/Hermosillo'|'America/Tijuana'|'America/Ciudad_Juarez'},
     *     invoice?: array{issuer?: string, branch?: string, warehouse?: string, customer: string|array{tax_id: string, legal_name: string, tax_system: string, zip: string, email?: string|null, foreign?: array<string, mixed>, ieps_taxpayer?: bool}, items: list<array{product?: string, description?: string, product_key?: string, unit_key?: string, unit_name?: string|null, sku?: string|null, quantity?: float|int, unit_price?: float|int, discount?: float|int, taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08', iva?: '0'|'0.16'|'0.08'|'exento', ieps?: float|int, ieps_factor?: 'Tasa'|'Cuota', ieps_units?: float|int, iva_retention?: float|int, isr_retention?: float|int, predial?: list<string>, pedimentos?: list<string>, third_party?: array<string, mixed>, iedu?: array<string, mixed>, used_vehicle?: array<string, mixed>, addenda?: array<string, mixed>}>, type?: 'I'|'T', carta_porte?: array{modes?: list<'01'|'02'|'03'|'04'>, international?: array<string, mixed>, istmo?: array<string, mixed>, reverse_logistics?: bool, origin: array<string, mixed>, destinations: list<array<string, mixed>>, goods: list<array<string, mixed>>, vehicle?: array<string, mixed>, sea?: array<string, mixed>, air?: array<string, mixed>, rail?: array<string, mixed>, drivers: list<array<string, mixed>>, figures?: list<array<string, mixed>>}, ine?: array{process: 'Ordinario'|'Precampaña'|'Campaña', committee?: 'Ejecutivo Nacional'|'Ejecutivo Estatal'|'Directivo Estatal', accounting_id?: string, entities?: list<array<string, mixed>>}, leyendas?: list<array{text: string, disposition?: string, norm?: string}>, donation?: array{in_kind?: bool, deducted?: bool}, local_taxes?: list<array{retention: bool, name: string, rate: float|int, amount: float|int}>, export?: '01'|'02'|'03'|'04', comercio_exterior?: array{motive?: '05', owners?: list<array<string, mixed>>, incoterm?: string, certificate?: string, usd_rate: float|int, issuer_curp?: string, issuer_address?: array<string, mixed>, receiver_address?: array<string, mixed>, recipient?: array<string, mixed>, goods: list<array<string, mixed>>, notes?: string}, global?: array{periodicity: string, months: string, year: int}, use?: string, payment_form?: string, payment_method?: 'PUE'|'PPD', paid_later?: bool, currency?: string, series?: string, notes?: string, pdf_language?: 'es'|'en'|'bi', addenda?: array{type: 'walmart'|'soriana'|'liverpool'|'homedepot'|'chedraui'|'generic', values: array<string, mixed>, customer?: array<string, mixed>}, related?: array{relationship: string, uuids: list<string>}, exchange_rate?: float|int, folio?: int, continue_sequence?: bool, date?: string, send_email?: bool, email_cc?: string|null, metadata?: array<string, mixed>},
     *     send_email?: bool,
     *     catch_up?: 'all'|'latest',
     *     active?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'recurring_invoice',
     *     issuer: string,
     *     name: string,
     *     status: 'active'|'paused',
     *     schedule: array{frequency: 'monthly'|'weekly'|'daily', interval: int, day_of_month: int|'last'|null, hour: int, time_zone: string},
     *     next_invoice_on: string,
     *     last_invoiced_on: string|null,
     *     last_invoice: string|null,
     *     last_error: array{message: string|null}|null,
     *     send_email: bool,
     *     catch_up: 'all'|'latest',
     *     customer: array{tax_id: string, legal_name: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas-recurrentes/update-recurring-invoice
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/recurring_invoices/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una factura recurrente
     *
     * Ya no timbra más; las facturas que timbró se quedan.
     *
     * DELETE /v1/recurring_invoices/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas-recurrentes/delete-recurring-invoice
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/recurring_invoices/' . rawurlencode($id), [], $options);
    }

    /**
     * Saltar la siguiente factura
     *
     * La siguiente fecha pasa a la que sigue, sin timbrar nada.
     *
     * POST /v1/recurring_invoices/{id}/skip
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'recurring_invoice',
     *     issuer: string,
     *     name: string,
     *     status: 'active'|'paused',
     *     schedule: array{frequency: 'monthly'|'weekly'|'daily', interval: int, day_of_month: int|'last'|null, hour: int, time_zone: string},
     *     next_invoice_on: string,
     *     last_invoiced_on: string|null,
     *     last_invoice: string|null,
     *     last_error: array{message: string|null}|null,
     *     send_email: bool,
     *     catch_up: 'all'|'latest',
     *     customer: array{tax_id: string, legal_name: string|null},
     *     currency: string,
     *     items: list<array{description: string, product_key: string, quantity?: float|int, unit_key?: string, unit_price: float|int}>,
     *     total: float|int|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/facturas-recurrentes/skip-recurring-invoice
     */
    public function skip(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/recurring_invoices/' . rawurlencode($id) . '/skip', ['idempotent' => true], $options);
    }

    /**
     * Timbrar ahora la que toca
     *
     * Timbra el periodo que ya toca (next_invoice_on es hoy o antes) sin esperar su hora. Si no
     * toca aún, 409 recurring_not_due. Si la hora llega mientras tanto, no se timbra dos veces: es
     * el mismo periodo.
     *
     * POST /v1/recurring_invoices/{id}/run
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'invoice',
     *     issuer: string,
     *     branch: string|null,
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
     *     payroll?: array{type: 'O'|'E', calculation: 'fiscalisto'|'external', periodicity: string, period: array<string, mixed>, days: float|int, references: array<string, mixed>|null, employer: array<string, mixed>, employee: array<string, mixed>, perceptions: list<array<string, mixed>>, deductions: list<array<string, mixed>>, other_payments: list<array<string, mixed>>, separation?: array<string, mixed>, retirement?: array<string, mixed>, disabilities?: list<array<string, mixed>>, totals: array<string, mixed>},
     *     global?: array<string, mixed>,
     *     cancellation: array{status: string|null, motive: string|null, substitution: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, cc: string|null, sent_at: string|null, status: 'sent'|'delayed'|'delivered'|'opened'|'bounced'|'complained', recipients: list<array<string, mixed>>}|null,
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
     * @see https://fiscalisto.com/docs/api/referencia/facturas-recurrentes/run-recurring-invoice
     */
    public function run(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/recurring_invoices/' . rawurlencode($id) . '/run', ['idempotent' => true], $options);
    }
}
