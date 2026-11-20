<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->entryTemplates.
 */
final class EntryTemplates
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar las pólizas modelo
     *
     * Las pólizas modelo del emisor, por nombre: las cuentas de una póliza que captura seguido con
     * el porcentaje del total de cada renglón. Como «Usar un modelo» en Nueva póliza.
     *
     * GET /v1/accounting/entry_templates
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'entry_template', issuer: string, name: string, description: string, kind: 'adjustment'|'accrual'|'reclassification'|'other', journal_type: 'journal'|'income'|'expense', lines: list<array<string, mixed>>, updated_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-entry-templates
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/entry_templates', ['query' => $params], $options);
    }

    /**
     * Guardar una póliza modelo
     *
     * Guarda las cuentas de una póliza bajo un nombre, cada renglón en su lado con el porcentaje
     * del total (percentage), un importe fijo (amount) o ninguno, para escribirlo cada vez. Los
     * porcentajes de un lado suman hasta 100. El nombre es único en el emisor.
     *
     * POST /v1/accounting/entry_templates
     *
     * @param array{
     *     issuer?: string,
     *     name: string,
     *     description: string,
     *     kind?: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type?: 'journal'|'income'|'expense',
     *     lines: list<array{account: string, side: 'debit'|'credit', percentage?: float|int|null, amount?: float|int|null, cost_center?: string|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'entry_template',
     *     issuer: string,
     *     name: string,
     *     description: string,
     *     kind: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type: 'journal'|'income'|'expense',
     *     lines: list<array{account: string, account_name: string, side: 'debit'|'credit', percentage: float|int|null, amount: float|int|null, cost_center: string|null}>,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-entry-template
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/entry_templates', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Cambiar una póliza modelo
     *
     * La reemplaza con lo que manda. Las pólizas que ya se hicieron con ella no cambian.
     *
     * POST /v1/accounting/entry_templates/{id}
     *
     * @param string $id
     * @param array{
     *     name: string,
     *     description: string,
     *     kind?: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type?: 'journal'|'income'|'expense',
     *     lines: list<array{account: string, side: 'debit'|'credit', percentage?: float|int|null, amount?: float|int|null, cost_center?: string|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'entry_template',
     *     issuer: string,
     *     name: string,
     *     description: string,
     *     kind: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type: 'journal'|'income'|'expense',
     *     lines: list<array{account: string, account_name: string, side: 'debit'|'credit', percentage: float|int|null, amount: float|int|null, cost_center: string|null}>,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/update-entry-template
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/entry_templates/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una póliza modelo
     *
     * Las pólizas que ya se hicieron con ella no cambian.
     *
     * DELETE /v1/accounting/entry_templates/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/delete-entry-template
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/entry_templates/' . rawurlencode($id), [], $options);
    }

    /**
     * Calcular los renglones de una póliza modelo
     *
     * Los renglones de la póliza modelo para un total: cada porcentaje al centavo, los importes
     * fijos como están y 0 donde no hay ninguno. El centavo del redondeo va al renglón más grande
     * de un lado que suma 100%, para que cuadre. Mándelos como lines en POST
     * /v1/accounting/manual_entries; aquí no se guarda nada.
     *
     * POST /v1/accounting/entry_templates/{id}/apply
     *
     * @param string $id
     * @param array{total: float|int} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'entry_template_lines',
     *     livemode: bool,
     *     entry_template: string,
     *     total: float|int,
     *     description: string,
     *     kind: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type: 'journal'|'income'|'expense',
     *     lines: list<array{account: string, debit: float|int, credit: float|int, cost_center: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/apply-entry-template
     */
    public function apply(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/entry_templates/' . rawurlencode($id) . '/apply', ['body' => $params, 'idempotent' => true], $options);
    }
}
