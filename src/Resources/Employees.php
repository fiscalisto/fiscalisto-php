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
     *     warnings: list<string>,
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
     * GET /v1/employees
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'employee', issuer: string, number: string, name: string, tax_id: string, curp: string, social_security_number: string, zip: string, email: string|null, start_date: string, end_date: string|null, daily_salary: float|int, integrated_daily_salary: float|int, contract_type: string, workday_type: string, regime_type: string, periodicity: string, risk_class: string, state: string, border_zone: bool, unionized: bool, department: string|null, position: string|null, warnings: list<string>}>
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
     *     warnings: list<string>,
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
     *     warnings: list<string>,
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
}
