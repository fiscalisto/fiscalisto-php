<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Descargas del SAT: $fiscalisto->satDownloads.
 */
final class SatDownloads
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Pedirle al SAT las facturas de un emisor
     *
     * La descarga masiva del SAT: las facturas que el emisor recibió (o emitió) en un periodo de
     * hasta un año, con su XML. Contesta 202 de inmediato; el SAT tarda de minutos a horas y al
     * terminar llega sat_download.completed (o sat_download.failed) y las facturas quedan en GET
     * /v1/sat_invoices. En producción necesita la e.firma guardada del emisor; en pruebas no se le
     * pregunta al SAT: la descarga trae facturas de ejemplo al instante. En producción usa 1
     * timbre por cada 100 CFDI que trae (al menos 1).
     *
     * POST /v1/sat_downloads
     *
     * @param array{
     *     issuer?: string,
     *     direction?: 'received'|'issued',
     *     from: string,
     *     to: string,
     *     type?: 'I'|'E'|'P'|'T'|'N',
     *     counterparty_tax_id?: string,
     *     uuid?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_download',
     *     issuer: string,
     *     direction: 'received'|'issued',
     *     from: string|null,
     *     to: string|null,
     *     type: 'I'|'E'|'P'|'T'|'N'|null,
     *     counterparty_tax_id: string|null,
     *     uuid: string|null,
     *     status: 'processing'|'completed'|'failed',
     *     new_invoices: int|null,
     *     error: string|null,
     *     created_at: string|null,
     *     completed_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/create-sat-download
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_downloads', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar descargas del SAT
     *
     * GET /v1/sat_downloads
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'sat_download', issuer: string, direction: 'received'|'issued', from: string|null, to: string|null, type: 'I'|'E'|'P'|'T'|'N'|null, counterparty_tax_id: string|null, uuid: string|null, status: 'processing'|'completed'|'failed', new_invoices: int|null, error: string|null, created_at: string|null, completed_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/list-sat-downloads
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/sat_downloads', $params, $options);
    }

    /**
     * Ver una descarga del SAT
     *
     * GET /v1/sat_downloads/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_download',
     *     issuer: string,
     *     direction: 'received'|'issued',
     *     from: string|null,
     *     to: string|null,
     *     type: 'I'|'E'|'P'|'T'|'N'|null,
     *     counterparty_tax_id: string|null,
     *     uuid: string|null,
     *     status: 'processing'|'completed'|'failed',
     *     new_invoices: int|null,
     *     error: string|null,
     *     created_at: string|null,
     *     completed_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/get-sat-download
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_downloads/' . rawurlencode($id), [], $options);
    }
}
