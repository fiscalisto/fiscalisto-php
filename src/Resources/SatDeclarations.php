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
     * Solo consulta: nunca presenta ni firma nada. En producción usa 1 timbre por consulta y se
     * puede hacer una vez cada 10 minutos por emisor. Contesta 202 en cuanto la acepta (status
     * processing) y consulta al SAT en segundo plano: sat_refresh.completed o sat_refresh.failed
     * dicen cómo terminó, y GET /v1/sat_refreshes/{id} también. Su timbre se aparta al aceptarla
     * (sin timbres contesta 402 de inmediato), se usa cuando el SAT contesta y regresa si no
     * contesta. Si al terminar queda algo por bajar (result.pending), sigue solo en la siguiente
     * hora sin otro timbre. En pruebas no se le pregunta al SAT: trae declaraciones de ejemplo al
     * instante (la consulta ya viene completed y también llega sat_refresh.completed).
     *
     * POST /v1/sat_declarations/refresh
     *
     * @param array{issuer?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_refresh',
     *     id: string,
     *     livemode: bool,
     *     issuer: string,
     *     document: 'declarations'|'compliance_opinion'|'tax_status_certificate'|'sat_mailbox',
     *     status: 'processing'|'completed'|'failed',
     *     result: array{found: int, downloaded: int, pending: int, warning: string|null, completes_at: string|null}|array{url: string}|null,
     *     error: string|null,
     *     charged: bool,
     *     timbre_held: bool,
     *     created_at: string,
     *     completed_at: string|null,
     *     refreshed_at: string,
     *     next_refresh_at: string,
     *     url: string,
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
     * @return Collection<array{id: string, livemode: bool, object: 'sat_declaration', issuer: string, source: 'monthly'|'annual'|'dyp', year: int, month: int|null, period: string, type: 'normal'|'complementary', complementary_type: string|null, operation_number: string, payment_line: string|null, filed_on: string|null, profit_coefficient: float|int|null, isr_due: float|int|null, vat_due: float|int|null, total_due: float|int|null, sections: list<array<string, mixed>>, receipt: array<string, mixed>|null, summary: array<string, mixed>, figures_status: 'read'|'pending'|'unavailable', figures_expected_at: string|null, payment: array<string, mixed>|null, files: array<string, mixed>, files_error: string|null, created_at: string|null, updated_at: string|null}>
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
     * Ver la precarga de la anual de una persona física
     *
     * Lo que el SAT precargará en la declaración anual de un emisor persona física, de sus
     * visores: los sueldos o asimilados y el ISR que le retuvieron, por patrón, y las deducciones
     * personales que toma de sus facturas, con las que podrían deducirse y no toma, y por qué. Se
     * lee con la e.firma en cada consulta (POST /v1/sat_declarations/refresh), del ejercicio
     * anterior y del actual; no usa timbres. Un emisor persona moral recibe parameter_invalid.
     *
     * GET /v1/sat_declarations/annual_preload
     *
     * @param array{issuer?: string, year?: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_annual_preload',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     payroll: array{updated_on: string|null, read_at: string, concepts: list<array<string, mixed>>, employers: list<array<string, mixed>>}|null,
     *     personal_deductions: array{updated_at: string|null, read_at: string, total_taken: float|int, total_possible: float|int, taken: list<array<string, mixed>>, possible: list<array<string, mixed>>, invoices: list<array<string, mixed>>}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/get-sat-annual-preload
     */
    public function annualPreload(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_declarations/annual_preload', ['query' => $params], $options);
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
     *     figures_status: 'read'|'pending'|'unavailable',
     *     figures_expected_at: string|null,
     *     payment: array{status: 'paid'|'unpaid'|'overdue'|'nothing_to_pay'|'unchecked', paid_on: string|null, amount_paid: float|int|null, bank: string|null, checked_at: string|null, payments: list<array<string, mixed>>}|null,
     *     files: array{pdf: bool, receipt: bool, payment_record: bool, financial_statements: bool},
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
     * Descargar el registro del pago de una declaración
     *
     * La «Información registrada de pagos de contribuciones federales» de una declaración mensual
     * pagada, como la da el SAT: el banco, el día, el importe, el número de operación del banco y
     * la llave de pago. Existe cuando payment.status es paid. No usa timbres.
     *
     * GET /v1/sat_declarations/{id}/payment_record
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/declaraciones-del-sat/get-sat-declaration-payment-record
     */
    public function paymentRecord(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_declarations/' . rawurlencode($id) . '/payment_record', ['as' => 'bytes'], $options);
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
