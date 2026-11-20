<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->consolidationEliminations.
 */
final class ConsolidationEliminations
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar las eliminaciones de consolidación de un mes
     *
     * Las eliminaciones capturadas para el mes: lo que el consolidado resta al cierre de ese mes
     * (ventas, saldos e inversiones entre los RFC).
     *
     * GET /v1/accounting/consolidation_eliminations
     *
     * @param array{month: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'consolidation_elimination', issuer: string, month: string, description: string, rfcs: list<string>, lines: list<array<string, mixed>>, updated_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-consolidation-eliminations
     */
    public function list(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/consolidation_eliminations', ['query' => $params], $options);
    }

    /**
     * Capturar una eliminación de consolidación
     *
     * Guarda una eliminación del mes entre los RFC que dice: renglones de cargo y abono que
     * cuadran, sobre cuentas de su catálogo. Cada mes lleva sus eliminaciones completas a esa
     * fecha (las ventas entre ellos del año hasta ese mes y los saldos entre ellos al cierre),
     * como una hoja de consolidación. Solo cambia el consolidado, nunca los libros de un RFC.
     *
     * POST /v1/accounting/consolidation_eliminations
     *
     * @param array{
     *     issuer?: string,
     *     month: string,
     *     description: string,
     *     rfcs: list<string>,
     *     lines: list<array{account: string, debit?: float|int, credit?: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'consolidation_elimination',
     *     issuer: string,
     *     month: string,
     *     description: string,
     *     rfcs: list<string>,
     *     lines: list<array{account: string, account_name: string, debit: float|int, credit: float|int}>,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-consolidation-elimination
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/consolidation_eliminations', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar una eliminación de consolidación
     *
     * La reemplaza con lo que manda.
     *
     * POST /v1/accounting/consolidation_eliminations/{id}
     *
     * @param string $id
     * @param array{
     *     month: string,
     *     description: string,
     *     rfcs: list<string>,
     *     lines: list<array{account: string, debit?: float|int, credit?: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'consolidation_elimination',
     *     issuer: string,
     *     month: string,
     *     description: string,
     *     rfcs: list<string>,
     *     lines: list<array{account: string, account_name: string, debit: float|int, credit: float|int}>,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/update-consolidation-elimination
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/consolidation_eliminations/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una eliminación de consolidación
     *
     * Solo cambia el consolidado: los libros de cada RFC siguen igual.
     *
     * DELETE /v1/accounting/consolidation_eliminations/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/delete-consolidation-elimination
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/consolidation_eliminations/' . rawurlencode($id), [], $options);
    }
}
