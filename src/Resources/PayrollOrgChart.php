<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollOrgChart.
 */
final class PayrollOrgChart
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Organigrama
     *
     * Como «Nómina › Organigrama» de la app: los empleados de hoy del emisor con su jefe directo,
     * departamento y sucursal, cuántas personas dependen de cada uno (directas y en toda su
     * cadena), los departamentos con sus subdepartamentos, las vacantes y un resumen (jefes, tramo
     * promedio, quién queda sin jefe o sin departamento). Quien no tiene jefe, o cuyo jefe ya se
     * fue, queda arriba; un círculo que dejó una importación se rompe en el de número más bajo.
     *
     * GET /v1/payroll_org_chart
     *
     * @param array{issuer?: string, as_of?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_org_chart',
     *     livemode: bool,
     *     issuer: string,
     *     as_of: string,
     *     summary: array{employees: int, managers: int, average_span: float|int, departments: int, branches: int, vacancies: int, without_manager: list<string>, wide_span: list<string>, without_department: list<string>},
     *     top: list<string>,
     *     employees: list<array{employee: string, number: string, name: string, position: string|null, department: string|null, branch: string|null, manager: string|null, direct_reports: int, total_reports: int}>,
     *     departments: list<array{name: string, parent: string|null, lead: string|null, employees: int, total_employees: int, depth: int}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, manager: string|null, branch: string|null, opened_on: string, status: 'pending_approval'|'approved'|'rejected'|'filled', salary_min: float|int|null, salary_max: float|int|null, state: string|null, monthly_cost: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-payroll-org-chart
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payroll_org_chart', ['query' => $params], $options);
    }

    /**
     * Cambiar jefe, departamento o sucursal
     *
     * Cambia el jefe directo, el departamento o la sucursal de uno o varios empleados (hasta 500);
     * lo que no manda no cambia. Un jefe que, subiendo por su cadena, depende de alguno de ellos
     * contesta parameter_invalid: quedarían en círculo. El departamento es el que llevan sus
     * recibos (Departamento). Contesta el organigrama ya cambiado.
     *
     * POST /v1/payroll_org_chart/assign
     *
     * @param array{
     *     issuer?: string,
     *     employees: list<string>,
     *     manager?: string|null,
     *     department?: string|null,
     *     branch?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_org_chart',
     *     livemode: bool,
     *     issuer: string,
     *     as_of: string,
     *     summary: array{employees: int, managers: int, average_span: float|int, departments: int, branches: int, vacancies: int, without_manager: list<string>, wide_span: list<string>, without_department: list<string>},
     *     top: list<string>,
     *     employees: list<array{employee: string, number: string, name: string, position: string|null, department: string|null, branch: string|null, manager: string|null, direct_reports: int, total_reports: int}>,
     *     departments: list<array{name: string, parent: string|null, lead: string|null, employees: int, total_employees: int, depth: int}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, manager: string|null, branch: string|null, opened_on: string, status: 'pending_approval'|'approved'|'rejected'|'filled', salary_min: float|int|null, salary_max: float|int|null, state: string|null, monthly_cost: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/assign-payroll-org-chart
     */
    public function assign(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_org_chart/assign', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Crear o cambiar un departamento
     *
     * Crea el departamento name o, si ya existe, lo cambia: new_name lo renombra (también en sus
     * empleados y vacantes), parent lo pone dentro de otro y lead le pone responsable. Un parent
     * que ya está dentro de él contesta parameter_invalid. Contesta el organigrama.
     *
     * POST /v1/payroll_org_chart/departments
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     new_name?: string,
     *     parent?: string|null,
     *     lead?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_org_chart',
     *     livemode: bool,
     *     issuer: string,
     *     as_of: string,
     *     summary: array{employees: int, managers: int, average_span: float|int, departments: int, branches: int, vacancies: int, without_manager: list<string>, wide_span: list<string>, without_department: list<string>},
     *     top: list<string>,
     *     employees: list<array{employee: string, number: string, name: string, position: string|null, department: string|null, branch: string|null, manager: string|null, direct_reports: int, total_reports: int}>,
     *     departments: list<array{name: string, parent: string|null, lead: string|null, employees: int, total_employees: int, depth: int}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, manager: string|null, branch: string|null, opened_on: string, status: 'pending_approval'|'approved'|'rejected'|'filled', salary_min: float|int|null, salary_max: float|int|null, state: string|null, monthly_cost: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/save-payroll-department
     */
    public function saveDepartment(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_org_chart/departments', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar un departamento
     *
     * Quita un departamento sin personas; los que estaban dentro de él suben un nivel. Con
     * personas contesta parameter_invalid: cámbielas antes con POST /v1/payroll_org_chart/assign.
     * Contesta el organigrama.
     *
     * POST /v1/payroll_org_chart/departments/remove
     *
     * @param array{issuer?: string, name: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_org_chart',
     *     livemode: bool,
     *     issuer: string,
     *     as_of: string,
     *     summary: array{employees: int, managers: int, average_span: float|int, departments: int, branches: int, vacancies: int, without_manager: list<string>, wide_span: list<string>, without_department: list<string>},
     *     top: list<string>,
     *     employees: list<array{employee: string, number: string, name: string, position: string|null, department: string|null, branch: string|null, manager: string|null, direct_reports: int, total_reports: int}>,
     *     departments: list<array{name: string, parent: string|null, lead: string|null, employees: int, total_employees: int, depth: int}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, manager: string|null, branch: string|null, opened_on: string, status: 'pending_approval'|'approved'|'rejected'|'filled', salary_min: float|int|null, salary_max: float|int|null, state: string|null, monthly_cost: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/remove-payroll-department
     */
    public function removeDepartment(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_org_chart/departments/remove', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Abrir una vacante
     *
     * Un puesto sin persona todavía, bajo un jefe, en un departamento y una sucursal, con el
     * sueldo mensual que ofrece: sale en el organigrama, pero no cuenta como empleado. Queda en
     * pending_approval hasta que alguien con el permiso «Aprobar la prenómina» la aprueba en la
     * app (le llega un aviso); entonces se cubre con POST
     * /v1/payroll_org_chart/vacancies/{id}/fill. Contesta el organigrama, con lo que costaría al
     * mes (monthly_cost).
     *
     * POST /v1/payroll_org_chart/vacancies
     *
     * @param array{
     *     issuer?: string,
     *     title: string,
     *     department?: string|null,
     *     manager?: string|null,
     *     branch?: string|null,
     *     opened_on?: string,
     *     salary_min?: float|int|null,
     *     salary_max?: float|int|null,
     *     state?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_org_chart',
     *     livemode: bool,
     *     issuer: string,
     *     as_of: string,
     *     summary: array{employees: int, managers: int, average_span: float|int, departments: int, branches: int, vacancies: int, without_manager: list<string>, wide_span: list<string>, without_department: list<string>},
     *     top: list<string>,
     *     employees: list<array{employee: string, number: string, name: string, position: string|null, department: string|null, branch: string|null, manager: string|null, direct_reports: int, total_reports: int}>,
     *     departments: list<array{name: string, parent: string|null, lead: string|null, employees: int, total_employees: int, depth: int}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, manager: string|null, branch: string|null, opened_on: string, status: 'pending_approval'|'approved'|'rejected'|'filled', salary_min: float|int|null, salary_max: float|int|null, state: string|null, monthly_cost: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-payroll-vacancy
     */
    public function createVacancy(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_org_chart/vacancies', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar una vacante
     *
     * Cambia el puesto, departamento, jefe, sucursal o sueldo de una vacante (vac_…); lo que no
     * manda queda vacío. Cambiada, vuelve a pending_approval. Una ya cubierta contesta
     * parameter_invalid.
     *
     * POST /v1/payroll_org_chart/vacancies/{id}
     *
     * @param string $id
     * @param array{
     *     issuer?: string,
     *     title: string,
     *     department?: string|null,
     *     manager?: string|null,
     *     branch?: string|null,
     *     opened_on?: string,
     *     salary_min?: float|int|null,
     *     salary_max?: float|int|null,
     *     state?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_org_chart',
     *     livemode: bool,
     *     issuer: string,
     *     as_of: string,
     *     summary: array{employees: int, managers: int, average_span: float|int, departments: int, branches: int, vacancies: int, without_manager: list<string>, wide_span: list<string>, without_department: list<string>},
     *     top: list<string>,
     *     employees: list<array{employee: string, number: string, name: string, position: string|null, department: string|null, branch: string|null, manager: string|null, direct_reports: int, total_reports: int}>,
     *     departments: list<array{name: string, parent: string|null, lead: string|null, employees: int, total_employees: int, depth: int}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, manager: string|null, branch: string|null, opened_on: string, status: 'pending_approval'|'approved'|'rejected'|'filled', salary_min: float|int|null, salary_max: float|int|null, state: string|null, monthly_cost: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-payroll-vacancy
     */
    public function updateVacancy(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_org_chart/vacancies/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cerrar una vacante
     *
     * La quita del organigrama (se cubrió o ya no hace falta). Contesta el organigrama.
     *
     * DELETE /v1/payroll_org_chart/vacancies/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_org_chart',
     *     livemode: bool,
     *     issuer: string,
     *     as_of: string,
     *     summary: array{employees: int, managers: int, average_span: float|int, departments: int, branches: int, vacancies: int, without_manager: list<string>, wide_span: list<string>, without_department: list<string>},
     *     top: list<string>,
     *     employees: list<array{employee: string, number: string, name: string, position: string|null, department: string|null, branch: string|null, manager: string|null, direct_reports: int, total_reports: int}>,
     *     departments: list<array{name: string, parent: string|null, lead: string|null, employees: int, total_employees: int, depth: int}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, manager: string|null, branch: string|null, opened_on: string, status: 'pending_approval'|'approved'|'rejected'|'filled', salary_min: float|int|null, salary_max: float|int|null, state: string|null, monthly_cost: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-payroll-vacancy
     */
    public function deleteVacancy(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/payroll_org_chart/vacancies/' . rawurlencode($id), [], $options);
    }

    /**
     * Cubrir una vacante
     *
     * La cubre con un empleado ya dado de alta (POST /v1/employees): queda con el jefe, el
     * departamento y la sucursal de la vacante, y la vacante sale del organigrama (status filled).
     * Una que espera aprobación o se rechazó contesta parameter_invalid. Falta su alta en el IMSS
     * (GET /v1/imss_movements la propone).
     *
     * POST /v1/payroll_org_chart/vacancies/{id}/fill
     *
     * @param string $id
     * @param array{employee: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_org_chart',
     *     livemode: bool,
     *     issuer: string,
     *     as_of: string,
     *     summary: array{employees: int, managers: int, average_span: float|int, departments: int, branches: int, vacancies: int, without_manager: list<string>, wide_span: list<string>, without_department: list<string>},
     *     top: list<string>,
     *     employees: list<array{employee: string, number: string, name: string, position: string|null, department: string|null, branch: string|null, manager: string|null, direct_reports: int, total_reports: int}>,
     *     departments: list<array{name: string, parent: string|null, lead: string|null, employees: int, total_employees: int, depth: int}>,
     *     vacancies: list<array{id: string, title: string, department: string|null, manager: string|null, branch: string|null, opened_on: string, status: 'pending_approval'|'approved'|'rejected'|'filled', salary_min: float|int|null, salary_max: float|int|null, state: string|null, monthly_cost: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/fill-payroll-vacancy
     */
    public function fillVacancy(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_org_chart/vacancies/' . rawurlencode($id) . '/fill', ['body' => $params, 'idempotent' => true], $options);
    }
}
