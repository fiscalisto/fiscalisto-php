<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollBatches.
 */
final class PayrollBatches
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Timbrar una nómina completa (lote)
     *
     * Toda una corrida de nómina en una solicitud: hasta 1,000 recibos de un emisor, timbrados en
     * segundo plano uno tras otro, sin el límite de timbres por segundo de una sola solicitud. De
     * una de dos formas, nunca mezcladas: receipts (ids de empleado; Fiscalisto calcula cada
     * recibo con el periodo del lote) o external_receipts (los recibos que calculó su sistema,
     * como en POST /v1/payroll_receipts/external, con reference en lugar de metadata). Todo lo que
     * se puede revisar antes se revisa antes: si algo falla, no se timbra ninguno y el error dice
     * qué recibo (param receipts.3.employee). Lo que solo se sabe al timbrar (un periodo ya
     * pagado, el SAT que rechaza un RFC) queda en ese recibo, con su error. Un recibo por empleado
     * y periodo: mandar la corrida otra vez, aun con otra Idempotency-Key, devuelve los recibos
     * que ya tiene. Responde 202; escuche payroll_batch.completed o consulte el lote.
     *
     * POST /v1/payroll_batches
     *
     * @param array{
     *     issuer?: string,
     *     name?: string,
     *     period?: array{start: string, end: string, payment_date?: string},
     *     send_email?: bool,
     *     receipts?: list<array{employee: string, period?: array{start: string, end: string, payment_date?: string}, days?: float|int, send_email?: bool, reference?: string}>,
     *     external_receipts?: list<array{issuer?: string, type: 'O'|'E', periodicity: string, period: array{start: string, end: string, payment_date: string}, days: float|int, employer?: array{registration?: string|null, curp?: string|null, origin_tax_id?: string, sncf?: array<string, mixed>}, employee: array{tax_id: string, name: string, zip: string, curp: string, number: string, email?: string|null, social_security_number?: string, start_date?: string, seniority?: string, contract_type: string, regime_type: string, unionized?: bool, workday_type?: string, risk_class?: string, department?: string, position?: string, contribution_base_salary?: float|int, integrated_daily_salary?: float|int, state: string, bank?: string, bank_account?: string, subcontracting?: list<array<string, mixed>>}, perceptions?: list<array{type: string, key: string, concept: string, taxed: float|int, exempt: float|int, overtime?: list<array<string, mixed>>, stock_options?: array<string, mixed>}>, separation?: array{total_paid: float|int, years_of_service: float|int, last_monthly_salary: float|int, accumulable_income: float|int, non_accumulable_income: float|int}, retirement?: array{total_one_payment?: float|int, total_installment?: float|int, daily_amount?: float|int, accumulable_income: float|int, non_accumulable_income: float|int}, deductions?: list<array{type: string, key: string, concept: string, amount: float|int}>, other_payments?: list<array{type: string, key: string, concept: string, amount: float|int, subsidy_caused?: float|int, balance_compensation?: array<string, mixed>}>, disabilities?: list<array{days: float|int, type: string, amount?: float|int}>, totals: array{perceptions: float|int, deductions: float|int, other_payments: float|int, net: float|int, salaries?: float|int, separation?: float|int, retirement?: float|int, taxed?: float|int, exempt?: float|int, taxes_withheld?: float|int, other_deductions?: float|int}, references?: array{employee_id?: string, payroll_run_id?: string}, replaces?: string, send_email?: bool, metadata?: array<string, mixed>, reference?: string}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'payroll_batch',
     *     issuer: string,
     *     name: string,
     *     calculation: 'fiscalisto'|'external',
     *     status: 'processing'|'completed',
     *     total: int,
     *     stamped: int,
     *     failed: int,
     *     processing: int,
     *     created_at: string|null,
     *     completed_at: string|null,
     *     receipts?: list<array{index: int, reference: string|null, employee: string|null, tax_id: string, name: string|null, status: 'processing'|'valid'|'failed', invoice: string|null, uuid: string|null, total: float|int|null, error: array<string, mixed>|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-payroll-batch
     */
    public function create(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_batches', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar lotes de nómina
     *
     * Los lotes de nómina, los más recientes primero, con cuántos recibos se timbraron y cuántos
     * no.
     *
     * GET /v1/payroll_batches
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'payroll_batch', issuer: string, name: string, calculation: 'fiscalisto'|'external', status: 'processing'|'completed', total: int, stamped: int, failed: int, processing: int, created_at: string|null, completed_at: string|null, receipts?: list<array<string, mixed>>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-payroll-batches
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/payroll_batches', $params, $options);
    }

    /**
     * Ver un lote de nómina
     *
     * Con el recibo de cada empleado: timbrado (su factura y UUID) o por qué no (error.code y
     * error.message).
     *
     * GET /v1/payroll_batches/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'payroll_batch',
     *     issuer: string,
     *     name: string,
     *     calculation: 'fiscalisto'|'external',
     *     status: 'processing'|'completed',
     *     total: int,
     *     stamped: int,
     *     failed: int,
     *     processing: int,
     *     created_at: string|null,
     *     completed_at: string|null,
     *     receipts?: list<array{index: int, reference: string|null, employee: string|null, tax_id: string, name: string|null, status: 'processing'|'valid'|'failed', invoice: string|null, uuid: string|null, total: float|int|null, error: array<string, mixed>|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-payroll-batch
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payroll_batches/' . rawurlencode($id), [], $options);
    }
}
