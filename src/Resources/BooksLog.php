<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->booksLog.
 */
final class BooksLog
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar la bitácora de la contabilidad
     *
     * Cada cambio a la contabilidad del RFC del emisor, del más reciente al más antiguo: pólizas a
     * mano (también las que hacen el cierre del mes, la revaluación y los bancos), saldos
     * iniciales, cuentas y el catálogo (que comparten los RFC del espacio), cierres y reaperturas
     * de mes, eliminaciones de consolidación, pólizas modelo y bajas de activos. Cada uno dice
     * quién lo hizo (un usuario, una llave de la API o un asistente) y cómo estaba antes y
     * después. Guardar algo sin cambios no deja registro.
     *
     * GET /v1/accounting/books_log
     *
     * @param array{
     *     subject?: 'manual_journal_entry'|'opening_balances'|'account'|'chart_of_accounts'|'period_close'|'consolidation_elimination'|'entry_template'|'fixed_asset'|'invoice_account',
     *     from?: string,
     *     to?: string,
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'books_log_entry', issuer: string, created_at: string, subject: 'manual_journal_entry'|'opening_balances'|'account'|'chart_of_accounts'|'period_close'|'consolidation_elimination'|'entry_template'|'fixed_asset'|'invoice_account', subject_id: string|null, action: 'created'|'updated'|'deleted'|'restored'|'imported'|'closed'|'reopened', description: string, actor: array<string, mixed>, before: mixed, after: mixed}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-books-log
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/accounting/books_log', $params, $options);
    }
}
