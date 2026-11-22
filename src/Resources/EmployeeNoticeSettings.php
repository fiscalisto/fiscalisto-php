<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->employeeNoticeSettings.
 */
final class EmployeeNoticeSettings
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Avisos a empleados
     *
     * Qué avisos les llegan a los empleados del emisor en Mi nómina: recibo nuevo, recibo
     * cancelado, la respuesta a sus vacaciones y el recordatorio de firmar. Llegan al celular de
     * quien instaló Mi nómina y activó sus avisos; si no, a su correo (email_fallback).
     *
     * GET /v1/employee_notice_settings
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_notice_settings',
     *     livemode: bool,
     *     issuer: string,
     *     receipt: bool,
     *     receipt_canceled: bool,
     *     vacation: bool,
     *     sign_reminder_days: int,
     *     email_fallback: bool,
     *     quiet_hours: bool,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-employee-notice-settings
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/employee_notice_settings', ['query' => $params], $options);
    }

    /**
     * Cambiar los avisos a empleados
     *
     * Lo que no mande se queda como estaba. Cada empleado puede, además, apagar los suyos desde su
     * enlace.
     *
     * POST /v1/employee_notice_settings
     *
     * @param array{
     *     issuer?: string,
     *     receipt?: bool,
     *     receipt_canceled?: bool,
     *     vacation?: bool,
     *     sign_reminder_days?: int,
     *     email_fallback?: bool,
     *     quiet_hours?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'employee_notice_settings',
     *     livemode: bool,
     *     issuer: string,
     *     receipt: bool,
     *     receipt_canceled: bool,
     *     vacation: bool,
     *     sign_reminder_days: int,
     *     email_fallback: bool,
     *     quiet_hours: bool,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-employee-notice-settings
     */
    public function update(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/employee_notice_settings', ['body' => $params, 'idempotent' => true], $options);
    }
}
