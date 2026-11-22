<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->climate.
 */
final class Climate
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Clima laboral
     *
     * Como «Nómina › Clima laboral» de la app: la política de prevención de riesgos psicosociales
     * y cuántos la leyeron (NOM-035-STPS-2018, numerales 5.1 y 5.7), cada centro de trabajo con la
     * guía que le toca por cuántos trabajan ahí (numeral 7.1) y cuándo le toca la siguiente
     * identificación (cada dos años como mínimo, numeral 7.9), cuántas acciones del Programa de
     * intervención faltan y cuántas quejas del buzón esperan atención.
     *
     * GET /v1/climate
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'climate',
     *     livemode: bool,
     *     issuer: string,
     *     settings: array{policy: string|null, policy_version: int, policy_published_at: string|null, complaints_contact: string|null, policy_reads: int, workers: int},
     *     centros: list<array{branch: string|null, name: string, workers: int, guide: string|null, last_on: string|null, next_due: string|null, overdue: bool}>,
     *     actions: array{total: int, pending: int, late: int},
     *     complaints: array{new: int, in_progress: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-climate
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/climate', ['query' => $params], $options);
    }

    /**
     * Guardar la política de prevención
     *
     * El texto de la política (numeral 5.1) y con quién más presentar una queja. Con publish true
     * la publica en el portal de cada trabajador como una versión nueva (numeral 5.7) y se les
     * pide leerla otra vez. Lo que no manda no cambia. Contesta climate.
     *
     * POST /v1/climate/policy
     *
     * @param array{
     *     issuer?: string,
     *     policy?: string|null,
     *     complaints_contact?: string|null,
     *     publish?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'climate',
     *     livemode: bool,
     *     issuer: string,
     *     settings: array{policy: string|null, policy_version: int, policy_published_at: string|null, complaints_contact: string|null, policy_reads: int, workers: int},
     *     centros: list<array{branch: string|null, name: string, workers: int, guide: string|null, last_on: string|null, next_due: string|null, overdue: bool}>,
     *     actions: array{total: int, pending: int, late: int},
     *     complaints: array{new: int, in_progress: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-climate-policy
     */
    public function updatePolicy(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/climate/policy', ['body' => $params, 'idempotent' => true], $options);
    }
}
