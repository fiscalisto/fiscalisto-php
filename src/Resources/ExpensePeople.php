<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Viáticos y gastos: $fiscalisto->expensePeople.
 */
final class ExpensePeople
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Agregar a una persona
     *
     * Alguien que viaja o gasta por el emisor: un empleado (employee, emp_…: sus anticipos y
     * reembolsos «En la nómina» van en su siguiente recibo) o alguien por honorarios (name y
     * tax_id). Con email, Fiscalisto le puede mandar su enlace.
     *
     * POST /v1/expense_people
     *
     * @param array{
     *     issuer?: string,
     *     kind: 'empleado'|'honorarios',
     *     employee?: string|null,
     *     name?: string|null,
     *     tax_id?: string|null,
     *     email?: string|null,
     *     base_city?: string|null,
     *     department?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_person',
     *     issuer: string,
     *     kind: 'empleado'|'honorarios',
     *     employee: string|null,
     *     name: string,
     *     tax_id: string|null,
     *     email: string|null,
     *     base_city: string|null,
     *     department: string|null,
     *     link_active: bool,
     *     archived: bool,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/create-expense-person
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_people', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar personas
     *
     * Las personas que comprueban gastos del emisor, las más recientes primero. Las archivadas
     * solo con include_archived=true.
     *
     * GET /v1/expense_people
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     include_archived?: bool,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'expense_person', issuer: string, kind: 'empleado'|'honorarios', employee: string|null, name: string, tax_id: string|null, email: string|null, base_city: string|null, department: string|null, link_active: bool, archived: bool, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/list-expense-people
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/expense_people', $params, $options);
    }

    /**
     * Ver una persona
     *
     * Una persona que comprueba gastos del emisor.
     *
     * GET /v1/expense_people/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_person',
     *     issuer: string,
     *     kind: 'empleado'|'honorarios',
     *     employee: string|null,
     *     name: string,
     *     tax_id: string|null,
     *     email: string|null,
     *     base_city: string|null,
     *     department: string|null,
     *     link_active: bool,
     *     archived: bool,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/get-expense-person
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/expense_people/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar una persona
     *
     * Cambia solo lo que manda. archived: true la archiva (ya no se le abren comprobaciones y su
     * enlace deja de funcionar), false la restaura.
     *
     * POST /v1/expense_people/{id}
     *
     * @param string $id
     * @param array{
     *     kind?: 'empleado'|'honorarios',
     *     employee?: string|null,
     *     name?: string|null,
     *     tax_id?: string|null,
     *     email?: string|null,
     *     base_city?: string|null,
     *     department?: string|null,
     *     archived?: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_person',
     *     issuer: string,
     *     kind: 'empleado'|'honorarios',
     *     employee: string|null,
     *     name: string,
     *     tax_id: string|null,
     *     email: string|null,
     *     base_city: string|null,
     *     department: string|null,
     *     link_active: bool,
     *     archived: bool,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/update-expense-person
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_people/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Dar su enlace a una persona
     *
     * El enlace donde la persona ve solo sus comprobaciones y sube sus facturas desde el teléfono,
     * sin cuenta. Con renew: true le da uno nuevo y el anterior deja de funcionar.
     *
     * POST /v1/expense_people/{id}/link
     *
     * @param string $id
     * @param array{renew?: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{object: 'expense_person_link', person: string, url: string|null}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/create-expense-person-link
     */
    public function createLink(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_people/' . rawurlencode($id) . '/link', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Apagar el enlace de una persona
     *
     * Su enlace deja de funcionar (url: null). Puede darle uno nuevo después con POST
     * /v1/expense_people/{id}/link.
     *
     * DELETE /v1/expense_people/{id}/link
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{object: 'expense_person_link', person: string, url: string|null}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/delete-expense-person-link
     */
    public function deleteLink(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/expense_people/' . rawurlencode($id) . '/link', [], $options);
    }
}
