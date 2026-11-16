<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->materialitySuppliers.
 */
final class MaterialitySuppliers
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar la materialidad por proveedor
     *
     * Como Materialidad en la app: los proveedores de las facturas recibidas (ingresos) del emisor
     * en un periodo, con cuánto de lo que facturaron tiene evidencia completa de que la operación
     * existió (acuerdo, entrega y pago). Primero los que están en 69-B definitivo (corre su plazo
     * de 30 días hábiles), después los de más importe sin probar. Una página, hasta 500. Sin
     * fechas, este año hasta hoy. No usa timbres.
     *
     * GET /v1/materiality_suppliers
     *
     * @param array{
     *     issuer?: string,
     *     date_gte?: string,
     *     date_lte?: string,
     *     supplier_tax_id?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'materiality_supplier', issuer: string, tax_id: string, name: string|null, invoices: int, total: float|int, unproven: float|int, states: array<string, mixed>, missing: array<string, mixed>, sat_list: array<string, mixed>|null, in_supplier_portal: bool, evidence_requested_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/list-materiality-suppliers
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/materiality_suppliers', ['query' => $params], $options);
    }
}
