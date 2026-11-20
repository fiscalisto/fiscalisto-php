<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->variableSalaries.
 */
final class VariableSalaries
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Salario variable de un bimestre
     *
     * Lo que las horas extra triples, la prima dominical, otros ingresos y lo que los premios de
     * puntualidad y asistencia pasan del 10% del SBC suman al SDI de cada empleado, de los recibos
     * timbrados del bimestre, entre sus días trabajados (artículos 27 y 30 de la LSS). Las horas
     * dobles no cuentan. No cambia nada: aplíquelo con POST /v1/variable_salaries.
     *
     * GET /v1/variable_salaries
     *
     * @param array{issuer?: string, bimester: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'variable_salary',
     *     livemode: bool,
     *     issuer: string,
     *     bimester: string,
     *     period_start: string,
     *     period_end: string,
     *     effective_date: string,
     *     deadline: string,
     *     employees: list<array{employee: string, employee_number: string, employee_name: string, variable_income: float|int, days: float|int, daily_variable: float|int, fixed_integrated_daily_salary: float|int, current_variable: float|int, new_integrated_daily_salary: float|int, changes: bool, applied: bool, lines: list<array<string, mixed>>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-variable-salary
     */
    public function get(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/variable_salaries', ['query' => $params], $options);
    }

    /**
     * Aplicar el salario variable de un bimestre
     *
     * A los empleados que diga: su parte variable del SDI desde el primer día del bimestre
     * siguiente (los recibos de periodos anteriores siguen con la que tenían) y la modificación de
     * salario pendiente de presentar en IDSE (GET /v1/imss_movements), a más tardar el quinto día
     * hábil del mes (artículo 34 de la LSS). Repetirlo no hace nada.
     *
     * POST /v1/variable_salaries
     *
     * @param array{issuer?: string, bimester: string, employees: list<string>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'variable_salary',
     *     livemode: bool,
     *     issuer: string,
     *     bimester: string,
     *     period_start: string,
     *     period_end: string,
     *     effective_date: string,
     *     deadline: string,
     *     employees: list<array{employee: string, employee_number: string, employee_name: string, variable_income: float|int, days: float|int, daily_variable: float|int, fixed_integrated_daily_salary: float|int, current_variable: float|int, new_integrated_daily_salary: float|int, changes: bool, applied: bool, lines: list<array<string, mixed>>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/apply-variable-salary
     */
    public function apply(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/variable_salaries', ['body' => $params, 'idempotent' => true], $options);
    }
}
