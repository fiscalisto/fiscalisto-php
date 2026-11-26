<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->materialityInvoices.
 */
final class MaterialityInvoices
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar facturas recibidas por probar
     *
     * Las facturas recibidas (ingresos) del emisor en un periodo que no tienen su evidencia
     * completa, de mayor a menor importe, cada una con lo que tiene, lo que le falta y de dónde
     * salió cada evidencia (orden de compra, recepción, complemento de pago, banco, archivos). Con
     * state, solo las de ese estado. Una página, hasta 300; has_more dice que hay más (acorte el
     * periodo o filtre por proveedor). No usa timbres.
     *
     * GET /v1/materiality_invoices
     *
     * @param array{
     *     issuer?: string,
     *     'date[gte]'?: string,
     *     'date[gt]'?: string,
     *     'date[lte]'?: string,
     *     'date[lt]'?: string,
     *     supplier_tax_id?: string,
     *     state?: 'complete'|'partial'|'none',
     *     date_gte?: string,
     *     date_lte?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'materiality_invoice', issuer: string, uuid: string, series: string|null, folio: string|null, date: string, supplier_tax_id: string, supplier_name: string|null, total: float|int, state: 'complete'|'partial'|'none', has: list<'agreement'|'delivery'|'payment'>, missing: list<'agreement'|'delivery'|'payment'>, evidence: list<array<string, mixed>>}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/list-materiality-invoices
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/materiality_invoices', ['query' => $params], $options);
    }
}
