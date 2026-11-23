<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
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
     *     daily_jornada: 'agreed'|'law',
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
     *     flags: list<'no_location'|'far'|'imprecise'|'remote'|'new_device'|'offline'|'code_time'>,
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
     *     flags: list<'no_location'|'far'|'imprecise'|'remote'|'new_device'|'offline'|'code_time'>,
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

    /**
     * Listar los turnos
     *
     * Los turnos de Asistencia › Turnos (ats_…), los archivados también: sus tramos, sus minutos y
     * su jornada por ley (diurna, nocturna o mixta, LFT art. 60) con lo que dice la ley de ellos.
     *
     * GET /v1/attendance/shifts
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'attendance_shift', name: string, color: 'teal'|'blue'|'violet'|'amber'|'rose'|'slate', segments: list<array<string, mixed>>, break_minutes: int, break_paid: bool, minutes: int, jornada: 'diurna'|'nocturna'|'mixta', overnight: bool, warnings: list<string>, archived: bool}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/list-attendance-shifts
     */
    public function listShifts(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/attendance/shifts', $params, $options);
    }

    /**
     * Crear un turno
     *
     * Un turno con uno a tres tramos (con dos o tres es partido: el tiempo entre tramos no es
     * jornada); un tramo puede pasar de la medianoche. Se guarda aunque pase de la jornada del
     * art. 61 (con el acuerdo del trabajador, art. 58) y lo dice en warnings.
     *
     * POST /v1/attendance/shifts
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     segments: list<array{start: string, end: string}>,
     *     break_minutes?: int,
     *     break_paid?: bool,
     *     color?: 'teal'|'blue'|'violet'|'amber'|'rose'|'slate',
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'attendance_shift',
     *     name: string,
     *     color: 'teal'|'blue'|'violet'|'amber'|'rose'|'slate',
     *     segments: list<array{start: string, end: string}>,
     *     break_minutes: int,
     *     break_paid: bool,
     *     minutes: int,
     *     jornada: 'diurna'|'nocturna'|'mixta',
     *     overnight: bool,
     *     warnings: list<string>,
     *     archived: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/create-attendance-shift
     */
    public function createShift(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/attendance/shifts', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar un turno
     *
     * Cambia lo que mande y deja lo demás. Cambiar sus horas cambia los días que lo tienen desde
     * hoy; archived: true lo archiva.
     *
     * POST /v1/attendance/shifts/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     segments?: list<array{start: string, end: string}>,
     *     break_minutes?: int,
     *     break_paid?: bool,
     *     color?: 'teal'|'blue'|'violet'|'amber'|'rose'|'slate',
     *     archived?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'attendance_shift',
     *     name: string,
     *     color: 'teal'|'blue'|'violet'|'amber'|'rose'|'slate',
     *     segments: list<array{start: string, end: string}>,
     *     break_minutes: int,
     *     break_paid: bool,
     *     minutes: int,
     *     jornada: 'diurna'|'nocturna'|'mixta',
     *     overnight: bool,
     *     warnings: list<string>,
     *     archived: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/update-attendance-shift
     */
    public function updateShift(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/attendance/shifts/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar los roles de turnos
     *
     * Los roles de turnos (atr_…), los archivados también: el ciclo de turnos y descansos, el
     * promedio a la semana y el aviso del art. 69 si pasan más de seis días de trabajo sin
     * descanso.
     *
     * GET /v1/attendance/rotations
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'attendance_rotation', name: string, days: list<string|null>, week_minutes: int, warning: string|null, archived: bool}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/list-attendance-rotations
     */
    public function listRotations(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/attendance/rotations', $params, $options);
    }

    /**
     * Crear un rol de turnos
     *
     * Un ciclo de turnos y descansos en orden que vuelve a empezar al terminar (4×4: cuatro días
     * un turno y cuatro null). A cada empleado se le pone en la app, en Asistencia › Personas, con
     * el día en que cae su día 1.
     *
     * POST /v1/attendance/rotations
     *
     * @param array{issuer?: string, name: string, days: list<string|null>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'attendance_rotation',
     *     name: string,
     *     days: list<string|null>,
     *     week_minutes: int,
     *     warning: string|null,
     *     archived: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/create-attendance-rotation
     */
    public function createRotation(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/attendance/rotations', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar un rol de turnos
     *
     * Cambia su nombre o su ciclo; archived: true lo archiva.
     *
     * POST /v1/attendance/rotations/{id}
     *
     * @param string $id
     * @param array{name?: string, days?: list<string|null>, archived?: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'attendance_rotation',
     *     name: string,
     *     days: list<string|null>,
     *     week_minutes: int,
     *     warning: string|null,
     *     archived: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/update-attendance-rotation
     */
    public function updateRotation(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/attendance/rotations/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver el calendario de turnos
     *
     * El turno de cada empleado cada día de un mes y de dónde sale: un cambio puesto en el
     * calendario, su rol de turnos o su horario de la semana.
     *
     * GET /v1/attendance/calendar
     *
     * @param array{issuer?: string, month: string, employee?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'attendance_calendar',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     from: string,
     *     to: string,
     *     daily_jornada: 'agreed'|'law',
     *     employees: list<array{employee: string, name: string, number: string|null, rotation: string|null, warning: string|null, days: list<array<string, mixed>>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/get-attendance-calendar
     */
    public function getCalendar(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/attendance/calendar', ['query' => $params], $options);
    }

    /**
     * Poner turnos en el calendario
     *
     * Pone un turno (o descanso, shift null) en unos días de unos empleados, y gana sobre su rol y
     * su horario: un cambio de turno, un descanso extra. clear: true lo quita y esos días vuelven
     * a su rol u horario. Hasta 62 días y 500 empleados a la vez.
     *
     * POST /v1/attendance/calendar
     *
     * @param array{
     *     employees: list<string>,
     *     dates: list<string>,
     *     shift: string|null,
     *     clear?: bool,
     *     comment?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'attendance_calendar_change',
     *     livemode: bool,
     *     issuer: string,
     *     employees: int,
     *     days: int,
     *     shift: string|null,
     *     cleared: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/asistencia/set-attendance-calendar
     */
    public function setCalendar(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/attendance/calendar', ['body' => $params, 'idempotent' => true], $options);
    }
}
