<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Asistencia: $fiscalisto->attendance.
 */
final class Attendance
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver la asistencia de un periodo
     *
     * El registro de jornada del emisor (LFT art. 132) del periodo, por empleado: minutos
     * trabajados contra su horario, faltas, retardos, días sin salida, marcas con notas y horas
     * extra dobles y triples por semana. Con employee, también cada día y cada marca (con sus
     * correcciones). Hasta 92 días a la vez.
     *
     * GET /v1/attendance
     *
     * @param array{issuer?: string, from: string, to: string, employee?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'attendance_report',
     *     livemode: bool,
     *     issuer: string,
     *     from: string,
     *     to: string,
     *     overtime_approval: bool,
     *     overtime_policy: 'approval'|'all'|'none',
     *     ordinary_week_hours: int,
     *     weekly_hours: int|null,
     *     employees: list<array{employee: string, name: string, number: string|null, place: string|null, worked_minutes: int, scheduled_minutes: int, absences: int, disability_days: int, vacation_days: int, late_count: int, late_minutes: int, incomplete_days: int, flagged_marks: int, overtime_double_minutes: int, overtime_triple_minutes: int, overtime_minutes: int, week_excess_minutes: int, unapproved_overtime_minutes: int, rejected_overtime_minutes: int, rest_days_worked: int, holidays_worked: int, weeks_confirmed: int, weeks_disputed: list<array<string, mixed>>, days: list<array<string, mixed>>|null, marks: list<array<string, mixed>>|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/get-attendance
     */
    public function get(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/attendance', ['query' => $params], $options);
    }

    /**
     * Registrar una marca
     *
     * Una entrada o salida que viene de otro reloj checador. Queda con method api y su motivo, y
     * el empleado la ve en su enlace. Una marca igual del mismo empleado dentro de 60 segundos no
     * se duplica.
     *
     * POST /v1/attendance/marks
     *
     * @param array{employee: string, kind: 'in'|'out', at: string, reason?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'attendance_mark',
     *     employee: string,
     *     kind: 'in'|'out',
     *     at: string,
     *     date: string,
     *     time: string,
     *     method: 'kiosk_qr'|'kiosk_pin'|'printed_qr'|'remote'|'manual'|'api',
     *     place: string|null,
     *     distance_m: float|int|null,
     *     flags: list<'no_location'|'far'|'imprecise'|'remote'|'new_device'>,
     *     reason: string|null,
     *     created_by: string|null,
     *     voided: bool,
     *     void_reason: string|null,
     *     voided_by: string|null,
     *     voided_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/create-attendance-mark
     */
    public function createMark(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/attendance/marks', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar una marca
     *
     * La marca deja de contar y queda tachada con su motivo, quién y cuándo (nunca se borra). En
     * la app se puede restaurar.
     *
     * POST /v1/attendance/marks/{id}/void
     *
     * @param string $id
     * @param array{reason: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'attendance_mark',
     *     employee: string,
     *     kind: 'in'|'out',
     *     at: string,
     *     date: string,
     *     time: string,
     *     method: 'kiosk_qr'|'kiosk_pin'|'printed_qr'|'remote'|'manual'|'api',
     *     place: string|null,
     *     distance_m: float|int|null,
     *     flags: list<'no_location'|'far'|'imprecise'|'remote'|'new_device'>,
     *     reason: string|null,
     *     created_by: string|null,
     *     voided: bool,
     *     void_reason: string|null,
     *     voided_by: string|null,
     *     voided_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/void-attendance-mark
     */
    public function voidMark(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/attendance/marks/' . rawurlencode($id) . '/void', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Autorizar o rechazar horas extra
     *
     * Hasta cuántos minutos de horas extra de un día de un empleado cuentan para la nómina, antes
     * o después de ese día, o rechazarlas todas (rejected: true, con comment). minutes null quita
     * la decisión. Con la regla de horas extra «Necesitan autorización», lo que nadie autorizó
     * queda en el registro como sin autorizar.
     *
     * POST /v1/attendance/overtime
     *
     * @param array{
     *     employee: string,
     *     date: string,
     *     minutes: int|null,
     *     rejected?: bool,
     *     comment?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'attendance_overtime',
     *     livemode: bool,
     *     employee: string,
     *     date: string,
     *     minutes: int|null,
     *     rejected: bool,
     *     comment: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/approve-attendance-overtime
     */
    public function approveOvertime(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/attendance/overtime', ['body' => $params, 'idempotent' => true], $options);
    }
}
