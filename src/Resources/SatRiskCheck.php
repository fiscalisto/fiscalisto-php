<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->satRiskCheck.
 */
final class SatRiskCheck
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Revisar como el SAT
     *
     * Como «Revise como el SAT»: lo que los sistemas del SAT cruzan para mandar cartas invitación
     * y escoger a quién revisar (plazos de revisiones abiertas, Buzón Tributario, CFDI contra
     * declaraciones, declaraciones omitidas, opinión de cumplimiento, listas del SAT, proveedores
     * en 69-B, materialidad, depósitos sin aclarar, discrepancia fiscal y vigencia de la e.firma),
     * con lo que Fiscalisto ya leyó. No consulta al SAT y no usa timbres.
     *
     * GET /v1/sat_risk_check
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_risk_check',
     *     livemode: bool,
     *     issuer: string,
     *     tax_id: string,
     *     critical: int,
     *     warning: int,
     *     checks: list<array{key: string, result: 'ok'|'warning'|'critical'|'unknown', title: string, detail: string, why: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-sat-risk-check
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_risk_check', ['query' => $params], $options);
    }
}
