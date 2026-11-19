<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->closedPeriod.
 */
final class ClosedPeriod
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver hasta qué mes está cerrada la contabilidad
     *
     * El último mes cerrado del emisor (closed_through), como Cierre del mes › Cerrar la
     * contabilidad en la app.
     *
     * GET /v1/accounting/closed_period
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'closed_period',
     *     livemode: bool,
     *     issuer: string,
     *     closed_through: string|null,
     *     closed_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-closed-period
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/closed_period', ['query' => $params], $options);
    }

    /**
     * Cerrar o reabrir meses de la contabilidad
     *
     * Cierra la contabilidad hasta closed_through (y los meses anteriores), o la reabre con un mes
     * anterior o null. En un mes cerrado, crear, corregir o borrar una póliza a mano, registrar o
     * quitar la póliza de un movimiento de banco y dar de baja un activo contestan period_closed.
     * Las facturas siguen llegando del SAT.
     *
     * POST /v1/accounting/closed_period
     *
     * @param array{issuer?: string, closed_through: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'closed_period',
     *     livemode: bool,
     *     issuer: string,
     *     closed_through: string|null,
     *     closed_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/set-closed-period
     */
    public function set(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/closed_period', ['body' => $params, 'idempotent' => true], $options);
    }
}
