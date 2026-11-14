<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Exportaciones: $fiscalisto->exports.
 */
final class Exports
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Exportar las facturas de un mes
     *
     * Un ZIP con el XML (y si quiere el PDF) de cada factura que el emisor emitió o recibió en un
     * mes o un periodo, o un Excel con una fila por factura: los mismos archivos que Facturas ›
     * Exportar en la app, para su contador, un respaldo o una auditoría. Contesta 202 de inmediato
     * con status processing; consulte GET /v1/exports/{id} hasta completed y descárguelo con GET
     * /v1/exports/{id}/download durante 30 días. No usa timbres y sirve con una llave de solo
     * lectura.
     *
     * POST /v1/exports
     *
     * @param array{
     *     issuer?: string,
     *     month?: string,
     *     from?: string,
     *     to?: string,
     *     direction?: 'issued'|'received',
     *     type?: 'I'|'E'|'P'|'T'|'N',
     *     format?: 'zip'|'xlsx',
     *     files?: 'xml'|'pdf'|'xml_and_pdf',
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'export',
     *     livemode: bool,
     *     issuer: string,
     *     format: 'zip'|'xlsx',
     *     files: 'xml'|'pdf'|'xml_and_pdf'|null,
     *     direction: 'issued'|'received',
     *     from: string|null,
     *     to: string|null,
     *     type: 'I'|'E'|'P'|'T'|'N'|null,
     *     status: 'processing'|'completed'|'failed'|'expired',
     *     invoice_count: float|int,
     *     size_bytes: float|int|null,
     *     error: string|null,
     *     created_at: string|null,
     *     completed_at: string|null,
     *     expires_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/exportaciones/create-export
     */
    public function create(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/exports', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar exportaciones
     *
     * Las exportaciones del emisor pedidas por la API, las más recientes primero.
     *
     * GET /v1/exports
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'export', livemode: bool, issuer: string, format: 'zip'|'xlsx', files: 'xml'|'pdf'|'xml_and_pdf'|null, direction: 'issued'|'received', from: string|null, to: string|null, type: 'I'|'E'|'P'|'T'|'N'|null, status: 'processing'|'completed'|'failed'|'expired', invoice_count: float|int, size_bytes: float|int|null, error: string|null, created_at: string|null, completed_at: string|null, expires_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/exportaciones/list-exports
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/exports', $params, $options);
    }

    /**
     * Ver una exportación
     *
     * Su estado (processing, completed, failed o expired), cuántas facturas lleva, su tamaño y
     * hasta cuándo se descarga.
     *
     * GET /v1/exports/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'export',
     *     livemode: bool,
     *     issuer: string,
     *     format: 'zip'|'xlsx',
     *     files: 'xml'|'pdf'|'xml_and_pdf'|null,
     *     direction: 'issued'|'received',
     *     from: string|null,
     *     to: string|null,
     *     type: 'I'|'E'|'P'|'T'|'N'|null,
     *     status: 'processing'|'completed'|'failed'|'expired',
     *     invoice_count: float|int,
     *     size_bytes: float|int|null,
     *     error: string|null,
     *     created_at: string|null,
     *     completed_at: string|null,
     *     expires_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/exportaciones/get-export
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/exports/' . rawurlencode($id), [], $options);
    }

    /**
     * Descargar una exportación
     *
     * El ZIP o el Excel, cuando status es completed. Antes, 409 export_not_ready; pasados 30 días,
     * 410 export_expired.
     *
     * GET /v1/exports/{id}/download
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/exportaciones/download-export
     */
    public function download(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/exports/' . rawurlencode($id) . '/download', ['as' => 'text'], $options);
    }
}
