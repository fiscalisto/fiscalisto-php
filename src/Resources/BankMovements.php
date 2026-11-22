<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->bankMovements.
 */
final class BankMovements
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar los movimientos de banco sin factura
     *
     * Los movimientos de banco de un mes que ninguna factura explica: los retiros de los estados
     * de cuenta importados en la conciliación (comisiones, impuestos, pagos de préstamos,
     * traspasos) y los depósitos que ahí se clasificaron como préstamo, traspaso, devolución o
     * intereses. Cada uno con su póliza, si ya se registró, y la cuenta sugerida. Lo que pagó o
     * cobró una factura ya está en la contabilidad por su CFDI.
     *
     * GET /v1/accounting/bank_movements
     *
     * @param array{month?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{id: string, livemode: bool, object: 'accounting_bank_movement', issuer: string, direction: 'deposit'|'withdrawal', date: string, description: string, reference: string|null, amount: float|int, bank: string, bank_account: string|null, classification: 'loan'|'transfer'|'refund'|'interest'|null, status: 'pending'|'posted'|'paid_invoices'|'ignored', manual_entry: string|null, account: string|null, suggested_account: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-bank-movements
     */
    public function list(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/bank_movements', ['query' => $params], $options);
    }

    /**
     * Registrar un movimiento de banco
     *
     * Le hace su póliza con fecha del movimiento: de ingresos (Bancos contra account) a un
     * depósito, de egresos (account contra Bancos) a un retiro. Entra a la balanza, el auxiliar y
     * la contabilidad electrónica como cualquier póliza capturada (manual_entry). Uno ya
     * registrado contesta bank_movement_posted; un depósito sin clasificar o un retiro marcado,
     * bank_movement_not_bookable.
     *
     * POST /v1/accounting/bank_movements/{id}/post
     *
     * @param string $id
     * @param array{account: string, description?: string, remember?: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'accounting_bank_movement',
     *     issuer: string,
     *     direction: 'deposit'|'withdrawal',
     *     date: string,
     *     description: string,
     *     reference: string|null,
     *     amount: float|int,
     *     bank: string,
     *     bank_account: string|null,
     *     classification: 'loan'|'transfer'|'refund'|'interest'|null,
     *     status: 'pending'|'posted'|'paid_invoices'|'ignored',
     *     manual_entry: string|null,
     *     account: string|null,
     *     suggested_account: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/post-bank-movement
     */
    public function post(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/bank_movements/' . rawurlencode($id) . '/post', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar la póliza de un movimiento de banco
     *
     * Su póliza sale de la contabilidad y el movimiento vuelve a pending. Sin póliza contesta
     * bank_movement_not_posted.
     *
     * DELETE /v1/accounting/bank_movements/{id}/post
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'accounting_bank_movement',
     *     issuer: string,
     *     direction: 'deposit'|'withdrawal',
     *     date: string,
     *     description: string,
     *     reference: string|null,
     *     amount: float|int,
     *     bank: string,
     *     bank_account: string|null,
     *     classification: 'loan'|'transfer'|'refund'|'interest'|null,
     *     status: 'pending'|'posted'|'paid_invoices'|'ignored',
     *     manual_entry: string|null,
     *     account: string|null,
     *     suggested_account: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/unpost-bank-movement
     */
    public function unpost(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/bank_movements/' . rawurlencode($id) . '/post', [], $options);
    }

    /**
     * Marcar un retiro
     *
     * paid_invoices: pagó facturas que ya están en la contabilidad por su CFDI; ignored: no se
     * registra; pending: vuelve a por registrar. Solo retiros sin póliza.
     *
     * POST /v1/accounting/bank_movements/{id}/mark
     *
     * @param string $id
     * @param array{status: 'pending'|'paid_invoices'|'ignored'} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'accounting_bank_movement',
     *     issuer: string,
     *     direction: 'deposit'|'withdrawal',
     *     date: string,
     *     description: string,
     *     reference: string|null,
     *     amount: float|int,
     *     bank: string,
     *     bank_account: string|null,
     *     classification: 'loan'|'transfer'|'refund'|'interest'|null,
     *     status: 'pending'|'posted'|'paid_invoices'|'ignored',
     *     manual_entry: string|null,
     *     account: string|null,
     *     suggested_account: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/mark-bank-movement
     */
    public function mark(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/bank_movements/' . rawurlencode($id) . '/mark', ['body' => $params, 'idempotent' => true], $options);
    }
}
