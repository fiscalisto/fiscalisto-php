<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->automaticEntries.
 */
final class AutomaticEntries
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver la póliza de un CFDI
     *
     * La póliza que arma Fiscalisto para una factura, nota de crédito o recibo de nómina del
     * emisor (por el UUID del CFDI), con su edición a mano si la tiene. Un pago no tiene una
     * propia que se edite: se corrige con una póliza capturada.
     *
     * GET /v1/accounting/automatic_entries/{uuid}
     *
     * @param string $uuid
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     livemode: bool,
     *     object: 'automatic_journal_entry',
     *     issuer: string,
     *     uuid: string,
     *     type: 'invoice'|'payroll',
     *     date: string,
     *     description: string,
     *     lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int, cost_center: string|null, reason: string|null}>,
     *     edited: bool,
     *     edited_at: string|null,
     *     original_lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int, cost_center: string|null, reason: string|null}>|null,
     *     original_changed: bool|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-automatic-entry
     */
    public function get(string $uuid, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/automatic_entries/' . rawurlencode($uuid), ['query' => $params], $options);
    }

    /**
     * Editar la póliza de un CFDI
     *
     * Sus renglones (y su concepto) en lugar de los que arma Fiscalisto, con las reglas de una
     * póliza capturada: cuentas del catálogo y cargos que suman lo mismo que los abonos
     * (entry_unbalanced). Se queda aunque el CFDI se vuelva a descargar, en su mes y en los saldos
     * de los siguientes, y va a la bitácora. Un mes cerrado contesta period_closed. Los mismos
     * renglones que la original quitan la edición.
     *
     * POST /v1/accounting/automatic_entries/{uuid}
     *
     * @param string $uuid
     * @param array{
     *     issuer?: string,
     *     description?: string,
     *     lines: list<array{account: string, debit?: float|int, credit?: float|int, cost_center?: string|null, currency?: string|null, foreign_amount?: float|int|null, exchange_rate?: float|int|null, cfdi_uuid?: string|null, cfdi_tax_id?: string|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     livemode: bool,
     *     object: 'automatic_journal_entry',
     *     issuer: string,
     *     uuid: string,
     *     type: 'invoice'|'payroll',
     *     date: string,
     *     description: string,
     *     lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int, cost_center: string|null, reason: string|null}>,
     *     edited: bool,
     *     edited_at: string|null,
     *     original_lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int, cost_center: string|null, reason: string|null}>|null,
     *     original_changed: bool|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/update-automatic-entry
     */
    public function update(string $uuid, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/automatic_entries/' . rawurlencode($uuid), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Volver a la póliza original de un CFDI
     *
     * Quita la edición a mano: los libros vuelven a usar los renglones que arma Fiscalisto. Un mes
     * cerrado contesta period_closed.
     *
     * DELETE /v1/accounting/automatic_entries/{uuid}
     *
     * @param string $uuid
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     livemode: bool,
     *     object: 'automatic_journal_entry',
     *     issuer: string,
     *     uuid: string,
     *     type: 'invoice'|'payroll',
     *     date: string,
     *     description: string,
     *     lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int, cost_center: string|null, reason: string|null}>,
     *     edited: bool,
     *     edited_at: string|null,
     *     original_lines: list<array{account: string, account_name: string, grouping_code: string, debit: float|int, credit: float|int, cost_center: string|null, reason: string|null}>|null,
     *     original_changed: bool|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/revert-automatic-entry
     */
    public function revert(string $uuid, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/automatic_entries/' . rawurlencode($uuid), ['query' => $params], $options);
    }
}
