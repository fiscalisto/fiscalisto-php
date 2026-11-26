<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollPayouts.
 */
final class PayrollPayouts
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Pagar la nómina por transferencia
     *
     * Como «Pagar por transferencia» en la app: el neto de cada recibo de nómina timbrado (y no
     * cancelado) con esa fecha de pago, menos los vales de despensa, a la CLABE de cada empleado,
     * en un pago a proveedores en borrador (Pagos). Nunca sale solo: alguien del equipo lo abre en
     * app_url y lo firma con su llave de acceso. Solo se le paga a una CLABE ya registrada en
     * Pagos, aprobada y pasada su espera: la API no registra CLABEs, así que cambiar la clabe de
     * un empleado no desvía su nómina (se registra en la app y espera como cualquier cuenta).
     * Quien no se puede pagar va en excluded con su razón; quien ya va en otro pago de esta nómina
     * no se paga dos veces. Solo si la empresa paga con Fintoc y deja que la API prepare pagos en
     * Pagos › Configurar pagos (si no, 403 payouts_api_disabled); si nadie se puede pagar contesta
     * 400 parameter_invalid con el motivo. Pide Idempotency-Key: si la respuesta se pierde,
     * repítala con el mismo valor y contesta el mismo pago; la misma llave con otra fecha contesta
     * 409 idempotency_key_reused.
     *
     * POST /v1/payroll_payouts
     *
     * @param array{
     *     issuer?: string,
     *     payment_date: string,
     *     pay_on?: string,
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_payout',
     *     livemode: bool,
     *     issuer: string,
     *     payment_date: string,
     *     payout: array{id: string, livemode: bool, object: 'payout', issuer: string, number: int, status: 'draft'|'pending_approval'|'approved'|'sending'|'paid'|'partially_paid'|'failed'|'canceled', name: string|null, pay_on: string, exchange_rate: 'official'|'fixed'|null, total: float|int, currency: 'MXN', note: string|null, source: 'app'|'api'|'assistant'|'rule'|'recurring', payout_mandate: string|null, signatures: array<string, mixed>, app_url: string, transfers: list<array<string, mixed>>, cancel_reason: string|null, created_by_api: bool, metadata: array<string, mixed>, created_at: string|null, approved_at: string|null, sent_at: string|null, settled_at: string|null, canceled_at: string|null},
     *     excluded: list<array{employee: string|null, name: string, tax_id: string, amount: float|int, status: 'ready'|'add'|'waiting'|'blocked'|'no_clabe'|'zero'|'in_payout', reason: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-payroll-payout
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_payouts', ['body' => $params, 'idempotent' => true], $options);
    }
}
