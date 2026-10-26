<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Entornos de prueba: $fiscalisto->testClocks.
 */
final class TestClocks
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un reloj de prueba
     *
     * Le da a un emisor de pruebas su propia hora, congelada en frozen_time (ahora, si no la
     * manda): sus facturas recurrentes, cotizaciones, cuentas por cobrar y tickets cuentan los
     * días con ella, y nada de eso corre solo hasta que usted lo adelanta. Para ver en segundos lo
     * que pasa en meses. Solo emisores de prueba; uno por emisor.
     *
     * POST /v1/issuers/{id}/test_clock
     *
     * @param string $id
     * @param array{frozen_time?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'test_clock',
     *     livemode: false,
     *     issuer: string,
     *     frozen_time: string,
     *     status: 'ready'|'advancing',
     *     created_at: string|null,
     *     advanced?: array{recurring_invoices: int, quotes_expired: int, global_invoices: int},
     *     stopped_early?: bool,
     *     requested_time?: string,
     *     deleted?: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/entornos-de-prueba/create-test-clock
     */
    public function create(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/test_clock', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver el reloj de prueba
     *
     * La hora que es «hoy» para un emisor de prueba y hasta dónde se ha adelantado. Solo emisores
     * de prueba.
     *
     * GET /v1/issuers/{id}/test_clock
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'test_clock',
     *     livemode: false,
     *     issuer: string,
     *     frozen_time: string,
     *     status: 'ready'|'advancing',
     *     created_at: string|null,
     *     advanced?: array{recurring_invoices: int, quotes_expired: int, global_invoices: int},
     *     stopped_early?: bool,
     *     requested_time?: string,
     *     deleted?: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/entornos-de-prueba/get-test-clock
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/issuers/' . rawurlencode($id) . '/test_clock', [], $options);
    }

    /**
     * Borrar el reloj de prueba
     *
     * El emisor vuelve a la hora real; lo que el reloj dejó pendiente lo hacen los procesos
     * diarios.
     *
     * DELETE /v1/issuers/{id}/test_clock
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'test_clock',
     *     livemode: false,
     *     issuer: string,
     *     frozen_time: string,
     *     status: 'ready'|'advancing',
     *     created_at: string|null,
     *     advanced?: array{recurring_invoices: int, quotes_expired: int, global_invoices: int},
     *     stopped_early?: bool,
     *     requested_time?: string,
     *     deleted?: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/entornos-de-prueba/delete-test-clock
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/issuers/' . rawurlencode($id) . '/test_clock', [], $options);
    }

    /**
     * Adelantar el reloj de prueba
     *
     * Mueve el reloj hasta frozen_time haciendo, día por día, lo que habría pasado: timbra las
     * facturas recurrentes de cada periodo, vence las cotizaciones y hace las facturas globales de
     * tickets, con sus eventos. Contesta cuando terminó, con lo que hizo en advanced, y llega
     * test_clock.ready. Hasta 25 comprobantes por solicitud: si se detiene antes, stopped_early y
     * otra llamada sigue. Los CFDI se timbran con la fecha real (el SAT solo acepta la de hoy); el
     * periodo, los vencimientos y los eventos siguen al reloj.
     *
     * POST /v1/issuers/{id}/test_clock/advance
     *
     * @param string $id
     * @param array{frozen_time: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'test_clock',
     *     livemode: false,
     *     issuer: string,
     *     frozen_time: string,
     *     status: 'ready'|'advancing',
     *     created_at: string|null,
     *     advanced?: array{recurring_invoices: int, quotes_expired: int, global_invoices: int},
     *     stopped_early?: bool,
     *     requested_time?: string,
     *     deleted?: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/entornos-de-prueba/advance-test-clock
     */
    public function advance(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/test_clock/advance', ['body' => $params, 'idempotent' => true], $options);
    }
}
