<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollApprovals.
 */
final class PayrollApprovals
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Pedir aprobación de la prenómina
     *
     * Para un emisor que pide aprobar la prenómina antes de timbrar (Ajustes › Aprobaciones ›
     * Prenómina en la app): manda la nómina del periodo a aprobación. Calcula cada recibo como lo
     * timbraría POST /v1/payroll_receipts y guarda sus importes; reemplaza la que se haya pedido
     * antes para el mismo periodo, y avisa a quienes pueden aprobarla. La aprueba o rechaza una
     * persona en Nómina › Emitir recibos (no una llave). Mientras no esté aprobada, POST
     * /v1/payroll_receipts y POST /v1/payroll_batches de ese periodo contestan
     * payroll_approval_required; aprobada, timbran solo los recibos de ella con los mismos
     * importes y fecha de pago.
     *
     * POST /v1/payroll_approvals
     *
     * @param array{
     *     issuer?: string,
     *     period: array{start: string, end: string, payment_date?: string},
     *     receipts: list<array{employee: string, days?: float|int, absences?: int, disability_days?: int, incidents?: array{double_hours?: int, triple_hours?: int, overtime_days?: int, sundays?: int, rest_days_worked?: int, holidays_worked?: int, vacation_days?: float|int, disability_pay?: array<string, mixed>, retroactive?: array<string, mixed>, bonuses?: list<array<string, mixed>>}}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'payroll_approval',
     *     livemode: bool,
     *     issuer: string,
     *     periodicity: string,
     *     period: array{start: string, end: string, payment_date: string},
     *     status: 'pending'|'approved'|'rejected'|'withdrawn'|'replaced',
     *     net: float|int,
     *     receipts: list<array{employee: string, name: string, days: float|int, absences: float|int, disability_days: float|int, totals: array<string, mixed>}>,
     *     requested_at: string,
     *     decided_at: string|null,
     *     note: string|null,
     *     step: array{number: int, of: int, name: string}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-payroll-approval
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_approvals', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar prenóminas por aprobar
     *
     * Las prenóminas pedidas para aprobación, las más recientes primero.
     *
     * GET /v1/payroll_approvals
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     status?: 'pending'|'approved'|'rejected'|'withdrawn'|'replaced',
     *     issuer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'payroll_approval', livemode: bool, issuer: string, periodicity: string, period: array<string, mixed>, status: 'pending'|'approved'|'rejected'|'withdrawn'|'replaced', net: float|int, receipts: list<array<string, mixed>>, requested_at: string, decided_at: string|null, note: string|null, step: array<string, mixed>|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-payroll-approvals
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/payroll_approvals', $params, $options);
    }

    /**
     * Ver una prenómina por aprobar
     *
     * Con su estado y los importes de cada recibo.
     *
     * GET /v1/payroll_approvals/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'payroll_approval',
     *     livemode: bool,
     *     issuer: string,
     *     periodicity: string,
     *     period: array{start: string, end: string, payment_date: string},
     *     status: 'pending'|'approved'|'rejected'|'withdrawn'|'replaced',
     *     net: float|int,
     *     receipts: list<array{employee: string, name: string, days: float|int, absences: float|int, disability_days: float|int, totals: array<string, mixed>}>,
     *     requested_at: string,
     *     decided_at: string|null,
     *     note: string|null,
     *     step: array{number: int, of: int, name: string}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-payroll-approval
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payroll_approvals/' . rawurlencode($id), [], $options);
    }

    /**
     * Retirar una prenómina por aprobar
     *
     * Retira una que espera aprobación (status withdrawn), para corregirla y pedirla de nuevo, o
     * porque no se pagará.
     *
     * POST /v1/payroll_approvals/{id}/cancel
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'payroll_approval',
     *     livemode: bool,
     *     issuer: string,
     *     periodicity: string,
     *     period: array{start: string, end: string, payment_date: string},
     *     status: 'pending'|'approved'|'rejected'|'withdrawn'|'replaced',
     *     net: float|int,
     *     receipts: list<array{employee: string, name: string, days: float|int, absences: float|int, disability_days: float|int, totals: array<string, mixed>}>,
     *     requested_at: string,
     *     decided_at: string|null,
     *     note: string|null,
     *     step: array{number: int, of: int, name: string}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/cancel-payroll-approval
     */
    public function cancel(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_approvals/' . rawurlencode($id) . '/cancel', ['idempotent' => true], $options);
    }
}
