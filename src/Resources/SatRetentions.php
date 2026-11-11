<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Descargas del SAT: $fiscalisto->satRetentions.
 */
final class SatRetentions
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar constancias de retenciones
     *
     * Los CFDI de retenciones e información de pagos del emisor, como los muestra Facturas ›
     * Retenciones: los que recibió (descargados del SAT o subidos) o los que emitió, del más
     * reciente al más antiguo, con las canceladas marcadas. Las que emite por la API también están
     * en GET /v1/retentions.
     *
     * GET /v1/sat_retentions
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     direction?: 'received'|'issued',
     *     status?: 'active'|'canceled',
     *     counterparty_tax_id?: string,
     *     code?: string,
     *     year?: int,
     *     month?: int,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'sat_retention', issuer: string, uuid: string, direction: 'received'|'issued', date: string, internal_folio: string|null, code: string|null, description: string|null, issued_by: array<string, mixed>, issued_to: array<string, mixed>, period: array<string, mixed>|null, totals: array<string, mixed>, withheld_taxes: list<array<string, mixed>>, status: 'active'|'canceled', read_error: string|null, downloaded_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/list-sat-retentions
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/sat_retentions', $params, $options);
    }

    /**
     * Ver una constancia de retenciones
     *
     * Una constancia de retenciones del emisor, con sus montos, impuestos y estado.
     *
     * GET /v1/sat_retentions/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_retention',
     *     issuer: string,
     *     uuid: string,
     *     direction: 'received'|'issued',
     *     date: string,
     *     internal_folio: string|null,
     *     code: string|null,
     *     description: string|null,
     *     issued_by: array{tax_id: string|null, legal_name: string|null},
     *     issued_to: array{tax_id: string|null, legal_name: string|null},
     *     period: array{year: int, month_start: int, month_end: int}|null,
     *     totals: array{operation: float|int|null, taxed: float|int|null, exempt: float|int|null, withheld: float|int|null},
     *     withheld_taxes: list<array{base: float|int|null, tax: string|null, amount: float|int|null, payment_type: string|null}>,
     *     status: 'active'|'canceled',
     *     read_error: string|null,
     *     downloaded_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/get-sat-retention
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_retentions/' . rawurlencode($id), [], $options);
    }

    /**
     * Descargar el XML de una constancia de retenciones
     *
     * El CFDI de retenciones tal como llegó.
     *
     * GET /v1/sat_retentions/{id}/xml
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/get-sat-retention-xml
     */
    public function xml(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_retentions/' . rawurlencode($id) . '/xml', ['as' => 'text'], $options);
    }

    /**
     * Descargar el PDF de una constancia de retenciones
     *
     * La constancia en PDF, como la ofrece Facturas › Retenciones. El XML es el documento válido
     * ante el SAT.
     *
     * GET /v1/sat_retentions/{id}/pdf
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/descargas-del-sat/get-sat-retention-pdf
     */
    public function pdf(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_retentions/' . rawurlencode($id) . '/pdf', ['as' => 'bytes'], $options);
    }
}
