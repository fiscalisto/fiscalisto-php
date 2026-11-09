<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cuentas por cobrar: $fiscalisto->customers.
 */
final class Customers
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver cómo paga un cliente
     *
     * Cuántos días tarda en pagar, qué parte llega a tiempo con sus días de crédito, si paga más
     * lento que antes, cómo le paga y cuándo le llegaría lo que debe. De sus facturas a crédito
     * (PPD) de los últimos 12 meses y sus complementos de pago, como «Cómo paga» en la app. No
     * aplica a XAXX010101000 ni XEXX010101000.
     *
     * GET /v1/customers/{id}/payment_behavior
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'customer_payment_behavior',
     *     livemode: bool,
     *     issuer: string,
     *     customer: string,
     *     tax_id: string,
     *     credit_days: int,
     *     rating: 'on_time'|'sometimes_late'|'late'|'very_late'|'no_history',
     *     paid_invoices: int,
     *     average_days_to_pay: float|int|null,
     *     median_days_to_pay: int|null,
     *     p75_days_to_pay: int|null,
     *     on_time_share: float|int|null,
     *     average_days_late: float|int|null,
     *     trend: array{direction: 'slower'|'faster'|'steady', recent_days: float|int, earlier_days: float|int}|null,
     *     overdue_amount: float|int,
     *     overdue_invoices: int,
     *     payment_forms: list<array{payment_form: string, amount: float|int, share: float|int}>,
     *     months: list<array{month: string, average_days_to_pay: float|int|null, amount: float|int, paid_invoices: int}>,
     *     last_payment: array{date: string, amount: float|int}|null,
     *     cash_invoices: int,
     *     open_invoices: list<array{uuid: string, date: string, payment_method: 'PPD'|'PUE', amount_due: float|int, due_date: string, expected_payment_date: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cuentas-por-cobrar/get-customer-payment-behavior
     */
    public function paymentBehavior(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/customers/' . rawurlencode($id) . '/payment_behavior', [], $options);
    }

    /**
     * Crear un cliente
     *
     * Un cliente del catálogo del emisor, con sus datos fiscales como vienen en su constancia. Un
     * RFC que ya está en el catálogo contesta customer_exists.
     *
     * POST /v1/customers
     *
     * @param array{
     *     issuer?: string,
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     email?: string|null,
     *     use?: string,
     *     foreign?: array{country: string, tax_id: string}|null,
     *     group?: string|null,
     *     price_list?: string|null,
     *     discount_percent?: float|int|null,
     *     ieps_taxpayer?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer',
     *     issuer: string,
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     email: string|null,
     *     use: string|null,
     *     foreign: array{country: string, tax_id: string|null}|null,
     *     ieps_taxpayer: bool,
     *     group: string|null,
     *     price_list: string|null,
     *     discount_percent: float|int|null,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/create-customer
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/customers', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar clientes
     *
     * Los clientes del emisor, los más recientes primero. Con tax_id, el de ese RFC.
     *
     * GET /v1/customers
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string, tax_id?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'customer', issuer: string, tax_id: string, legal_name: string, tax_system: string, zip: string, email: string|null, use: string|null, foreign: array<string, mixed>|null, ieps_taxpayer: bool, group: string|null, price_list: string|null, discount_percent: float|int|null, created_at: string, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/list-customers
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/customers', $params, $options);
    }

    /**
     * Ver un cliente
     *
     * Un cliente del catálogo.
     *
     * GET /v1/customers/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer',
     *     issuer: string,
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     email: string|null,
     *     use: string|null,
     *     foreign: array{country: string, tax_id: string|null}|null,
     *     ieps_taxpayer: bool,
     *     group: string|null,
     *     price_list: string|null,
     *     discount_percent: float|int|null,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/get-customer
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/customers/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un cliente
     *
     * Cambia solo los campos que manda. Las facturas ya timbradas no cambian.
     *
     * POST /v1/customers/{id}
     *
     * @param string $id
     * @param array{
     *     tax_id?: string,
     *     legal_name?: string,
     *     tax_system?: string,
     *     zip?: string,
     *     email?: string|null,
     *     use?: string,
     *     foreign?: array{country: string, tax_id: string}|null,
     *     group?: string|null,
     *     price_list?: string|null,
     *     discount_percent?: float|int|null,
     *     ieps_taxpayer?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'customer',
     *     issuer: string,
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     email: string|null,
     *     use: string|null,
     *     foreign: array{country: string, tax_id: string|null}|null,
     *     ieps_taxpayer: bool,
     *     group: string|null,
     *     price_list: string|null,
     *     discount_percent: float|int|null,
     *     created_at: string,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/update-customer
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/customers/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un cliente
     *
     * Lo quita del catálogo. Sus facturas timbradas siguen igual.
     *
     * DELETE /v1/customers/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/delete-customer
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/customers/' . rawurlencode($id), [], $options);
    }
}
