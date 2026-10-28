<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollReceipts.
 */
final class PayrollReceipts
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Timbrar un recibo de nómina
     *
     * Nómina ordinaria (Nómina 1.2): Fiscalisto calcula sueldo, ISR con subsidio al empleo e IMSS
     * del empleado y el periodo, como la app. Queda como factura tipo N (GET /v1/invoices/{id}).
     * El emisor necesita employer_registration.
     *
     * POST /v1/payroll_receipts
     *
     * @param array{
     *     employee: string,
     *     period: array{start: string, end: string, payment_date?: string},
     *     days?: float|int,
     *     send_email?: bool,
     *     metadata?: array<string, mixed>,
     * } $params
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
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-payroll-receipt
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_receipts', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Calcular un recibo sin timbrar
     *
     * El recibo como se timbraría (percepciones, ISR con el subsidio para el empleo, cuotas IMSS y
     * el neto), sin timbrar ni usar timbres.
     *
     * POST /v1/payroll_receipts/preview
     *
     * @param array{
     *     employee: string,
     *     period: array{start: string, end: string, payment_date?: string},
     *     days?: float|int,
     *     send_email?: bool,
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_receipt_preview',
     *     employee: string,
     *     periodicity: string,
     *     period: array{start: string, end: string, payment_date: string},
     *     days: float|int,
     *     contribution_base_salary: float|int,
     *     perceptions: list<array{type: string, key: string, concept: string, taxed: float|int, exempt: float|int, overtime?: list<array<string, mixed>>, stock_options?: array<string, mixed>}>,
     *     deductions: list<array{type: string, key: string, concept: string, amount: float|int}>,
     *     other_payments: list<array{type: string, key: string, concept: string, amount: float|int, subsidy_caused?: float|int, subsidy_applied?: float|int, balance_compensation?: array<string, mixed>}>,
     *     isr: array{tariff: float|int, subsidy: float|int, withheld: float|int, exempt_minimum: bool, adjustment?: array<string, mixed>},
     *     totals: array{salaries: float|int, taxed: float|int, exempt: float|int, separation: float|int, retirement: float|int, perceptions: float|int, other_deductions: float|int, taxes_withheld: float|int, deductions: float|int, other_payments: float|int, subtotal: float|int, net: float|int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/preview-payroll-receipt
     */
    public function preview(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_receipts/preview', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Timbrar un recibo calculado por su sistema
     *
     * Para un sistema de nómina que ya calculó el recibo: timbra exactamente sus percepciones
     * (gravado y exento), deducciones, otros pagos, horas extra, incapacidades, separación o
     * jubilación, ordinario (type O) o extraordinario (type E: aguinaldo, PTU, finiquito).
     * Fiscalisto no recalcula ni redondea nada: revisa el XSD, los catálogos del SAT, la Matriz de
     * errores y que sus totales cuadren, y si algo falla responde payroll_invalid con todos los
     * problemas en errors[] (cada uno con su param). Un recibo ordinario por empleado (RFC) y
     * periodo; uno extraordinario por empleado y payroll_run_id. Repetirlo con los mismos importes
     * devuelve el mismo recibo; con otros importes, 409 payroll_receipt_exists (corríjalo con
     * replaces). Queda como factura tipo N.
     *
     * POST /v1/payroll_receipts/external
     *
     * @param array{
     *     issuer?: string,
     *     type: 'O'|'E',
     *     periodicity: string,
     *     period: array{start: string, end: string, payment_date: string},
     *     days: float|int,
     *     employer?: array{registration?: string|null, curp?: string|null, origin_tax_id?: string, sncf?: array{resource_origin: string, own_resource_amount?: float|int}},
     *     employee: array{tax_id: string, name: string, zip: string, curp: string, number: string, email?: string|null, social_security_number?: string, start_date?: string, seniority?: string, contract_type: string, regime_type: string, unionized?: bool, workday_type?: string, risk_class?: string, department?: string, position?: string, contribution_base_salary?: float|int, integrated_daily_salary?: float|int, state: string, bank?: string, bank_account?: string, subcontracting?: list<array{tax_id: string, percentage: float|int}>},
     *     perceptions?: list<array{type: string, key: string, concept: string, taxed: float|int, exempt: float|int, overtime?: list<array{days: float|int, hours_type: string, hours: float|int, amount_paid: float|int}>, stock_options?: array{market_value: float|int, grant_price: float|int}}>,
     *     separation?: array{total_paid: float|int, years_of_service: float|int, last_monthly_salary: float|int, accumulable_income: float|int, non_accumulable_income: float|int},
     *     retirement?: array{total_one_payment?: float|int, total_installment?: float|int, daily_amount?: float|int, accumulable_income: float|int, non_accumulable_income: float|int},
     *     deductions?: list<array{type: string, key: string, concept: string, amount: float|int}>,
     *     other_payments?: list<array{type: string, key: string, concept: string, amount: float|int, subsidy_caused?: float|int, balance_compensation?: array{balance: float|int, year: float|int, remaining: float|int}}>,
     *     disabilities?: list<array{days: float|int, type: string, amount?: float|int}>,
     *     totals: array{perceptions: float|int, deductions: float|int, other_payments: float|int, net: float|int, salaries?: float|int, separation?: float|int, retirement?: float|int, taxed?: float|int, exempt?: float|int, taxes_withheld?: float|int, other_deductions?: float|int},
     *     references?: array{employee_id?: string, payroll_run_id?: string},
     *     replaces?: string,
     *     send_email?: bool,
     *     metadata?: array<string, mixed>,
     * } $params
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
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-external-payroll-receipt
     */
    public function createExternal(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_receipts/external', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Revisar un recibo calculado por su sistema, sin timbrar
     *
     * Las mismas revisiones que al timbrar, sin timbrar ni usar timbres: devuelve el recibo como
     * se timbraría, los avisos y el XML sin sellar (unsigned_xml), con sus importes tal cual. Si
     * algo falla, payroll_invalid con errors[].
     *
     * POST /v1/payroll_receipts/external/preview
     *
     * @param array{
     *     issuer?: string,
     *     type: 'O'|'E',
     *     periodicity: string,
     *     period: array{start: string, end: string, payment_date: string},
     *     days: float|int,
     *     employer?: array{registration?: string|null, curp?: string|null, origin_tax_id?: string, sncf?: array{resource_origin: string, own_resource_amount?: float|int}},
     *     employee: array{tax_id: string, name: string, zip: string, curp: string, number: string, email?: string|null, social_security_number?: string, start_date?: string, seniority?: string, contract_type: string, regime_type: string, unionized?: bool, workday_type?: string, risk_class?: string, department?: string, position?: string, contribution_base_salary?: float|int, integrated_daily_salary?: float|int, state: string, bank?: string, bank_account?: string, subcontracting?: list<array{tax_id: string, percentage: float|int}>},
     *     perceptions?: list<array{type: string, key: string, concept: string, taxed: float|int, exempt: float|int, overtime?: list<array{days: float|int, hours_type: string, hours: float|int, amount_paid: float|int}>, stock_options?: array{market_value: float|int, grant_price: float|int}}>,
     *     separation?: array{total_paid: float|int, years_of_service: float|int, last_monthly_salary: float|int, accumulable_income: float|int, non_accumulable_income: float|int},
     *     retirement?: array{total_one_payment?: float|int, total_installment?: float|int, daily_amount?: float|int, accumulable_income: float|int, non_accumulable_income: float|int},
     *     deductions?: list<array{type: string, key: string, concept: string, amount: float|int}>,
     *     other_payments?: list<array{type: string, key: string, concept: string, amount: float|int, subsidy_caused?: float|int, balance_compensation?: array{balance: float|int, year: float|int, remaining: float|int}}>,
     *     disabilities?: list<array{days: float|int, type: string, amount?: float|int}>,
     *     totals: array{perceptions: float|int, deductions: float|int, other_payments: float|int, net: float|int, salaries?: float|int, separation?: float|int, retirement?: float|int, taxed?: float|int, exempt?: float|int, taxes_withheld?: float|int, other_deductions?: float|int},
     *     references?: array{employee_id?: string, payroll_run_id?: string},
     *     replaces?: string,
     *     send_email?: bool,
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_receipt_preview',
     *     calculation: 'external',
     *     issuer: string,
     *     customer: array{tax_id: string, legal_name: string, zip: string},
     *     payroll: array{type: 'O'|'E', calculation: 'fiscalisto'|'external', periodicity: string, period: array<string, mixed>, days: float|int, references: array<string, mixed>|null, employer: array<string, mixed>, employee: array<string, mixed>, perceptions: list<array<string, mixed>>, deductions: list<array<string, mixed>>, other_payments: list<array<string, mixed>>, separation?: array<string, mixed>, retirement?: array<string, mixed>, disabilities?: list<array<string, mixed>>, totals: array<string, mixed>},
     *     subtotal: float|int,
     *     discount: float|int,
     *     total: float|int,
     *     warnings: list<array{param: string, code: string, message: string}>,
     *     unsigned_xml: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/preview-external-payroll-receipt
     */
    public function previewExternal(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_receipts/external/preview', ['body' => $params, 'idempotent' => true], $options);
    }
}
