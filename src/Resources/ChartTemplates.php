<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->chartTemplates.
 */
final class ChartTemplates
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar los catálogos por giro
     *
     * Los catálogos por giro (comercio, restaurante, construcción, servicios profesionales,
     * manufactura, transporte, arrendamiento, agropecuario) con las cuentas que agregaría cada uno
     * a su catálogo y cuáles ya tiene.
     *
     * GET /v1/accounting/chart_templates
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, object: 'chart_template', name: string, description: string, accounts: list<array<string, mixed>>}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-chart-templates
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/chart_templates', ['query' => $params], $options);
    }

    /**
     * Agregar las cuentas de un giro
     *
     * Agrega a su catálogo las cuentas del giro que faltan, cada una bajo su código agrupador. Un
     * código que ya tiene cuenta la conserva y nada se borra ni se renombra, así que se puede
     * llamar otra vez sin duplicar.
     *
     * POST /v1/accounting/chart_templates/{id}/apply
     *
     * @param string $id
     * @param array{issuer?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'chart_template_result',
     *     livemode: bool,
     *     chart_template: string,
     *     added: list<array{number: string, name: string, grouping_code: string}>,
     *     existing: list<array{number: string, name: string, grouping_code: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/apply-chart-template
     */
    public function apply(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/chart_templates/' . rawurlencode($id) . '/apply', ['body' => $params, 'idempotent' => true], $options);
    }
}
