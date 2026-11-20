<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Reglas: $fiscalisto->rules.
 */
final class Rules
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear una regla
     *
     * Cuando pasa trigger, si se cumplen conditions, hace actions. Corre desde ese momento con lo
     * que llegue; no cambia lo que ya existe. Va al final del orden de su empresa. Lo que no se
     * puede guardar contesta rule_invalid con el porqué (una acción que no va con su trigger, una
     * etiqueta o centro de costo que no existe).
     *
     * POST /v1/rules
     *
     * @param array{
     *     issuer?: string,
     *     name?: string,
     *     trigger: 'invoice.received'|'invoice.issued'|'purchase_order.saved'|'purchase_order.approved'|'purchase_order.sent'|'purchase_order.confirmed'|'purchase_order.received_part'|'purchase_order.received_all'|'purchase_order.invoiced_all'|'purchase_order.price_variance'|'purchase_order.registered',
     *     conditions?: array{match?: 'all'|'any', conditions?: list<array{field: string, operator: 'is'|'not'|'gte'|'lte'|'between'|'contains'|'not_contains'|'starts'|'yes'|'no'|'set'|'unset', values?: list<string>, value?: float|int, to?: float|int, text?: string}>, groups?: list<array{match: 'all'|'any', conditions: list<array<string, mixed>>}>},
     *     actions: list<array{type: 'tag'|'cost_center'|'stage'|'close'|'notify', tag?: int, remove_when_unmet?: bool, cost_center?: string, stage?: int, members?: list<string>, note?: string|null}>,
     *     once_per_record?: bool,
     *     stop_after?: bool,
     *     enabled?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'rule',
     *     issuer: string,
     *     name: string,
     *     trigger: 'invoice.received'|'invoice.issued'|'purchase_order.saved'|'purchase_order.approved'|'purchase_order.sent'|'purchase_order.confirmed'|'purchase_order.received_part'|'purchase_order.received_all'|'purchase_order.invoiced_all'|'purchase_order.price_variance'|'purchase_order.registered',
     *     conditions: array{match: 'all'|'any', conditions: list<array<string, mixed>>, groups: list<array<string, mixed>>},
     *     actions: list<array{type: 'tag'|'cost_center'|'stage'|'close'|'notify', tag?: int, remove_when_unmet?: bool, cost_center?: string, stage?: int, members?: list<string>, note?: string|null}>,
     *     once_per_record: bool,
     *     stop_after: bool,
     *     enabled: bool,
     *     position: int,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/create-rule
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/rules', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar reglas
     *
     * En el orden en que corren, también las que están en pausa (enabled: false).
     *
     * GET /v1/rules
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string, trigger?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'rule', issuer: string, name: string, trigger: 'invoice.received'|'invoice.issued'|'purchase_order.saved'|'purchase_order.approved'|'purchase_order.sent'|'purchase_order.confirmed'|'purchase_order.received_part'|'purchase_order.received_all'|'purchase_order.invoiced_all'|'purchase_order.price_variance'|'purchase_order.registered', conditions: array<string, mixed>, actions: list<array<string, mixed>>, once_per_record: bool, stop_after: bool, enabled: bool, position: int, created_at: string|null, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/list-rules
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/rules', $params, $options);
    }

    /**
     * Ordenar las reglas
     *
     * rules de la primera a la última; las que no mande siguen después, en su orden. Importa
     * cuando una tiene stop_after o dos ponen cosas distintas: corren de arriba abajo.
     *
     * POST /v1/rules/order
     *
     * @param array{issuer?: string, rules: list<string>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'rule', issuer: string, name: string, trigger: 'invoice.received'|'invoice.issued'|'purchase_order.saved'|'purchase_order.approved'|'purchase_order.sent'|'purchase_order.confirmed'|'purchase_order.received_part'|'purchase_order.received_all'|'purchase_order.invoiced_all'|'purchase_order.price_variance'|'purchase_order.registered', conditions: array<string, mixed>, actions: list<array<string, mixed>>, once_per_record: bool, stop_after: bool, enabled: bool, position: int, created_at: string|null, updated_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/order-rules
     */
    public function order(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/rules/order', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver una regla
     *
     * Una regla de la empresa del emisor.
     *
     * GET /v1/rules/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'rule',
     *     issuer: string,
     *     name: string,
     *     trigger: 'invoice.received'|'invoice.issued'|'purchase_order.saved'|'purchase_order.approved'|'purchase_order.sent'|'purchase_order.confirmed'|'purchase_order.received_part'|'purchase_order.received_all'|'purchase_order.invoiced_all'|'purchase_order.price_variance'|'purchase_order.registered',
     *     conditions: array{match: 'all'|'any', conditions: list<array<string, mixed>>, groups: list<array<string, mixed>>},
     *     actions: list<array{type: 'tag'|'cost_center'|'stage'|'close'|'notify', tag?: int, remove_when_unmet?: bool, cost_center?: string, stage?: int, members?: list<string>, note?: string|null}>,
     *     once_per_record: bool,
     *     stop_after: bool,
     *     enabled: bool,
     *     position: int,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/get-rule
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/rules/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar una regla
     *
     * Solo lo que mande cambia; conditions y actions se reemplazan completos. enabled: false la
     * pone en pausa. Lo que ya hizo se queda.
     *
     * POST /v1/rules/{id}
     *
     * @param string $id
     * @param array{
     *     name?: string,
     *     trigger?: 'invoice.received'|'invoice.issued'|'purchase_order.saved'|'purchase_order.approved'|'purchase_order.sent'|'purchase_order.confirmed'|'purchase_order.received_part'|'purchase_order.received_all'|'purchase_order.invoiced_all'|'purchase_order.price_variance'|'purchase_order.registered',
     *     conditions?: array{match?: 'all'|'any', conditions?: list<array{field: string, operator: 'is'|'not'|'gte'|'lte'|'between'|'contains'|'not_contains'|'starts'|'yes'|'no'|'set'|'unset', values?: list<string>, value?: float|int, to?: float|int, text?: string}>, groups?: list<array{match: 'all'|'any', conditions: list<array<string, mixed>>}>},
     *     actions?: list<array{type: 'tag'|'cost_center'|'stage'|'close'|'notify', tag?: int, remove_when_unmet?: bool, cost_center?: string, stage?: int, members?: list<string>, note?: string|null}>,
     *     once_per_record?: bool,
     *     stop_after?: bool,
     *     enabled?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'rule',
     *     issuer: string,
     *     name: string,
     *     trigger: 'invoice.received'|'invoice.issued'|'purchase_order.saved'|'purchase_order.approved'|'purchase_order.sent'|'purchase_order.confirmed'|'purchase_order.received_part'|'purchase_order.received_all'|'purchase_order.invoiced_all'|'purchase_order.price_variance'|'purchase_order.registered',
     *     conditions: array{match: 'all'|'any', conditions: list<array<string, mixed>>, groups: list<array<string, mixed>>},
     *     actions: list<array{type: 'tag'|'cost_center'|'stage'|'close'|'notify', tag?: int, remove_when_unmet?: bool, cost_center?: string, stage?: int, members?: list<string>, note?: string|null}>,
     *     once_per_record: bool,
     *     stop_after: bool,
     *     enabled: bool,
     *     position: int,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/update-rule
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/rules/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una regla
     *
     * Deja de correr. Lo que ya puso (centros de costo, etiquetas, etapas) se queda; para dejarla
     * de usar un tiempo, mejor enabled: false.
     *
     * DELETE /v1/rules/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/delete-rule
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/rules/' . rawurlencode($id), [], $options);
    }

    /**
     * Probar una regla
     *
     * Lo que haría con una factura (uuid) o con las más recientes de su trigger, sin cambiar nada:
     * cada condición con lo que tiene el registro y si se cumple.
     *
     * POST /v1/rules/{id}/test
     *
     * @param string $id
     * @param array{uuid?: string, limit?: int} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{object: 'rule_test', record: string, invoice_uuid?: string|null, purchase_order?: int, matches: bool, already_ran: bool, conditions: list<array<string, mixed>>, would_do: list<string>}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/test-rule
     */
    public function test(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/rules/' . rawurlencode($id) . '/test', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Historial de una regla
     *
     * Cada vez que corrió, la más reciente primero: sobre qué factura u orden, qué hizo (did) o
     * por qué no pudo (error). Se guardan 180 días.
     *
     * GET /v1/rules/{id}/runs
     *
     * @param string $id
     * @param array{limit?: int, starting_after?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'rule_run', rule: string, trigger: 'invoice.received'|'invoice.issued'|'purchase_order.saved'|'purchase_order.approved'|'purchase_order.sent'|'purchase_order.confirmed'|'purchase_order.received_part'|'purchase_order.received_all'|'purchase_order.invoiced_all'|'purchase_order.price_variance'|'purchase_order.registered', record: string, record_type: 'invoice'|'purchase_order', outcome: 'done'|'nothing'|'failed', did: list<string>, error: string|null, created_at: string}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/reglas/list-rule-runs
     */
    public function listRuns(string $id, array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/rules/' . rawurlencode($id) . '/runs', $params, $options);
    }
}
