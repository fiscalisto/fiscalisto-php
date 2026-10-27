<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Pagos y notas de crédito: $fiscalisto->payments.
 */
final class Payments
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Timbrar un complemento de pago
     *
     * El recibo de pago (CFDI tipo P, Pagos 2.0) de facturas PPD: parcialidad, saldo anterior e
     * insoluto e impuestos de cada una los calcula Fiscalisto.
     *
     * POST /v1/payments
     *
     * @param array{
     *     issuer?: string,
     *     date?: string,
     *     payment_form: string,
     *     operation_number?: string|null,
     *     currency?: string,
     *     exchange_rate?: float|int|null,
     *     series?: string,
     *     documents: list<array{invoice: string, amount: float|int, received?: float|int|null}>,
     *     send_email?: bool,
     *     email?: string,
     *     email_cc?: string|null,
     *     metadata?: array<string, mixed>,
     *     bank_transaction?: string,
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
     * @see https://fiscalisto.com/docs/api/referencia/pagos-y-notas-de-credito/create-payment
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payments', ['body' => $params, 'idempotent' => true], $options);
    }
}
