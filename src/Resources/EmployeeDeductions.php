<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->employeeDeductions.
 */
final class EmployeeDeductions
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Agregar un descuento a un empleado
     *
     * Infonavit, Fonacot, pensión alimenticia, préstamo o anticipo del patrón, caja de ahorro o
     * cuota sindical. Cada recibo ordinario desde start_date lo toma solo (POST
     * /v1/payroll_receipts), con los límites de la Ley Federal del Trabajo: Infonavit por cada día
     * del periodo aunque haya faltas, más $15 de seguro de daños por bimestre; Fonacot hasta el
     * 20% del sueldo; préstamos, anticipos y caja hasta el 30% de lo que el sueldo excede del
     * salario mínimo; del salario mínimo solo la pensión, Infonavit (20%) y Fonacot (10%). La
     * pensión va primero, y lo que no alcanza del neto no se descuenta.
     *
     * POST /v1/employee_deductions
     *
     * @param array{
     *     employee: string,
     *     kind: 'infonavit'|'fonacot'|'pension'|'prestamo'|'anticipo'|'caja'|'sindical',
     *     mode: 'percent_sbc'|'fixed_month'|'vsm'|'percent_net'|'percent_gross'|'fixed_period'|'percent_salary',
     *     value: float|int,
     *     total?: float|int|null,
     *     reference?: string|null,
     *     beneficiary?: string|null,
     *     start_date: string,
     *     end_date?: string|null,
     *     extraordinary?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'employee_deduction',
     *     issuer: string,
     *     employee: string,
     *     kind: 'infonavit'|'fonacot'|'pension'|'prestamo'|'anticipo'|'caja'|'sindical',
     *     deduction_type: string,
     *     mode: 'percent_sbc'|'fixed_month'|'vsm'|'percent_net'|'percent_gross'|'fixed_period'|'percent_salary',
     *     value: float|int,
     *     total: float|int|null,
     *     paid: float|int,
     *     balance: float|int|null,
     *     reference: string|null,
     *     beneficiary: string|null,
     *     start_date: string,
     *     end_date: string|null,
     *     extraordinary: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-employee-deduction
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employee_deductions', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar descuentos
     *
     * Los descuentos vigentes del emisor, o de un empleado con employee.
     *
     * GET /v1/employee_deductions
     *
     * @param array{issuer?: string, employee?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'employee_deduction', issuer: string, employee: string, kind: 'infonavit'|'fonacot'|'pension'|'prestamo'|'anticipo'|'caja'|'sindical', deduction_type: string, mode: 'percent_sbc'|'fixed_month'|'vsm'|'percent_net'|'percent_gross'|'fixed_period'|'percent_salary', value: float|int, total: float|int|null, paid: float|int, balance: float|int|null, reference: string|null, beneficiary: string|null, start_date: string, end_date: string|null, extraordinary: bool}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-employee-deductions
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employee_deductions', ['query' => $params], $options);
    }

    /**
     * Ver un descuento
     *
     * El descuento con lo que ya tomaron los recibos (paid) y lo que falta de un préstamo
     * (balance).
     *
     * GET /v1/employee_deductions/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'employee_deduction',
     *     issuer: string,
     *     employee: string,
     *     kind: 'infonavit'|'fonacot'|'pension'|'prestamo'|'anticipo'|'caja'|'sindical',
     *     deduction_type: string,
     *     mode: 'percent_sbc'|'fixed_month'|'vsm'|'percent_net'|'percent_gross'|'fixed_period'|'percent_salary',
     *     value: float|int,
     *     total: float|int|null,
     *     paid: float|int,
     *     balance: float|int|null,
     *     reference: string|null,
     *     beneficiary: string|null,
     *     start_date: string,
     *     end_date: string|null,
     *     extraordinary: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-employee-deduction
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employee_deductions/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar un descuento
     *
     * Desde el siguiente recibo; los timbrados se quedan como están.
     *
     * POST /v1/employee_deductions/{id}
     *
     * @param string $id
     * @param array{
     *     kind?: 'infonavit'|'fonacot'|'pension'|'prestamo'|'anticipo'|'caja'|'sindical',
     *     mode?: 'percent_sbc'|'fixed_month'|'vsm'|'percent_net'|'percent_gross'|'fixed_period'|'percent_salary',
     *     value?: float|int,
     *     total?: float|int|null,
     *     reference?: string|null,
     *     beneficiary?: string|null,
     *     start_date?: string,
     *     end_date?: string|null,
     *     extraordinary?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'employee_deduction',
     *     issuer: string,
     *     employee: string,
     *     kind: 'infonavit'|'fonacot'|'pension'|'prestamo'|'anticipo'|'caja'|'sindical',
     *     deduction_type: string,
     *     mode: 'percent_sbc'|'fixed_month'|'vsm'|'percent_net'|'percent_gross'|'fixed_period'|'percent_salary',
     *     value: float|int,
     *     total: float|int|null,
     *     paid: float|int,
     *     balance: float|int|null,
     *     reference: string|null,
     *     beneficiary: string|null,
     *     start_date: string,
     *     end_date: string|null,
     *     extraordinary: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-employee-deduction
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employee_deductions/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar un descuento
     *
     * Los recibos siguientes ya no lo toman; los timbrados lo conservan.
     *
     * DELETE /v1/employee_deductions/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-employee-deduction
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/employee_deductions/' . rawurlencode($id), [], $options);
    }
}
