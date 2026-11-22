<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->repseReturns.
 */
final class RepseReturns
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Informes ICSOE y SISUB de un cuatrimestre
     *
     * Lo que se presenta del cuatrimestre (AAAA-1 enero a abril, AAAA-2 mayo a agosto, AAAA-3
     * septiembre a diciembre) a más tardar el día 17 del mes siguiente, o el siguiente día hábil:
     * por contrato, sus trabajadores con NSS, CURP y último salario base de cotización (ICSOE, LSS
     * art. 15-A), y por trabajador y bimestre las percepciones, el salario topado a 25 UMA, la
     * aportación del 5% y la amortización de su crédito (SISUB, Ley del Infonavit art. 29 Bis),
     * calculados de los recibos timbrados. files trae los archivos para subir: los tres del SISUB
     * y uno del ICSOE por contrato. problems dice lo que falta para presentarlos.
     *
     * GET /v1/repse_returns/{period}
     *
     * @param string $period
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'repse_return',
     *     livemode: bool,
     *     issuer: string,
     *     period: string,
     *     start_date: string,
     *     end_date: string,
     *     due_date: string,
     *     contracts: list<array{contract: string, number: string, workers: list<array<string, mixed>>}>,
     *     workers: list<array{employee: string, name: string, nss: string, bimester: int, contracts: list<string>, variable_perceptions: float|int, fixed_perceptions: float|int, disability_days: int, non_integrable_perceptions: float|int, capped_salary: float|int, infonavit_contribution: float|int, has_credit: bool, amortization: float|int}>,
     *     totals: array{contributions_without_credit: float|int, contributions_with_credit: float|int, amortizations: float|int},
     *     problems: list<string>,
     *     files: list<array{name: string, system: 'sisub'|'icsoe', content: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-repse-return
     */
    public function get(string $period, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/repse_returns/' . rawurlencode($period), ['query' => $params], $options);
    }
}
