<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Flujo de efectivo: $fiscalisto->cashForecast.
 */
final class CashForecast
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver el flujo de efectivo
     *
     * Las próximas 13 semanas del emisor, como «Flujo de efectivo» en la app: lo que le deben, con
     * lo que cada cliente suele tardar en pagar; lo que debe a proveedores; la nómina; las
     * declaraciones mensuales; las facturas recurrentes y sus movimientos previstos, desde el
     * saldo que dio. Trae avisos con lo que puede hacer, y con los parámetros, un escenario (no se
     * guarda). Una estimación: nada cambia solo.
     *
     * GET /v1/cash_forecast
     *
     * @param array{
     *     issuer?: string,
     *     customers_pay_days_later?: int,
     *     pay_suppliers_days_later?: int,
     *     include_doubtful?: bool,
     *     include_recurring?: bool,
     *     recurring_sales_change?: int,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cash_forecast',
     *     livemode: bool,
     *     issuer: string,
     *     today: string,
     *     end: string,
     *     currency: 'MXN',
     *     starting_balance: array{amount: float|int, date: string}|null,
     *     minimum_balance: float|int,
     *     suggested_starting_balance: array{amount: float|int, date: string}|null,
     *     scenario: array{customers_pay_days_later: int, pay_suppliers_days_later: int, include_doubtful: bool, include_recurring: bool, recurring_sales_change: int},
     *     totals: array{inflows: float|int, outflows: float|int, ending_balance: float|int, lowest_balance: float|int, lowest_week: int, weeks_below_minimum: int, doubtful_left_out: float|int},
     *     weeks: list<array{week: int, start: string, end: string, starting_balance: float|int, inflows: float|int, outflows: float|int, ending_balance: float|int, by_type: array<string, mixed>}>,
     *     lines: list<array{line: string, type: 'receivable'|'recurring_invoice'|'planned_inflow'|'payable'|'payroll'|'taxes'|'planned_outflow', direction: 'inflow'|'outflow', date: string, estimated_date: string, week: int|null, amount: float|int, estimated_amount: float|int, description: string, tax_id: string|null, invoices: int|null, due_date: string|null, days_overdue: int|null, basis: string, confidence: 'high'|'medium'|'low', left_out: 'excluded'|'doubtful'|'scenario'|'after_horizon'|null, adjusted: bool, planned_item: string|null}>,
     *     warnings: list<array{type: 'no_starting_balance'|'stale_starting_balance'|'shortfall'|'overdue_receivables'|'customer_concentration'|'doubtful_left_out', severity: 'critical'|'warning'|'info', title: string, detail: string, week: int|null, shortfall: float|int|null}>,
     *     planned_items: list<array{id: string, object: 'cash_forecast_item', livemode: bool, issuer: string, description: string, direction: 'inflow'|'outflow', amount: float|int, date: string, frequency: 'once'|'weekly'|'biweekly'|'monthly', until: string|null}>,
     *     notes: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/flujo-de-efectivo/get-cash-forecast
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/cash_forecast', ['query' => $params], $options);
    }

    /**
     * Dar el saldo de hoy
     *
     * El saldo de hoy en sus cuentas de banco (de donde parte el flujo) y lo menos que quiere
     * tener. Solo lo que mande cambia. Responde el flujo con el saldo nuevo.
     *
     * POST /v1/cash_forecast
     *
     * @param array{
     *     issuer?: string,
     *     starting_balance?: array{amount: float|int, date?: string}|null,
     *     minimum_balance?: float|int,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cash_forecast',
     *     livemode: bool,
     *     issuer: string,
     *     today: string,
     *     end: string,
     *     currency: 'MXN',
     *     starting_balance: array{amount: float|int, date: string}|null,
     *     minimum_balance: float|int,
     *     suggested_starting_balance: array{amount: float|int, date: string}|null,
     *     scenario: array{customers_pay_days_later: int, pay_suppliers_days_later: int, include_doubtful: bool, include_recurring: bool, recurring_sales_change: int},
     *     totals: array{inflows: float|int, outflows: float|int, ending_balance: float|int, lowest_balance: float|int, lowest_week: int, weeks_below_minimum: int, doubtful_left_out: float|int},
     *     weeks: list<array{week: int, start: string, end: string, starting_balance: float|int, inflows: float|int, outflows: float|int, ending_balance: float|int, by_type: array<string, mixed>}>,
     *     lines: list<array{line: string, type: 'receivable'|'recurring_invoice'|'planned_inflow'|'payable'|'payroll'|'taxes'|'planned_outflow', direction: 'inflow'|'outflow', date: string, estimated_date: string, week: int|null, amount: float|int, estimated_amount: float|int, description: string, tax_id: string|null, invoices: int|null, due_date: string|null, days_overdue: int|null, basis: string, confidence: 'high'|'medium'|'low', left_out: 'excluded'|'doubtful'|'scenario'|'after_horizon'|null, adjusted: bool, planned_item: string|null}>,
     *     warnings: list<array{type: 'no_starting_balance'|'stale_starting_balance'|'shortfall'|'overdue_receivables'|'customer_concentration'|'doubtful_left_out', severity: 'critical'|'warning'|'info', title: string, detail: string, week: int|null, shortfall: float|int|null}>,
     *     planned_items: list<array{id: string, object: 'cash_forecast_item', livemode: bool, issuer: string, description: string, direction: 'inflow'|'outflow', amount: float|int, date: string, frequency: 'once'|'weekly'|'biweekly'|'monthly', until: string|null}>,
     *     notes: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/flujo-de-efectivo/update-cash-forecast
     */
    public function update(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/cash_forecast', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Agregar un movimiento previsto
     *
     * Algo que espera pagar o cobrar y que ninguna factura dice: una renta, un crédito, una venta
     * de contado. Una vez o cada semana, dos semanas o mes. Hasta 200.
     *
     * POST /v1/cash_forecast/planned_items
     *
     * @param array{
     *     issuer?: string,
     *     description: string,
     *     direction: 'inflow'|'outflow',
     *     amount: float|int,
     *     date: string,
     *     frequency?: 'once'|'weekly'|'biweekly'|'monthly',
     *     until?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'cash_forecast_item',
     *     livemode: bool,
     *     issuer: string,
     *     description: string,
     *     direction: 'inflow'|'outflow',
     *     amount: float|int,
     *     date: string,
     *     frequency: 'once'|'weekly'|'biweekly'|'monthly',
     *     until: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/flujo-de-efectivo/create-cash-forecast-item
     */
    public function createItem(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/cash_forecast/planned_items', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar un movimiento previsto
     *
     * Solo lo que mande cambia.
     *
     * POST /v1/cash_forecast/planned_items/{id}
     *
     * @param string $id
     * @param array{
     *     description?: string,
     *     direction?: 'inflow'|'outflow',
     *     amount?: float|int,
     *     date?: string,
     *     frequency?: 'once'|'weekly'|'biweekly'|'monthly',
     *     until?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'cash_forecast_item',
     *     livemode: bool,
     *     issuer: string,
     *     description: string,
     *     direction: 'inflow'|'outflow',
     *     amount: float|int,
     *     date: string,
     *     frequency: 'once'|'weekly'|'biweekly'|'monthly',
     *     until: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/flujo-de-efectivo/update-cash-forecast-item
     */
    public function updateItem(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/cash_forecast/planned_items/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un movimiento previsto
     *
     * Ya no cuenta en el flujo.
     *
     * DELETE /v1/cash_forecast/planned_items/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/flujo-de-efectivo/delete-cash-forecast-item
     */
    public function deleteItem(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/cash_forecast/planned_items/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar un renglón del flujo
     *
     * Otro día o monto para un renglón (lines[].line), o no contarlo: un cliente le avisó que paga
     * después, o una factura ya se pagó por fuera. Solo cambia el pronóstico, nunca la factura.
     * reset: true lo regresa a lo estimado. Responde el flujo con el cambio.
     *
     * POST /v1/cash_forecast/adjustments
     *
     * @param array{
     *     issuer?: string,
     *     line: string,
     *     date?: string|null,
     *     amount?: float|int|null,
     *     excluded?: bool,
     *     note?: string|null,
     *     reset?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cash_forecast',
     *     livemode: bool,
     *     issuer: string,
     *     today: string,
     *     end: string,
     *     currency: 'MXN',
     *     starting_balance: array{amount: float|int, date: string}|null,
     *     minimum_balance: float|int,
     *     suggested_starting_balance: array{amount: float|int, date: string}|null,
     *     scenario: array{customers_pay_days_later: int, pay_suppliers_days_later: int, include_doubtful: bool, include_recurring: bool, recurring_sales_change: int},
     *     totals: array{inflows: float|int, outflows: float|int, ending_balance: float|int, lowest_balance: float|int, lowest_week: int, weeks_below_minimum: int, doubtful_left_out: float|int},
     *     weeks: list<array{week: int, start: string, end: string, starting_balance: float|int, inflows: float|int, outflows: float|int, ending_balance: float|int, by_type: array<string, mixed>}>,
     *     lines: list<array{line: string, type: 'receivable'|'recurring_invoice'|'planned_inflow'|'payable'|'payroll'|'taxes'|'planned_outflow', direction: 'inflow'|'outflow', date: string, estimated_date: string, week: int|null, amount: float|int, estimated_amount: float|int, description: string, tax_id: string|null, invoices: int|null, due_date: string|null, days_overdue: int|null, basis: string, confidence: 'high'|'medium'|'low', left_out: 'excluded'|'doubtful'|'scenario'|'after_horizon'|null, adjusted: bool, planned_item: string|null}>,
     *     warnings: list<array{type: 'no_starting_balance'|'stale_starting_balance'|'shortfall'|'overdue_receivables'|'customer_concentration'|'doubtful_left_out', severity: 'critical'|'warning'|'info', title: string, detail: string, week: int|null, shortfall: float|int|null}>,
     *     planned_items: list<array{id: string, object: 'cash_forecast_item', livemode: bool, issuer: string, description: string, direction: 'inflow'|'outflow', amount: float|int, date: string, frequency: 'once'|'weekly'|'biweekly'|'monthly', until: string|null}>,
     *     notes: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/flujo-de-efectivo/adjust-cash-forecast
     */
    public function adjust(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/cash_forecast/adjustments', ['body' => $params, 'idempotent' => true], $options);
    }
}
