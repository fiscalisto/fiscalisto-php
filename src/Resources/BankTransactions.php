<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Conciliación bancaria: $fiscalisto->bankTransactions.
 */
final class BankTransactions
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Mandar depósitos
     *
     * Los depósitos de la cuenta del emisor (de la API de su banco o de un estado de cuenta),
     * hasta 1,000 por solicitud. Uno que ya mandó (mismo día, monto, referencia y concepto) se
     * omite, así que puede mandar periodos que se enciman. Cada uno trae suggested_match: las
     * facturas que parece pagar.
     *
     * POST /v1/bank_transactions
     *
     * @param array{
     *     issuer?: string,
     *     account?: string,
     *     transactions: list<array{date: string, amount: float|int, description: string, reference?: string, payer_tax_id?: string}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'bank_import',
     *     livemode: bool,
     *     issuer: string,
     *     added: int,
     *     duplicates: int,
     *     data: list<array{id: string, livemode: bool, object: 'bank_transaction', issuer: string, date: string, amount: float|int, description: string, reference: string|null, account: string|null, payer_tax_id: string|null, status: 'open'|'matched'|'classified', classification: 'venta'|'prestamo'|'traspaso'|'devolucion'|null, note: string|null, invoices: list<string>, payment: string|null, suggested_match: array<string, mixed>|null, created_at: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/conciliacion-bancaria/create-bank-transactions
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/bank_transactions', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar depósitos
     *
     * Los más recientes primero; los abiertos con su suggested_match.
     *
     * GET /v1/bank_transactions
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: 'open'|'matched'|'classified',
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'bank_transaction', issuer: string, date: string, amount: float|int, description: string, reference: string|null, account: string|null, payer_tax_id: string|null, status: 'open'|'matched'|'classified', classification: 'venta'|'prestamo'|'traspaso'|'devolucion'|null, note: string|null, invoices: list<string>, payment: string|null, suggested_match: array<string, mixed>|null, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/conciliacion-bancaria/list-bank-transactions
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/bank_transactions', $params, $options);
    }

    /**
     * Ver un depósito
     *
     * Un depósito mandado a conciliación, con las facturas que se le encontraron o el pago que se
     * registró con él.
     *
     * GET /v1/bank_transactions/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'bank_transaction',
     *     issuer: string,
     *     date: string,
     *     amount: float|int,
     *     description: string,
     *     reference: string|null,
     *     account: string|null,
     *     payer_tax_id: string|null,
     *     status: 'open'|'matched'|'classified',
     *     classification: 'venta'|'prestamo'|'traspaso'|'devolucion'|null,
     *     note: string|null,
     *     invoices: list<string>,
     *     payment: string|null,
     *     suggested_match: array{invoices: list<string>, amounts: array<string, mixed>, method: 'PPD'|'PUE', confidence: 'high'|'medium', reasons: list<string>}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/conciliacion-bancaria/get-bank-transaction
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/bank_transactions/' . rawurlencode($id), [], $options);
    }

    /**
     * Conciliar un depósito
     *
     * El depósito pagó estas facturas (de un mismo cliente), o sin invoices, las de
     * suggested_match. Sus facturas PUE por cobrar quedan pagadas (invoice.paid). No timbra: para
     * pagar una PPD con este depósito, POST /v1/payments con bank_transaction.
     *
     * POST /v1/bank_transactions/{id}/match
     *
     * @param string $id
     * @param array{invoices?: list<string>} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'bank_transaction',
     *     issuer: string,
     *     date: string,
     *     amount: float|int,
     *     description: string,
     *     reference: string|null,
     *     account: string|null,
     *     payer_tax_id: string|null,
     *     status: 'open'|'matched'|'classified',
     *     classification: 'venta'|'prestamo'|'traspaso'|'devolucion'|null,
     *     note: string|null,
     *     invoices: list<string>,
     *     payment: string|null,
     *     suggested_match: array{invoices: list<string>, amounts: array<string, mixed>, method: 'PPD'|'PUE', confidence: 'high'|'medium', reasons: list<string>}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/conciliacion-bancaria/match-bank-transaction
     */
    public function match(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/bank_transactions/' . rawurlencode($id) . '/match', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Explicar un depósito sin factura
     *
     * Un depósito que ninguna factura explica: venta (aún sin facturar), prestamo, traspaso o
     * devolucion. El SAT puede presumir ingreso un depósito sin explicar (CFF art. 59 fr. III).
     *
     * POST /v1/bank_transactions/{id}/classify
     *
     * @param string $id
     * @param array{
     *     classification: 'venta'|'prestamo'|'traspaso'|'devolucion',
     *     note?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'bank_transaction',
     *     issuer: string,
     *     date: string,
     *     amount: float|int,
     *     description: string,
     *     reference: string|null,
     *     account: string|null,
     *     payer_tax_id: string|null,
     *     status: 'open'|'matched'|'classified',
     *     classification: 'venta'|'prestamo'|'traspaso'|'devolucion'|null,
     *     note: string|null,
     *     invoices: list<string>,
     *     payment: string|null,
     *     suggested_match: array{invoices: list<string>, amounts: array<string, mixed>, method: 'PPD'|'PUE', confidence: 'high'|'medium', reasons: list<string>}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/conciliacion-bancaria/classify-bank-transaction
     */
    public function classify(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/bank_transactions/' . rawurlencode($id) . '/classify', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Deshacer la conciliación
     *
     * Vuelve a open, y sus facturas vuelven a deber. Si se pagó con un complemento vigente,
     * cancélelo antes.
     *
     * POST /v1/bank_transactions/{id}/reopen
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'bank_transaction',
     *     issuer: string,
     *     date: string,
     *     amount: float|int,
     *     description: string,
     *     reference: string|null,
     *     account: string|null,
     *     payer_tax_id: string|null,
     *     status: 'open'|'matched'|'classified',
     *     classification: 'venta'|'prestamo'|'traspaso'|'devolucion'|null,
     *     note: string|null,
     *     invoices: list<string>,
     *     payment: string|null,
     *     suggested_match: array{invoices: list<string>, amounts: array<string, mixed>, method: 'PPD'|'PUE', confidence: 'high'|'medium', reasons: list<string>}|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/conciliacion-bancaria/reopen-bank-transaction
     */
    public function reopen(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/bank_transactions/' . rawurlencode($id) . '/reopen', ['idempotent' => true], $options);
    }
}
