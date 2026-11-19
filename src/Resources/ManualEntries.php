<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->manualEntries.
 */
final class ManualEntries
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Capturar una póliza
     *
     * Una póliza a mano: un ajuste, una provisión (reverse_next_month la revierte el día 1 del mes
     * siguiente), una reclasificación. Cada renglón lleva una cuenta del catálogo por su número y
     * un cargo o un abono; si no cuadran contesta entry_unbalanced, y una cuenta que no existe,
     * account_missing. Entra a journal_entries, trial_balance, financial_statements y
     * electronic_accounting de su mes. No puede ser antes de los saldos iniciales.
     *
     * POST /v1/accounting/manual_entries
     *
     * @param array{
     *     issuer?: string,
     *     date: string,
     *     description: string,
     *     kind?: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type?: 'journal'|'income'|'expense',
     *     reverse_next_month?: bool,
     *     uuid?: string|null,
     *     uuid_tax_id?: string|null,
     *     repeat_until?: string|null,
     *     lines: list<array{account: string, debit?: float|int, credit?: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'manual_journal_entry',
     *     issuer: string,
     *     date: string,
     *     description: string,
     *     kind: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type: 'journal'|'income'|'expense',
     *     reverse_next_month: bool,
     *     reverses_on: string|null,
     *     repeat_until: string|null,
     *     uuid: string|null,
     *     uuid_tax_id: string|null,
     *     total: float|int,
     *     lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-manual-entry
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/manual_entries', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar las pólizas capturadas
     *
     * Las pólizas capturadas a mano del emisor, las más recientes primero.
     *
     * GET /v1/accounting/manual_entries
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     from?: string,
     *     to?: string,
     *     issuer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'manual_journal_entry', issuer: string, date: string, description: string, kind: 'adjustment'|'accrual'|'reclassification'|'other', journal_type: 'journal'|'income'|'expense', reverse_next_month: bool, reverses_on: string|null, repeat_until: string|null, uuid: string|null, uuid_tax_id: string|null, total: float|int, lines: list<array<string, mixed>>, created_at: string|null, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-manual-entries
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/accounting/manual_entries', $params, $options);
    }

    /**
     * Ver una póliza capturada
     *
     * Una póliza capturada a mano.
     *
     * GET /v1/accounting/manual_entries/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'manual_journal_entry',
     *     issuer: string,
     *     date: string,
     *     description: string,
     *     kind: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type: 'journal'|'income'|'expense',
     *     reverse_next_month: bool,
     *     reverses_on: string|null,
     *     repeat_until: string|null,
     *     uuid: string|null,
     *     uuid_tax_id: string|null,
     *     total: float|int,
     *     lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-manual-entry
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/manual_entries/' . rawurlencode($id), [], $options);
    }

    /**
     * Corregir una póliza capturada
     *
     * La reemplaza con lo que manda, con las mismas reglas que al capturarla.
     *
     * POST /v1/accounting/manual_entries/{id}
     *
     * @param string $id
     * @param array{
     *     date: string,
     *     description: string,
     *     kind?: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type?: 'journal'|'income'|'expense',
     *     reverse_next_month?: bool,
     *     uuid?: string|null,
     *     uuid_tax_id?: string|null,
     *     repeat_until?: string|null,
     *     lines: list<array{account: string, debit?: float|int, credit?: float|int}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'manual_journal_entry',
     *     issuer: string,
     *     date: string,
     *     description: string,
     *     kind: 'adjustment'|'accrual'|'reclassification'|'other',
     *     journal_type: 'journal'|'income'|'expense',
     *     reverse_next_month: bool,
     *     reverses_on: string|null,
     *     repeat_until: string|null,
     *     uuid: string|null,
     *     uuid_tax_id: string|null,
     *     total: float|int,
     *     lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/update-manual-entry
     */
    public function update(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/manual_entries/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una póliza capturada
     *
     * Sale de la contabilidad con su reversión, si tenía.
     *
     * DELETE /v1/accounting/manual_entries/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/delete-manual-entry
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/manual_entries/' . rawurlencode($id), [], $options);
    }

    /**
     * Importar pólizas de otro sistema
     *
     * Hasta 3,000 pólizas de una vez (las de CONTPAQi, COI o una hoja de cálculo), todas o
     * ninguna: cada una con las reglas de POST /v1/accounting/manual_entries, y el error dice cuál
     * (param entries[i].…). Entran como kind other. Una con el mismo number, fecha, tipo y total
     * que una ya importada se salta (duplicates). DELETE /v1/accounting/manual_entry_imports/{id}
     * quita las de una importación.
     *
     * POST /v1/accounting/manual_entry_imports
     *
     * @param array{
     *     issuer?: string,
     *     entries: list<array{date: string, journal_type?: 'journal'|'income'|'expense', number?: string|null, description: string, lines: list<array{account: string, debit?: float|int, credit?: float|int}>}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string|null,
     *     object: 'manual_entry_import',
     *     livemode: bool,
     *     issuer: string,
     *     imported: int,
     *     duplicates: int,
     *     from: string,
     *     to: string,
     *     manual_entries: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/import-manual-entries
     */
    public function importEntries(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/manual_entry_imports', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Deshacer una importación de pólizas
     *
     * Borra todas las pólizas que trajo esa importación (mji_…). No se puede si alguna es de un
     * mes cerrado (period_closed).
     *
     * DELETE /v1/accounting/manual_entry_imports/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/undo-manual-entries-import
     */
    public function undoImport(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/manual_entry_imports/' . rawurlencode($id), [], $options);
    }
}
