<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Viáticos y gastos: $fiscalisto->expensePolicy.
 */
final class ExpensePolicy
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver la política
     *
     * La política de viáticos y gastos del emisor: topes por categoría, hasta cuánto sin factura y
     * los días para comprobar.
     *
     * GET /v1/expense_policy
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'expense_policy',
     *     livemode: bool,
     *     issuer: string,
     *     limits: array<string, mixed>,
     *     ticket_limit: float|int,
     *     due_days: int,
     *     note_over_limit: bool,
     *     notify_approvers: bool,
     *     notify_people: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/get-expense-policy
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/expense_policy', ['query' => $params], $options);
    }

    /**
     * Cambiar la política
     *
     * Cambia solo lo que manda; en limits, una categoría con null deja de tener tope. Un gasto que
     * pasa un tope no se rechaza: se marca para quien aprueba.
     *
     * POST /v1/expense_policy
     *
     * @param array{
     *     issuer?: string,
     *     limits?: array<string, mixed>,
     *     ticket_limit?: float|int,
     *     due_days?: int,
     *     note_over_limit?: bool,
     *     notify_approvers?: bool,
     *     notify_people?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'expense_policy',
     *     livemode: bool,
     *     issuer: string,
     *     limits: array<string, mixed>,
     *     ticket_limit: float|int,
     *     due_days: int,
     *     note_over_limit: bool,
     *     notify_approvers: bool,
     *     notify_people: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/update-expense-policy
     */
    public function update(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_policy', ['body' => $params, 'idempotent' => true], $options);
    }
}
