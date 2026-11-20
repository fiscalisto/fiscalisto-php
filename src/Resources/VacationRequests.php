<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->vacationRequests.
 */
final class VacationRequests
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar solicitudes de vacaciones
     *
     * Los días que los empleados pidieron desde su enlace, las más recientes primero.
     *
     * GET /v1/vacation_requests
     *
     * @param array{
     *     employee?: string,
     *     status?: 'pending'|'approved'|'rejected'|'canceled',
     *     limit?: int,
     *     issuer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, object: 'vacation_request', livemode: bool, employee: string, employee_name: string|null, from: string, to: string, days: float|int, note: string|null, status: 'pending'|'approved'|'rejected'|'canceled', decided_at: string|null, decision_note: string|null, created_at: string}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-vacation-requests
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/vacation_requests', ['query' => $params], $options);
    }

    /**
     * Ver una solicitud de vacaciones
     *
     * Una solicitud de vacaciones con su estado.
     *
     * GET /v1/vacation_requests/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'vacation_request',
     *     livemode: bool,
     *     employee: string,
     *     employee_name: string|null,
     *     from: string,
     *     to: string,
     *     days: float|int,
     *     note: string|null,
     *     status: 'pending'|'approved'|'rejected'|'canceled',
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-vacation-request
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/vacation_requests/' . rawurlencode($id), [], $options);
    }

    /**
     * Aprobar una solicitud de vacaciones
     *
     * La aprueba con los días calculados o los que mande en days. Los días aprobados se sugieren
     * en las Incidencias del recibo del periodo; no se agregan solos.
     *
     * POST /v1/vacation_requests/{id}/approve
     *
     * @param string $id
     * @param array{days?: float|int, note?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'vacation_request',
     *     livemode: bool,
     *     employee: string,
     *     employee_name: string|null,
     *     from: string,
     *     to: string,
     *     days: float|int,
     *     note: string|null,
     *     status: 'pending'|'approved'|'rejected'|'canceled',
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/approve-vacation-request
     */
    public function approve(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/vacation_requests/' . rawurlencode($id) . '/approve', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Rechazar una solicitud de vacaciones
     *
     * La rechaza; note (por qué) es obligatoria y el empleado la ve.
     *
     * POST /v1/vacation_requests/{id}/reject
     *
     * @param string $id
     * @param array{note: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'vacation_request',
     *     livemode: bool,
     *     employee: string,
     *     employee_name: string|null,
     *     from: string,
     *     to: string,
     *     days: float|int,
     *     note: string|null,
     *     status: 'pending'|'approved'|'rejected'|'canceled',
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     created_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/reject-vacation-request
     */
    public function reject(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/vacation_requests/' . rawurlencode($id) . '/reject', ['body' => $params, 'idempotent' => true], $options);
    }
}
