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
     * @return Collection<array{id: string, livemode: bool, object: 'employee', issuer: string, number: string, name: string, tax_id: string, curp: string, social_security_number: string, zip: string, email: string|null, start_date: string, end_date: string|null, daily_salary: float|int, integrated_daily_salary: float|int, variable_integrated_daily_salary: float|int, variable_salary_from: string|null, contract_type: string, workday_type: string, regime_type: string, periodicity: string, risk_class: string, state: string, border_zone: bool, unionized: bool, department: string|null, position: string|null, clabe: string|null, given_names: string|null, first_surname: string|null, second_surname: string|null, imss_worker_type: string, imss_salary_type: string, imss_reduced_week: string, family_medicine_unit: string|null, exit_reason: string|null, warnings: list<string>, created_at: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-employees
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/employees', $params, $options);
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
}
