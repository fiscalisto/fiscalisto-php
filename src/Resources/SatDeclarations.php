<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Declaraciones del SAT: $fiscalisto->satDeclarations.
 */
final class SatDeclarations
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Consultar las declaraciones de un emisor en el SAT
     *
     * Entra al SAT con la e.firma guardada del emisor y trae las declaraciones que presentó:
     * provisionales o definitivas (desde 2022), la anual de persona moral (desde 2019) y las del
     * servicio anterior Declaraciones y pagos, con su PDF, su acuse y sus cifras. La primera
     * consulta trae todos los años que el SAT conserva; las siguientes, este año y el anterior.
     * Solo consulta: nunca presenta ni firma nada. En producción usa 1 timbre por consulta
     * (regresa si el SAT no contesta) y se puede hacer una vez cada 10 minutos por emisor.
     * Contesta en menos de un minuto; si queda algo por bajar (status processing), sigue solo en
     * la siguiente hora sin otro timbre. En pruebas no se le pregunta al SAT: trae declaraciones
     * de ejemplo al instante.
     *
     * POST /v1/sat_declarations/refresh
     *
     * @param array{issuer?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_declarations_refresh',
     *     livemode: bool,
     *     issuer: string,
     *     status: 'completed'|'processing',
     *     found: int,
     *     downloaded: int,
     *     pending: int,
     *     warning: string|null,
     *     refreshed_at: string,
     *     next_refresh_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/refresh-sat-declarations
     */
    public function refresh(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sat_declarations/refresh', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar declaraciones del SAT
     *
     * Las declaraciones que trajeron sus consultas, del ejercicio y mes más recientes a los más
     * antiguos (la anual antes de los meses de su año). No usa timbres.
     *
     * GET /v1/sat_declarations
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     year?: int,
     *     source?: 'monthly'|'annual'|'dyp',
     *     month?: int,
     *     type?: 'normal'|'complementary',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'sat_declaration', issuer: string, source: 'monthly'|'annual'|'dyp', year: int, month: int|null, period: string, type: 'normal'|'complementary', complementary_type: string|null, operation_number: string, payment_line: string|null, filed_on: string|null, profit_coefficient: float|int|null, isr_due: float|int|null, vat_due: float|int|null, total_due: float|int|null, sections: list<array<string, mixed>>, receipt: array<string, mixed>|null, summary: array<string, mixed>, files: array<string, mixed>, files_error: string|null, created_at: string|null, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/list-sat-declarations
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/sat_declarations', $params, $options);
    }

    /**
     * Ver el año mes por mes
     *
     * Cada mes del ejercicio con sus obligaciones: presentada (con sus declaraciones), falta
     * (venció y no la encontramos) o por presentar, con el día en que vence (el 17 del mes
     * siguiente, o el día hábil siguiente, más los días por el sexto dígito del RFC). Se arma con
     * lo que trajeron sus consultas; no usa timbres.
     *
     * GET /v1/sat_declarations/calendar
     *
     * @param array{issuer?: string, year?: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_declaration_calendar',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     missing: int,
     *     months: list<array{month: int|null, due_on: string, obligations: list<array<string, mixed>>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/get-sat-declaration-calendar
     */
    public function calendar(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_declarations/calendar', ['query' => $params], $options);
    }

    /**
     * Ver una declaración del SAT
     *
     * Una declaración presentada al SAT, con sus cifras en summary y si ya están su PDF y su
     * acuse.
     *
     * GET /v1/sat_declarations/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_declaration',
     *     issuer: string,
     *     source: 'monthly'|'annual'|'dyp',
     *     year: int,
     *     month: int|null,
     *     period: string,
     *     type: 'normal'|'complementary',
     *     complementary_type: string|null,
     *     operation_number: string,
     *     payment_line: string|null,
     *     filed_on: string|null,
     *     profit_coefficient: float|int|null,
     *     isr_due: float|int|null,
     *     vat_due: float|int|null,
     *     total_due: float|int|null,
     *     sections: list<array{tax: string, fields: list<array<string, mixed>>}>,
     *     receipt: array{concepts: list<array<string, mixed>>, total: float|int|null, payment_line: string|null, valid_until: string|null}|null,
     *     summary: array{obligations: list<array<string, mixed>>, total_to_pay: float|int|null},
     *     files: array{pdf: bool, receipt: bool, financial_statements: bool},
     *     files_error: string|null,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/get-sat-declaration
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_declarations/' . rawurlencode($id), [], $options);
    }

    /**
     * Descargar el PDF de una declaración
     *
     * La declaración como la da el SAT. No usa timbres.
     *
     * GET /v1/sat_declarations/{id}/pdf
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/get-sat-declaration-pdf
     */
    public function pdf(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_declarations/' . rawurlencode($id) . '/pdf', ['as' => 'bytes'], $options);
    }

    /**
     * Descargar el acuse de una declaración
     *
     * El acuse de recibo, con la línea de captura si hay algo a pagar. No usa timbres.
     *
     * GET /v1/sat_declarations/{id}/receipt
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/get-sat-declaration-receipt
     */
    public function receipt(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_declarations/' . rawurlencode($id) . '/receipt', ['as' => 'bytes'], $options);
    }

    /**
     * Descargar los estados financieros de una anual
     *
     * El Excel de estados financieros de la anual de persona moral, como lo da el SAT. No usa
     * timbres.
     *
     * GET /v1/sat_declarations/{id}/financial_statements
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/get-sat-declaration-financial-statements
     */
    public function financialStatements(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_declarations/' . rawurlencode($id) . '/financial_statements', ['as' => 'text'], $options);
    }
}
