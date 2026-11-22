<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Emisores: $fiscalisto->scheduleSettings.
 */
final class ScheduleSettings
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver los horarios
     *
     * Los horarios de la empresa, como Ajustes › Horarios en la app: cuántos días vale una
     * cotización nueva y a qué hora vence, y a qué hora corren las reglas «Cada mañana», la
     * revisión diaria de hallazgos y el resumen semanal de los lunes, todo en su zona horaria
     * (time_zone). Valen para toda la empresa: cualquiera de sus emisores lee los mismos.
     *
     * GET /v1/schedule_settings
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'schedule_settings',
     *     issuer: string,
     *     livemode: bool,
     *     time_zone: string,
     *     quote_valid_days: int,
     *     quote_expiry_hour: int|null,
     *     rules_hour: int,
     *     findings_hour: int,
     *     digest_hour: int,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/get-schedule-settings
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/schedule_settings', ['query' => $params], $options);
    }

    /**
     * Cambiar los horarios
     *
     * Cambia los horarios de la empresa (para todos sus emisores). Lo que no mande se queda como
     * está. Un cliente o su grupo pueden tener su propia vigencia de cotizaciones
     * (quote_valid_days), que gana a la de la empresa.
     *
     * POST /v1/schedule_settings
     *
     * @param array{
     *     issuer?: string,
     *     quote_valid_days?: int,
     *     quote_expiry_hour?: int|null,
     *     rules_hour?: int,
     *     findings_hour?: int,
     *     digest_hour?: int,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'schedule_settings',
     *     issuer: string,
     *     livemode: bool,
     *     time_zone: string,
     *     quote_valid_days: int,
     *     quote_expiry_hour: int|null,
     *     rules_hour: int,
     *     findings_hour: int,
     *     digest_hour: int,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/update-schedule-settings
     */
    public function update(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/schedule_settings', ['body' => $params, 'idempotent' => true], $options);
    }
}
