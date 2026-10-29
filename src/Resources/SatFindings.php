<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->satFindings.
 */
final class SatFindings
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar hallazgos en los CFDI
     *
     * Lo que Fiscalisto encontró en los CFDI del emisor (los suyos y los descargados del SAT) y
     * nadie ha revisado, por tipo y del más grave al más leve: proveedores en la lista 69-B, CFDI
     * cancelados, pagos en efectivo de más de $2,000, errores de CFDI 4.0. Todos en una página. No
     * usa timbres.
     *
     * GET /v1/sat_findings
     *
     * @param array{
     *     issuer?: string,
     *     direction?: 'issued'|'received',
     *     date_gte?: string,
     *     date_lte?: string,
     *     severity?: 'critical'|'warning'|'info',
     *     counterparty?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'sat_finding', issuer: string, code: string, severity: 'critical'|'warning'|'info', title: string, explanation: string|null, invoices: int, counterparties: int, amount: float|int, last_date: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/list-sat-findings
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_findings', ['query' => $params], $options);
    }
}
