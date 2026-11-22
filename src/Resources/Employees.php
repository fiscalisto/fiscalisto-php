<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->employees.
 */
final class Employees
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un empleado
     *
     * Un empleado del emisor para sus recibos de nómina: RFC, CURP, NSS, salario diario, salario
     * diario integrado y periodicidad. Lo que no mande tiene el valor usual (contrato indefinido,
     * jornada diurna, quincenal, riesgo clase I). warnings dice lo que el SAT podría rechazar.
     *
     * POST /v1/employees
     *
     * @param array{
     *     issuer?: string,
     *     number: string,
     *     name: string,
     *     tax_id: string,
     *     curp: string,
     *     social_security_number: string,
     *     zip: string,
     *     email?: string|null,
     *     start_date: string,
     *     end_date?: string|null,
     *     daily_salary: float|int,
     *     integrated_daily_salary: float|int,
     *     aguinaldo_days?: float|int,
     *     vacation_premium?: float|int,
     *     pantry_vouchers?: float|int,
     *     savings_fund_rate?: float|int,
     *     contract_type?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08',
     *     workday_type?: string,
     *     periodicity?: string,
     *     risk_class?: string,
     *     state: string,
     *     border_zone?: bool,
     *     unionized?: bool,
     *     department?: string|null,
     *     position?: string|null,
     *     clabe?: string|null,
     *     given_names?: string|null,
     *     first_surname?: string|null,
     *     second_surname?: string|null,
     *     imss_worker_type?: '1'|'2'|'3'|'4',
     *     imss_salary_type?: '0'|'1'|'2',
     *     imss_reduced_week?: '0'|'1'|'2'|'3'|'4'|'5'|'6',
     *     family_medicine_unit?: string|null,
     *     exit_reason?: '1'|'2'|'3'|'4'|'5'|'6'|'7'|'8'|'9'|'A'|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'employee',
     *     issuer: string,
     *     number: string,
     *     name: string,
     *     tax_id: string,
     *     curp: string,
     *     social_security_number: string,
     *     zip: string,
     *     email: string|null,
     *     start_date: string,
     *     end_date: string|null,
     *     daily_salary: float|int,
     *     integrated_daily_salary: float|int,
     *     variable_integrated_daily_salary: float|int,
     *     variable_salary_from: string|null,
     *     aguinaldo_days: float|int,
     *     vacation_premium: float|int,
     *     pantry_vouchers: float|int,
     *     savings_fund_rate: float|int,
     *     contract_type: string,
     *     workday_type: string,
     *     regime_type: string,
     *     periodicity: string,
     *     risk_class: string,
     *     state: string,
     *     border_zone: bool,
     *     unionized: bool,
     *     department: string|null,
     *     position: string|null,
     *     clabe: string|null,
     *     given_names: string|null,
     *     first_surname: string|null,
     *     second_surname: string|null,
     *     imss_worker_type: string,
     *     imss_salary_type: string,
     *     imss_reduced_week: string,
     *     family_medicine_unit: string|null,
     *     exit_reason: string|null,
     *     warnings: list<string>,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-employee
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employees', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar empleados
     *
     * Los empleados del emisor, los más recientes primero.
     *
     * GET /v1/employees
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'employee', issuer: string, number: string, name: string, tax_id: string, curp: string, social_security_number: string, zip: string, email: string|null, start_date: string, end_date: string|null, daily_salary: float|int, integrated_daily_salary: float|int, variable_integrated_daily_salary: float|int, variable_salary_from: string|null, aguinaldo_days: float|int, vacation_premium: float|int, pantry_vouchers: float|int, savings_fund_rate: float|int, contract_type: string, workday_type: string, regime_type: string, periodicity: string, risk_class: string, state: string, border_zone: bool, unionized: bool, department: string|null, position: string|null, clabe: string|null, given_names: string|null, first_surname: string|null, second_surname: string|null, imss_worker_type: string, imss_salary_type: string, imss_reduced_week: string, family_medicine_unit: string|null, exit_reason: string|null, warnings: list<string>, created_at: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-employees
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/employees', $params, $options);
    }

    /**
     * Aumento de sueldo
     *
     * Un aumento para varios empleados a la vez, como «Aumento de sueldo» en Nómina › Empleados de
     * la app: percent (porcentaje), amount (pesos más por día) o daily_salary (un salario nuevo).
     * Cada empleado conserva su factor de integración (SDI ÷ salario), y el SDI nuevo queda como
     * modificación de salario con fecha effective_date en Movimientos del IMSS, para presentarla a
     * más tardar en imss_deadline (5 días hábiles, artículo 34 de la Ley del Seguro Social). Rige
     * desde hoy o antes; los periodos ya timbrados desde entonces se pagan con el retroactivo de
     * las incidencias. Si un empleado no puede recibirlo (no es un aumento, queda bajo el salario
     * mínimo, no trabajaba ese día), contesta 400 y no cambia a nadie; dry_run true dice cómo
     * quedaría cada uno, con su error, sin guardar.
     *
     * POST /v1/employee_raises
     *
     * @param array{
     *     issuer?: string,
     *     employees?: list<string>,
     *     percent?: float|int,
     *     amount?: float|int,
     *     daily_salary?: float|int,
     *     effective_date?: string,
     *     dry_run?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_raise',
     *     livemode: bool,
     *     issuer: string,
     *     applied: bool,
     *     effective_date: string,
     *     imss_deadline: string,
     *     employees: list<array{employee: string, number: string, name: string, daily_salary_before: float|int, daily_salary: float|int, integrated_daily_salary_before: float|int, integrated_daily_salary: float|int, error: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-employee-raise
     */
    public function giveRaise(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employee_raises', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver un empleado
     *
     * Un empleado con sus datos y lo que el SAT podría rechazar en warnings.
     *
     * GET /v1/employees/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'employee',
     *     issuer: string,
     *     number: string,
     *     name: string,
     *     tax_id: string,
     *     curp: string,
     *     social_security_number: string,
     *     zip: string,
     *     email: string|null,
     *     start_date: string,
     *     end_date: string|null,
     *     daily_salary: float|int,
     *     integrated_daily_salary: float|int,
     *     variable_integrated_daily_salary: float|int,
     *     variable_salary_from: string|null,
     *     aguinaldo_days: float|int,
     *     vacation_premium: float|int,
     *     pantry_vouchers: float|int,
     *     savings_fund_rate: float|int,
     *     contract_type: string,
     *     workday_type: string,
     *     regime_type: string,
     *     periodicity: string,
     *     risk_class: string,
     *     state: string,
     *     border_zone: bool,
     *     unionized: bool,
     *     department: string|null,
     *     position: string|null,
     *     clabe: string|null,
     *     given_names: string|null,
     *     first_surname: string|null,
     *     second_surname: string|null,
     *     imss_worker_type: string,
     *     imss_salary_type: string,
     *     imss_reduced_week: string,
     *     family_medicine_unit: string|null,
     *     exit_reason: string|null,
     *     warnings: list<string>,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-employee
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employees/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un empleado
     *
     * Cambia solo los campos que manda; los recibos ya timbrados no cambian.
     *
     * POST /v1/employees/{id}
     *
     * @param string $id
     * @param array{
     *     number?: string,
     *     name?: string,
     *     tax_id?: string,
     *     curp?: string,
     *     social_security_number?: string,
     *     zip?: string,
     *     email?: string|null,
     *     start_date?: string,
     *     end_date?: string|null,
     *     daily_salary?: float|int,
     *     integrated_daily_salary?: float|int,
     *     aguinaldo_days?: float|int,
     *     vacation_premium?: float|int,
     *     pantry_vouchers?: float|int,
     *     savings_fund_rate?: float|int,
     *     contract_type?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08',
     *     workday_type?: string,
     *     periodicity?: string,
     *     risk_class?: string,
     *     state?: string,
     *     border_zone?: bool,
     *     unionized?: bool,
     *     department?: string|null,
     *     position?: string|null,
     *     clabe?: string|null,
     *     given_names?: string|null,
     *     first_surname?: string|null,
     *     second_surname?: string|null,
     *     imss_worker_type?: '1'|'2'|'3'|'4',
     *     imss_salary_type?: '0'|'1'|'2',
     *     imss_reduced_week?: '0'|'1'|'2'|'3'|'4'|'5'|'6',
     *     family_medicine_unit?: string|null,
     *     exit_reason?: '1'|'2'|'3'|'4'|'5'|'6'|'7'|'8'|'9'|'A'|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'employee',
     *     issuer: string,
     *     number: string,
     *     name: string,
     *     tax_id: string,
     *     curp: string,
     *     social_security_number: string,
     *     zip: string,
     *     email: string|null,
     *     start_date: string,
     *     end_date: string|null,
     *     daily_salary: float|int,
     *     integrated_daily_salary: float|int,
     *     variable_integrated_daily_salary: float|int,
     *     variable_salary_from: string|null,
     *     aguinaldo_days: float|int,
     *     vacation_premium: float|int,
     *     pantry_vouchers: float|int,
     *     savings_fund_rate: float|int,
     *     contract_type: string,
     *     workday_type: string,
     *     regime_type: string,
     *     periodicity: string,
     *     risk_class: string,
     *     state: string,
     *     border_zone: bool,
     *     unionized: bool,
     *     department: string|null,
     *     position: string|null,
     *     clabe: string|null,
     *     given_names: string|null,
     *     first_surname: string|null,
     *     second_surname: string|null,
     *     imss_worker_type: string,
     *     imss_salary_type: string,
     *     imss_reduced_week: string,
     *     family_medicine_unit: string|null,
     *     exit_reason: string|null,
     *     warnings: list<string>,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-employee
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employees/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un empleado
     *
     * Sus recibos timbrados se quedan.
     *
     * DELETE /v1/employees/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-employee
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/employees/' . rawurlencode($id), [], $options);
    }

    /**
     * Vacaciones de un empleado
     *
     * Los días de vacaciones de cada año de servicio (artículo 76 de la LFT: 12 el primero, dos
     * más cada año hasta 20 y luego dos más cada cinco), los que tomó (los días de vacaciones de
     * sus recibos timbrados, restados del año más antiguo que le quede), hasta cuándo dárselos
     * (seis meses después del aniversario, artículo 81) y cuándo prescriben (un año después,
     * artículo 516). pending_days son los de años cumplidos que no han prescrito: los que paga el
     * finiquito.
     *
     * GET /v1/employees/{id}/vacations
     *
     * @param string $id
     * @param array{as_of?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_vacations',
     *     livemode: bool,
     *     employee: string,
     *     as_of: string,
     *     pending_days: float|int,
     *     current_year: array{year: int, completes_on: string, days: float|int, taken_in_advance: float|int, accrued_days: float|int},
     *     years: list<array{year: int, owed_from: string, days: float|int, taken_days: float|int, remaining_days: float|int, grant_by: string, prescribes_on: string, status: 'taken'|'pending'|'late'|'prescribed'}>,
     *     opening: array{date: string, pending_days: float|int, taken_days: float|int}|null,
     *     taken: list<array{date: string, days: float|int}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-employee-vacations
     */
    public function vacations(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employees/' . rawurlencode($id) . '/vacations', ['query' => $params], $options);
    }

    /**
     * Saldo de vacaciones antes de Fiscalisto
     *
     * Guarda lo que el empleado tenía en un día según sus registros: los días que le quedaban de
     * años cumplidos y los que ya había tomado del año en curso. Los recibos timbrados antes de
     * ese día no se cuentan. opening_date null lo quita.
     *
     * POST /v1/employees/{id}/vacations
     *
     * @param string $id
     * @param array{
     *     opening_date: string|null,
     *     opening_pending_days?: float|int,
     *     opening_taken_days?: float|int,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_vacations',
     *     livemode: bool,
     *     employee: string,
     *     as_of: string,
     *     pending_days: float|int,
     *     current_year: array{year: int, completes_on: string, days: float|int, taken_in_advance: float|int, accrued_days: float|int},
     *     years: list<array{year: int, owed_from: string, days: float|int, taken_days: float|int, remaining_days: float|int, grant_by: string, prescribes_on: string, status: 'taken'|'pending'|'late'|'prescribed'}>,
     *     opening: array{date: string, pending_days: float|int, taken_days: float|int}|null,
     *     taken: list<array{date: string, days: float|int}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-employee-vacations
     */
    public function updateVacations(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employees/' . rawurlencode($id) . '/vacations', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Constancia de vacaciones
     *
     * El PDF de la constancia que el artículo 81 de la LFT pide entregar cada año: su antigüedad
     * al último aniversario, los días de vacaciones que le corresponden (artículo 76) con su prima
     * vacacional, cuándo disfrutarlos (las fechas que mande, o los seis meses siguientes al
     * aniversario) y los días pendientes de años anteriores con cuándo prescriben, con espacio
     * para las firmas. Antes de su primer aniversario dice cuándo lo cumple y cuántos días le
     * tocarán.
     *
     * GET /v1/employees/{id}/vacations/certificate
     *
     * @param string $id
     * @param array{enjoy_from?: string, enjoy_to?: string, as_of?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-employee-vacation-certificate
     */
    public function vacationCertificate(string $id, array $params = [], array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employees/' . rawurlencode($id) . '/vacations/certificate', ['query' => $params, 'as' => 'bytes'], $options);
    }

    /**
     * Constancia de sueldos
     *
     * El PDF de lo que se le pagó al empleado en un año, de sus recibos de nómina vigentes por
     * fecha de pago: cada percepción con su parte gravada y exenta, las deducciones (ISR retenido,
     * IMSS y otras), los otros pagos con el subsidio para el empleo causado, y el neto. Resume sus
     * CFDI de nómina, que son el comprobante de lo pagado y retenido (LISR art. 99 fr. III); no
     * los sustituye. El empleado la baja también desde su portal.
     *
     * GET /v1/employees/{id}/pay_statement
     *
     * @param string $id
     * @param array{year: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-employee-pay-statement
     */
    public function payStatement(string $id, array $params, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employees/' . rawurlencode($id) . '/pay_statement', ['query' => $params, 'as' => 'bytes'], $options);
    }

    /**
     * Portal del empleado
     *
     * El enlace personal del empleado (sin cuenta) para ver, descargar y firmar de recibido sus
     * recibos de nómina, ver sus vacaciones y pedir días; los celulares ligados, los que tienen
     * avisos, sus últimos avisos y los recibos que firmó.
     *
     * GET /v1/employees/{id}/portal
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_portal',
     *     livemode: bool,
     *     employee: string,
     *     url: string|null,
     *     enabled_at: string|null,
     *     phones: int,
     *     last_seen_at: string|null,
     *     push_phones: int,
     *     notices: list<array{kind: 'receipt'|'receipt_canceled'|'vacation_approved'|'vacation_rejected'|'sign_reminder', channel: 'push'|'email'|'off'|'none'|'skipped'|'stale'|null, created_at: string, sent_at: string|null}>,
     *     signed_receipts: list<array{uuid: string, signed_at: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-employee-portal
     */
    public function portal(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employees/' . rawurlencode($id) . '/portal', [], $options);
    }

    /**
     * Activar, cambiar o apagar el portal
     *
     * enable crea el enlace (o deja el que tiene), renew hace uno nuevo (el anterior deja de
     * funcionar y sus celulares se desligan) y disable lo apaga. Lo firmado se queda. Con
     * send_email se lo manda a su correo.
     *
     * POST /v1/employees/{id}/portal
     *
     * @param string $id
     * @param array{action: 'enable'|'renew'|'disable', send_email?: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_portal',
     *     livemode: bool,
     *     employee: string,
     *     url: string|null,
     *     enabled_at: string|null,
     *     phones: int,
     *     last_seen_at: string|null,
     *     push_phones: int,
     *     notices: list<array{kind: 'receipt'|'receipt_canceled'|'vacation_approved'|'vacation_rejected'|'sign_reminder', channel: 'push'|'email'|'off'|'none'|'skipped'|'stale'|null, created_at: string, sent_at: string|null}>,
     *     signed_receipts: list<array{uuid: string, signed_at: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-employee-portal
     */
    public function updatePortal(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employees/' . rawurlencode($id) . '/portal', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Capacitación de un empleado
     *
     * Su ocupación del Catálogo Nacional de Ocupaciones (la suya o la de su puesto), su grado de
     * estudios y los cursos que tomó con su constancia.
     *
     * GET /v1/employees/{id}/training
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_training',
     *     livemode: bool,
     *     issuer: string,
     *     employee: string,
     *     occupation: string|null,
     *     own_occupation: string|null,
     *     education: string|null,
     *     courses: list<array{course: string, participant: string, name: string, thematic_area: string, hours: float|int, start_date: string, end_date: string, result: string, folio: int|null, issued_at: string|null, delivered_at: string|null, expires_on: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-employee-training
     */
    public function training(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employees/' . rawurlencode($id) . '/training', [], $options);
    }

    /**
     * Ocupación y estudios de un empleado
     *
     * Su ocupación cuando no es la de su puesto (null usa la del puesto) y su grado de estudios
     * terminados, que pide el aviso a la STPS.
     *
     * POST /v1/employees/{id}/training
     *
     * @param string $id
     * @param array{
     *     occupation?: string|null,
     *     education?: 'primaria'|'secundaria'|'bachillerato'|'tecnico'|'licenciatura'|'especialidad'|'maestria'|'doctorado'|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_training',
     *     livemode: bool,
     *     issuer: string,
     *     employee: string,
     *     occupation: string|null,
     *     own_occupation: string|null,
     *     education: string|null,
     *     courses: list<array{course: string, participant: string, name: string, thematic_area: string, hours: float|int, start_date: string, end_date: string, result: string, folio: int|null, issued_at: string|null, delivered_at: string|null, expires_on: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-employee-training
     */
    public function updateTraining(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employees/' . rawurlencode($id) . '/training', ['body' => $params, 'idempotent' => true], $options);
    }
}
