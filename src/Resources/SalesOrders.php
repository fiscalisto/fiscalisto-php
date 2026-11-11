<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Pedidos: $fiscalisto->salesOrders.
 */
final class SalesOrders
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un pedido
     *
     * Lo que su cliente le pidió, con los conceptos y las condiciones de pago de una factura (se
     * revisan con las mismas reglas, así que cada factura que sale de él timbra). customer es un
     * cliente de su catálogo o uno con sus datos fiscales (se agrega a sus clientes). Con quote
     * (quo_…) lo hace de una cotización. Queda en draft, o confirmado con confirm: true (llega
     * sales_order.confirmed y se aparta lo pedido en el almacén).
     *
     * POST /v1/sales_orders
     *
     * @param array{
     *     issuer?: string,
     *     quote?: string,
     *     customer?: string|array{tax_id: string, legal_name: string, tax_system: string, zip: string, email?: string|null, foreign?: array{country: string, tax_id: string}, ieps_taxpayer?: bool},
     *     items?: list<array{product?: string, description?: string, product_key?: string, unit_key?: string, unit_name?: string|null, sku?: string|null, quantity?: float|int, unit_price?: float|int, discount?: float|int, taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08', iva?: '0'|'0.16'|'0.08'|'exento', ieps?: float|int, ieps_factor?: 'Tasa'|'Cuota', ieps_units?: float|int, iva_retention?: float|int, isr_retention?: float|int, predial?: list<string>, pedimentos?: list<string>, third_party?: array{tax_id: string, name: string, tax_system: string, zip: string}, iedu?: array{student_name: string, curp: string, level: 'Preescolar'|'Primaria'|'Secundaria'|'Profesional técnico'|'Bachillerato o su equivalente', rvoe: string, payer_tax_id?: string|null}, used_vehicle?: array{purchase_amount: float|int, sale_amount: float|int, vehicle_key: string, make: string, type: string, model: string, engine_number?: string, serial_number?: string, niv?: string, guide_value: float|int, customs?: list<array<string, mixed>>}, addenda?: array<string, mixed>}>,
     *     confirm?: bool,
     *     currency?: string,
     *     exchange_rate?: float|int,
     *     payment_form?: string,
     *     payment_method?: 'PUE'|'PPD',
     *     use?: string,
     *     notes?: string,
     *     customer_po?: string,
     *     email?: string,
     *     expected_on?: string,
     *     payment_days?: int,
     *     invoice_policy?: 'delivered'|'ordered',
     *     ship_to?: string,
     *     terms?: string,
     *     internal_note?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/create-sales-order
     */
    public function create(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar pedidos
     *
     * Los más recientes primero.
     *
     * GET /v1/sales_orders
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     customer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'sales_order', issuer: string, number: string, status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled', stage: string|null, url: string|null, customer: array<string, mixed>, customer_po: string|null, quote: string|null, currency: string, items: list<array<string, mixed>>, subtotal: float|int, total: float|int, invoiced_total: float|int, paid_total: float|int, expected_on: string|null, payment_days: int, invoice_policy: 'delivered'|'ordered', ship_to: string|null, terms: string|null, notes: string|null, internal_note: string|null, deliveries: list<array<string, mixed>>, invoices: list<array<string, mixed>>, customer_confirmed_at: string|null, sent_at: string|null, viewed_at: string|null, confirmed_at: string|null, delivered_at: string|null, invoiced_at: string|null, paid_at: string|null, closed_at: string|null, canceled_at: string|null, cancel_reason: string|null, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/list-sales-orders
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/sales_orders', $params, $options);
    }

    /**
     * Ver un pedido
     *
     * Con sus entregas, sus facturas y lo que se ha pagado de ellas.
     *
     * GET /v1/sales_orders/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/get-sales-order
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sales_orders/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar un pedido
     *
     * Solo lo que mande cambia. Los conceptos cambian mientras no tengan entregas ni facturas; si
     * no, 400 sales_order_invalid.
     *
     * POST /v1/sales_orders/{id}
     *
     * @param string $id
     * @param array{
     *     customer?: string|array{tax_id: string, legal_name: string, tax_system: string, zip: string, email?: string|null, foreign?: array{country: string, tax_id: string}, ieps_taxpayer?: bool},
     *     items?: list<array{product?: string, description?: string, product_key?: string, unit_key?: string, unit_name?: string|null, sku?: string|null, quantity?: float|int, unit_price?: float|int, discount?: float|int, taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08', iva?: '0'|'0.16'|'0.08'|'exento', ieps?: float|int, ieps_factor?: 'Tasa'|'Cuota', ieps_units?: float|int, iva_retention?: float|int, isr_retention?: float|int, predial?: list<string>, pedimentos?: list<string>, third_party?: array{tax_id: string, name: string, tax_system: string, zip: string}, iedu?: array{student_name: string, curp: string, level: 'Preescolar'|'Primaria'|'Secundaria'|'Profesional técnico'|'Bachillerato o su equivalente', rvoe: string, payer_tax_id?: string|null}, used_vehicle?: array{purchase_amount: float|int, sale_amount: float|int, vehicle_key: string, make: string, type: string, model: string, engine_number?: string, serial_number?: string, niv?: string, guide_value: float|int, customs?: list<array<string, mixed>>}, addenda?: array<string, mixed>}>,
     *     currency?: string,
     *     exchange_rate?: float|int,
     *     payment_form?: string,
     *     payment_method?: 'PUE'|'PPD',
     *     use?: string,
     *     notes?: string,
     *     customer_po?: string,
     *     email?: string,
     *     expected_on?: string,
     *     payment_days?: int,
     *     invoice_policy?: 'delivered'|'ordered',
     *     ship_to?: string,
     *     terms?: string,
     *     internal_note?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/update-sales-order
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar un pedido
     *
     * Solo un borrador. Uno confirmado se cancela con POST /v1/sales_orders/{id}/cancel: 400
     * sales_order_not_deletable.
     *
     * DELETE /v1/sales_orders/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/delete-sales-order
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/sales_orders/' . rawurlencode($id), [], $options);
    }

    /**
     * Confirmar un pedido
     *
     * Es un pedido en firme: se aparta lo pedido en el almacén y ya se puede entregar y facturar.
     * Llega sales_order.confirmed.
     *
     * POST /v1/sales_orders/{id}/confirm
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/confirm-sales-order
     */
    public function confirm(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/confirm', ['idempotent' => true], $options);
    }

    /**
     * Registrar una entrega
     *
     * Lo que salió, con su remisión (REM-1, REM-2…): la mercancía sale del almacén con la entrega,
     * no con la factura. Por omisión, todo lo que falta. Si el emisor no vende sin existencias, no
     * sale más de lo que hay (400 sales_order_invalid). Cuando ya salió todo llega
     * sales_order.delivered.
     *
     * POST /v1/sales_orders/{id}/deliveries
     *
     * @param string $id
     * @param array{
     *     items?: list<array{line: int, quantity: float|int}>,
     *     delivered_on?: string,
     *     carrier?: string,
     *     tracking?: string,
     *     note?: string,
     *     received_by?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/create-sales-order-delivery
     */
    public function deliver(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/deliveries', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cancelar una entrega
     *
     * La mercancía regresa al almacén y lo entregado vuelve a quedar pendiente.
     *
     * POST /v1/sales_orders/{id}/deliveries/{delivery}/cancel
     *
     * @param string $id
     * @param string $delivery
     * @param array{reason?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/cancel-sales-order-delivery
     */
    public function cancelDelivery(string $id, string $delivery, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/deliveries/' . rawurlencode($delivery) . '/cancel', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Facturar un pedido
     *
     * Timbra una factura con lo entregado y no facturado (o lo que diga items; con invoice_policy
     * ordered, lo pedido), con los datos fiscales del cliente de hoy y la nota «Pedido PED-…» con
     * su orden de compra. Se factura en varias partes: cada llamada, con su Idempotency-Key,
     * timbra la que sigue. Si no queda nada, 400 sales_order_invalid. Cuando sus facturas se pagan
     * llega sales_order.paid.
     *
     * POST /v1/sales_orders/{id}/invoice
     *
     * @param string $id
     * @param array{
     *     items?: list<array{line: int, quantity: float|int}>,
     *     include_undelivered?: bool,
     *     deliver?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'invoice',
     *     issuer: string,
     *     branch: string|null,
     *     cost_center: string|null,
     *     type: 'I'|'E'|'P'|'T'|'N',
     *     status: 'processing'|'pending'|'valid'|'rejected'|'canceled',
     *     uuid: string|null,
     *     series: string|null,
     *     folio: string|null,
     *     date: string|null,
     *     customer: array{tax_id: string|null, legal_name: string|null, tax_system?: string, zip?: string, foreign?: array<string, mixed>},
     *     use: string|null,
     *     payment_form: string|null,
     *     payment_method: string|null,
     *     currency: string,
     *     exchange_rate: float|int|null,
     *     items: list<array<string, mixed>>,
     *     subtotal: float|int|null,
     *     discount: float|int|null,
     *     taxes: array{iva: float|int|null, ieps: float|null, iva_withheld: float|null, isr_withheld: float|null, local_transferred: float|null, local_withheld: float|null}|null,
     *     total: float|int|null,
     *     payment_status: 'paid'|'partial'|'unpaid'|null,
     *     amount_due: float|int|null,
     *     amount_paid: float|int|null,
     *     paid_on: string|null,
     *     related: array<string, mixed>|null,
     *     payment?: array{date: string|null, payment_form: string|null, currency: string, exchange_rate: float|int|null, amount: float|int, operation_number: string|null, documents: list<array<string, mixed>>}|null,
     *     payroll?: array{type: 'O'|'E', calculation: 'fiscalisto'|'external', periodicity: string, period: array<string, mixed>, days: float|int, references: array<string, mixed>|null, employer: array<string, mixed>, employee: array<string, mixed>, perceptions: list<array<string, mixed>>, deductions: list<array<string, mixed>>, other_payments: list<array<string, mixed>>, separation?: array<string, mixed>, retirement?: array<string, mixed>, disabilities?: list<array<string, mixed>>, totals: array<string, mixed>},
     *     global?: array<string, mixed>,
     *     cancellation: array{status: string|null, motive: string|null, substitution: string|null, canceled_at: string|null}|null,
     *     email: array{to: string|null, cc: string|null, sent_at: string|null, status: 'sent'|'delayed'|'delivered'|'opened'|'bounced'|'complained', recipients: list<array<string, mixed>>}|null,
     *     error: array{message: string, sat_code: string|null, raw: string}|null,
     *     recurring_invoice: string|null,
     *     created_at: string|null,
     *     metadata: array<string, mixed>,
     *     warnings?: list<string>,
     *     email_error?: string,
     *     substitutes?: array{invoice: string, canceled: bool, cancel_error?: string},
     *     advance_application?: array{advance: string|null, advance_uuid: string, method: 'egreso'|'remanente', status: 'done'|'credit_note_pending', credit_note: string|null, credit_note_error?: string},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/invoice-sales-order
     */
    public function invoice(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/invoice', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Mandar un pedido
     *
     * Por correo, con su PDF y la liga donde su cliente lo confirma (llega
     * sales_order.customer_confirmed), firma cada entrega y abre sus facturas. Con send_email:
     * false solo contesta url. En borrador, 400 sales_order_draft.
     *
     * POST /v1/sales_orders/{id}/send
     *
     * @param string $id
     * @param array{send_email?: bool, to?: string, message?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/send-sales-order
     */
    public function send(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/send', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ya no entregar lo pendiente
     *
     * El pedido se queda con lo ya entregado (lo demás pasa a canceled en cada concepto) y se
     * libera lo apartado.
     *
     * POST /v1/sales_orders/{id}/cancel_remaining
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/cancel-sales-order-remaining
     */
    public function cancelRemaining(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/cancel_remaining', ['idempotent' => true], $options);
    }

    /**
     * Cerrar un pedido
     *
     * Lo da por terminado aunque quede algo pendiente, y libera lo apartado.
     *
     * POST /v1/sales_orders/{id}/close
     *
     * @param string $id
     * @param array{reason?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/close-sales-order
     */
    public function close(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/close', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cancelar un pedido
     *
     * Solo sin entregas ni facturas timbradas (cancele primero las entregas, y las facturas con
     * POST /v1/invoices/{id}/cancel). Borra sus facturas en borrador y libera lo apartado. Llega
     * sales_order.canceled.
     *
     * POST /v1/sales_orders/{id}/cancel
     *
     * @param string $id
     * @param array{reason?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/cancel-sales-order
     */
    public function cancel(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/cancel', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Reabrir un pedido
     *
     * Uno cerrado o cancelado vuelve a estar abierto.
     *
     * POST /v1/sales_orders/{id}/reopen
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sales_order',
     *     issuer: string,
     *     number: string,
     *     status: 'draft'|'confirmed'|'partially_delivered'|'delivered'|'invoiced'|'paid'|'closed'|'canceled',
     *     stage: string|null,
     *     url: string|null,
     *     customer: array{tax_id: string|null, name: string|null, email: string|null, catalog_id: string|null},
     *     customer_po: string|null,
     *     quote: string|null,
     *     currency: string,
     *     items: list<array{id: int, description: string, product_key: string|null, quantity: float|int, unit: string|null, unit_price: float|int, discount: float|int, amount: float|int, goods: bool, delivered: float|int, invoiced: float|int, canceled: float|int}>,
     *     subtotal: float|int,
     *     total: float|int,
     *     invoiced_total: float|int,
     *     paid_total: float|int,
     *     expected_on: string|null,
     *     payment_days: int,
     *     invoice_policy: 'delivered'|'ordered',
     *     ship_to: string|null,
     *     terms: string|null,
     *     notes: string|null,
     *     internal_note: string|null,
     *     deliveries: list<array{id: string, object: 'sales_order_delivery', number: string, status: 'delivered'|'canceled', delivered_on: string, carrier: string|null, tracking: string|null, note: string|null, received_by: string|null, received_at: string|null, items: list<array<string, mixed>>, created_at: string|null}>,
     *     invoices: list<array{id: string, status: 'stamped'|'canceled', total: float|int, balance: float|int|null}>,
     *     customer_confirmed_at: string|null,
     *     sent_at: string|null,
     *     viewed_at: string|null,
     *     confirmed_at: string|null,
     *     delivered_at: string|null,
     *     invoiced_at: string|null,
     *     paid_at: string|null,
     *     closed_at: string|null,
     *     canceled_at: string|null,
     *     cancel_reason: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/reopen-sales-order
     */
    public function reopen(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/sales_orders/' . rawurlencode($id) . '/reopen', ['idempotent' => true], $options);
    }

    /**
     * Descargar el PDF
     *
     * El PDF del pedido, con el diseño de PDF del emisor.
     *
     * GET /v1/sales_orders/{id}/pdf
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/pedidos/get-sales-order-pdf
     */
    public function pdf(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sales_orders/' . rawurlencode($id) . '/pdf', ['as' => 'bytes'], $options);
    }
}
