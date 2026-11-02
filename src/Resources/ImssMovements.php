<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->imssMovements.
 */
final class ImssMovements
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Agregar un movimiento del IMSS
     *
     * Un movimiento afiliatorio a mano. Casi nunca hace falta: al crear un empleado se registra su
     * alta, al cambiar su integrated_daily_salary la modificación (con fecha de hoy), al ponerle
     * end_date su baja y al volver a contratarlo su reingreso. Queda pendiente de presentar.
     *
     * POST /v1/imss_movements
     *
     * @param array{
     *     employee: string,
     *     kind: 'alta'|'reingreso'|'modificacion'|'baja',
     *     date: string,
     *     integrated_daily_salary?: float|int|null,
     *     exit_reason?: '1'|'2'|'3'|'4'|'5'|'6'|'7'|'8'|'9'|'A'|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'imss_movement',
     *     issuer: string,
     *     employee: string,
     *     employee_number: string,
     *     employee_name: string,
     *     social_security_number: string,
     *     kind: 'alta'|'reingreso'|'modificacion'|'baja',
     *     movement_type: '08'|'07'|'02',
     *     date: string,
     *     integrated_daily_salary: float|int|null,
     *     exit_reason: string|null,
     *     source: 'automatic'|'manual',
     *     status: 'pending'|'reported',
     *     reported_at: string|null,
     *     problems: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-imss-movement
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/imss_movements', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar movimientos del IMSS
     *
     * Los movimientos del emisor por presentar (status=pending, por omisión: todos, del más
     * antiguo al más reciente, como van en los archivos) o ya presentados (status=reported: los
     * 500 más recientes).
     *
     * GET /v1/imss_movements
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'pending'|'reported',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'imss_movement', issuer: string, employee: string, employee_number: string, employee_name: string, social_security_number: string, kind: 'alta'|'reingreso'|'modificacion'|'baja', movement_type: '08'|'07'|'02', date: string, integrated_daily_salary: float|int|null, exit_reason: string|null, source: 'automatic'|'manual', status: 'pending'|'reported', reported_at: string|null, problems: list<string>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-imss-movements
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/imss_movements', $params, $options);
    }

    /**
     * Marcar movimientos como presentados
     *
     * Cuando el IMSS ya los recibió (el acuse de IDSE o la importación en SUA): pasan a reported y
     * ya no cambian ni se borran. Con reported false vuelven a pendientes. Devuelve los
     * movimientos como quedaron.
     *
     * POST /v1/imss_movements/report
     *
     * @param array{issuer?: string, movements: list<string>, reported?: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'imss_movement', issuer: string, employee: string, employee_number: string, employee_name: string, social_security_number: string, kind: 'alta'|'reingreso'|'modificacion'|'baja', movement_type: '08'|'07'|'02', date: string, integrated_daily_salary: float|int|null, exit_reason: string|null, source: 'automatic'|'manual', status: 'pending'|'reported', reported_at: string|null, problems: list<string>}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/report-imss-movements
     */
    public function report(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/imss_movements/report', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver un movimiento del IMSS
     *
     * El movimiento con lo que el IMSS rechazaría en problems.
     *
     * GET /v1/imss_movements/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'imss_movement',
     *     issuer: string,
     *     employee: string,
     *     employee_number: string,
     *     employee_name: string,
     *     social_security_number: string,
     *     kind: 'alta'|'reingreso'|'modificacion'|'baja',
     *     movement_type: '08'|'07'|'02',
     *     date: string,
     *     integrated_daily_salary: float|int|null,
     *     exit_reason: string|null,
     *     source: 'automatic'|'manual',
     *     status: 'pending'|'reported',
     *     reported_at: string|null,
     *     problems: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-imss-movement
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/imss_movements/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar un movimiento del IMSS
     *
     * Solo uno pendiente: uno ya presentado se queda como lo tiene el IMSS.
     *
     * POST /v1/imss_movements/{id}
     *
     * @param string $id
     * @param array{
     *     kind?: 'alta'|'reingreso'|'modificacion'|'baja',
     *     date?: string,
     *     integrated_daily_salary?: float|int|null,
     *     exit_reason?: '1'|'2'|'3'|'4'|'5'|'6'|'7'|'8'|'9'|'A'|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'imss_movement',
     *     issuer: string,
     *     employee: string,
     *     employee_number: string,
     *     employee_name: string,
     *     social_security_number: string,
     *     kind: 'alta'|'reingreso'|'modificacion'|'baja',
     *     movement_type: '08'|'07'|'02',
     *     date: string,
     *     integrated_daily_salary: float|int|null,
     *     exit_reason: string|null,
     *     source: 'automatic'|'manual',
     *     status: 'pending'|'reported',
     *     reported_at: string|null,
     *     problems: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-imss-movement
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/imss_movements/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un movimiento del IMSS
     *
     * Solo uno pendiente (por ejemplo, un alta registrada por error).
     *
     * DELETE /v1/imss_movements/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-imss-movement
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/imss_movements/' . rawurlencode($id), [], $options);
    }
}
