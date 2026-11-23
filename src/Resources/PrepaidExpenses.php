<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->prepaidExpenses.
 */
final class PrepaidExpenses
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver si una factura se amortiza
     *
     * Si una factura recibida (por su UUID) es un gasto pagado por anticipado y su calendario: una
     * póliza de amortización al final de cada mes que cubre.
     *
     * GET /v1/accounting/prepaid_expenses/{uuid}
     *
     * @param string $uuid
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     livemode: bool,
     *     object: 'prepaid_expense',
     *     issuer: string,
     *     uuid: string,
     *     active: bool,
     *     kind: 'insurance'|'rent'|'other'|null,
     *     account: string|null,
     *     expense_account: string|null,
     *     expense_account_name: string|null,
     *     start_month: string|null,
     *     months: int|null,
     *     start_date: string|null,
     *     end_date: string|null,
     *     amount: float|int|null,
     *     pending: float|int|null,
     *     schedule: list<array{month: int, date: string, amount: float|int, posted: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-prepaid-expense
     */
    public function get(string $uuid, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/prepaid_expenses/' . rawurlencode($uuid), ['query' => $params], $options);
    }

    /**
     * Amortizar una factura pagada por anticipado
     *
     * Su póliza va a pagos anticipados (109.01, 109.05 o 109.23) y los libros la pasan a su gasto
     * al final de cada mes que cubre (NIF C-5). Solo una factura de ingreso recibida que se
     * registra como gasto: un activo fijo, un movimiento o una por aclarar no se amortiza, ni una
     * cuya póliza se editó a mano. Un mes cerrado contesta period_closed. Impuestos no cambia.
     *
     * POST /v1/accounting/prepaid_expenses/{uuid}
     *
     * @param string $uuid
     * @param array{
     *     issuer?: string,
     *     kind?: 'insurance'|'rent'|'other',
     *     months?: int,
     *     start_month?: string,
     *     start_date?: string,
     *     end_date?: string,
     *     expense_account?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     livemode: bool,
     *     object: 'prepaid_expense',
     *     issuer: string,
     *     uuid: string,
     *     active: bool,
     *     kind: 'insurance'|'rent'|'other'|null,
     *     account: string|null,
     *     expense_account: string|null,
     *     expense_account_name: string|null,
     *     start_month: string|null,
     *     months: int|null,
     *     start_date: string|null,
     *     end_date: string|null,
     *     amount: float|int|null,
     *     pending: float|int|null,
     *     schedule: list<array{month: int, date: string, amount: float|int, posted: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/update-prepaid-expense
     */
    public function update(string $uuid, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/prepaid_expenses/' . rawurlencode($uuid), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Dejar de amortizar una factura
     *
     * Vuelve a registrarse como gasto del mes en la cuenta a la que se amortizaba, y sus pólizas
     * de amortización salen de los libros. Un mes cerrado contesta period_closed.
     *
     * DELETE /v1/accounting/prepaid_expenses/{uuid}
     *
     * @param string $uuid
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     livemode: bool,
     *     object: 'prepaid_expense',
     *     issuer: string,
     *     uuid: string,
     *     active: bool,
     *     kind: 'insurance'|'rent'|'other'|null,
     *     account: string|null,
     *     expense_account: string|null,
     *     expense_account_name: string|null,
     *     start_month: string|null,
     *     months: int|null,
     *     start_date: string|null,
     *     end_date: string|null,
     *     amount: float|int|null,
     *     pending: float|int|null,
     *     schedule: list<array{month: int, date: string, amount: float|int, posted: bool}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/remove-prepaid-expense
     */
    public function remove(string $uuid, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/prepaid_expenses/' . rawurlencode($uuid), ['query' => $params], $options);
    }
}
