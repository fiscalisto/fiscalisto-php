<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->satFindingCounterparties.
 */
final class SatFindingCounterparties
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar proveedores y clientes con hallazgos
     *
     * Los proveedores (en recibidos) y clientes (en emitidos) con hallazgos sin revisar en los
     * CFDI del emisor, del más grave al más leve y después por cuántos CFDI, cada uno con sus
     * tipos de hallazgo. Con code, quién tiene ese hallazgo. No usa timbres.
     *
     * GET /v1/sat_finding_counterparties
     *
     * @param array{
     *     issuer?: string,
     *     limit?: int,
     *     starting_after?: string,
     *     direction?: 'issued'|'received',
     *     date_gte?: string,
     *     date_lte?: string,
     *     severity?: 'critical'|'warning'|'info',
     *     code?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'sat_finding_counterparty', issuer: string, rfc: string, name: string|null, severity: 'critical'|'warning'|'info', invoices: int, amount: float|int, last_date: string|null, findings: list<array<string, mixed>>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/list-sat-finding-counterparties
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/sat_finding_counterparties', $params, $options);
    }
}
