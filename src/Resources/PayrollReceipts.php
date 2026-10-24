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
     * POST /v1/payroll_receipts/preview
     *
     * @param array{
     *     employee: string,
     *     period: array{start: string, end: string, payment_date?: string},
     *     days?: float|int,
     *     send_email?: bool,
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_receipt_preview',
     *     employee: string,
     *     periodicity: string,
     *     period: array{start: string, end: string, payment_date: string},
     *     days: float|int,
     *     contribution_base_salary: float|int,
     *     perceptions: list<array{type: string, key: string, concept: string, taxed: float|int, exempt: float|int}>,
     *     deductions: list<array{type: string, key: string, concept: string, amount: float|int}>,
     *     other_payments: list<array{type: string, key: string, concept: string, amount: float|int, subsidy_caused?: float|int, subsidy_applied?: float|int}>,
     *     isr: array{tariff: float|int, subsidy: float|int, withheld: float|int, exempt_minimum: bool, adjustment?: array<string, mixed>},
     *     totals: array{salaries: float|int, taxed: float|int, exempt: float|int, perceptions: float|int, other_deductions: float|int, taxes_withheld: float|int, deductions: float|int, other_payments: float|int, subtotal: float|int, net: float|int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/preview-payroll-receipt
     */
    public function preview(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_receipts/preview', ['body' => $params], $options);
    }
}
