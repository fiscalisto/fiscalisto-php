<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Viáticos y gastos: $fiscalisto->expenseReports.
 */
final class ExpenseReports
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Abrir una comprobación
     *
     * Una por viaje (kind viaje) o una por periodo de gastos de oficina que la empresa reembolsa
     * (kind gastos). Queda abierta (draft): se le agregan gastos y anticipos, y se envía con POST
     * /v1/expense_reports/{id}/submit.
     *
     * POST /v1/expense_reports
     *
     * @param array{
     *     person: string,
     *     kind?: 'viaje'|'gastos',
     *     title?: string|null,
     *     purpose?: string|null,
     *     destination?: string|null,
     *     abroad?: bool,
     *     far?: bool,
     *     start_date?: string|null,
     *     end_date?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/create-expense-report
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar comprobaciones
     *
     * Las comprobaciones del emisor, las más recientes primero, con sus gastos y movimientos.
     *
     * GET /v1/expense_reports
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     issuer?: string,
     *     status?: string,
     *     person?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'expense_report', issuer: string, number: int, label: string, person: string, person_name: string, kind: 'viaje'|'gastos', title: string, purpose: string|null, destination: string|null, abroad: bool, far: bool, start_date: string|null, end_date: string|null, status: 'draft'|'submitted'|'rejected'|'approved'|'closed', due_date: string|null, submitted_at: string|null, decided_at: string|null, decision_note: string|null, closed_at: string|null, in_payroll: bool, spent: float|int, rejected: float|int, proven: float|int, deductible: float|int, non_deductible: float|int, advances: float|int, reimbursed: float|int, returned: float|int, balance: float|int, ready: bool, issues: list<array<string, mixed>>, payroll: array<string, mixed>|null, items: list<array<string, mixed>>, movements: list<array<string, mixed>>, created_at: string|null, updated_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/list-expense-reports
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/expense_reports', $params, $options);
    }

    /**
     * Ver una comprobación
     *
     * Una comprobación con sus gastos, lo deducible de cada uno, sus avisos (issues) contra la ley
     * y la política, y su saldo.
     *
     * GET /v1/expense_reports/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/get-expense-report
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/expense_reports/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar una comprobación
     *
     * Cambia solo lo que manda: su nombre, el propósito, el destino y las fechas. Mientras no esté
     * aprobada.
     *
     * POST /v1/expense_reports/{id}
     *
     * @param string $id
     * @param array{
     *     title?: string|null,
     *     purpose?: string|null,
     *     destination?: string|null,
     *     abroad?: bool,
     *     far?: bool,
     *     start_date?: string|null,
     *     end_date?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/update-expense-report
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar una comprobación
     *
     * Una que no esté aprobada y no tenga anticipos ni pagos (quítelos antes). No se puede
     * deshacer.
     *
     * DELETE /v1/expense_reports/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/delete-expense-report
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/expense_reports/' . rawurlencode($id), [], $options);
    }

    /**
     * Enviar a aprobar
     *
     * La persona termina: pasa a submitted (por aprobar). Contesta expense_report_invalid si un
     * gasto tiene un error (issues con level error).
     *
     * POST /v1/expense_reports/{id}/submit
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/submit-expense-report
     */
    public function submit(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports/' . rawurlencode($id) . '/submit', ['idempotent' => true], $options);
    }

    /**
     * Aprobar una comprobación
     *
     * Pasa a approved (por liquidar): sus facturas se deducen en los impuestos del emisor y entra
     * en las pólizas contra 107.01 Funcionarios y empleados. Con el saldo en cero se cierra sola;
     * si no, liquide con un reembolso o una devolución.
     *
     * POST /v1/expense_reports/{id}/approve
     *
     * @param string $id
     * @param array{note?: string|null} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/approve-expense-report
     */
    public function approve(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports/' . rawurlencode($id) . '/approve', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Devolver para corregir
     *
     * Regresa a la persona (rejected, «Devuelta») con una nota de qué corregir. La corrige y la
     * vuelve a enviar.
     *
     * POST /v1/expense_reports/{id}/return
     *
     * @param string $id
     * @param array{note: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/return-expense-report
     */
    public function sendBack(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports/' . rawurlencode($id) . '/return', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Reabrir una comprobación
     *
     * Una aprobada vuelve a abierta: sus facturas dejan de deducirse y sale de las pólizas. No si
     * ya se reportó en la nómina.
     *
     * POST /v1/expense_reports/{id}/reopen
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/reopen-expense-report
     */
    public function reopen(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports/' . rawurlencode($id) . '/reopen', ['idempotent' => true], $options);
    }

    /**
     * Agregar un gasto
     *
     * Con uuid, una factura recibida del emisor (GET /v1/sat_invoices): la fecha, el monto y el
     * proveedor salen de ella. Sin uuid, un gasto con su category, date y amount (un ticket, un
     * comprobante del extranjero). Contesta la comprobación revisada.
     *
     * POST /v1/expense_reports/{id}/items
     *
     * @param string $id
     * @param array{
     *     uuid?: string,
     *     category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros',
     *     date?: string,
     *     description?: string|null,
     *     amount?: float|int,
     *     foreign_amount?: float|int|null,
     *     foreign_currency?: string|null,
     *     people?: int,
     *     payment?: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null,
     *     receipt?: 'cfdi'|'extranjero'|'ticket'|'ninguno',
     *     note?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/create-expense-item
     */
    public function createItem(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports/' . rawurlencode($id) . '/items', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Actualizar un gasto
     *
     * Cambia solo lo que manda. Al revisarla, rejected: true con reject_reason rechaza el gasto
     * (no se paga ni se deduce) y false lo vuelve a incluir.
     *
     * POST /v1/expense_reports/{id}/items/{item}
     *
     * @param string $id
     * @param string $item
     * @param array{
     *     category?: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros',
     *     date?: string,
     *     description?: string|null,
     *     amount?: float|int,
     *     foreign_amount?: float|int|null,
     *     foreign_currency?: string|null,
     *     people?: int,
     *     payment?: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null,
     *     receipt?: 'cfdi'|'extranjero'|'ticket'|'ninguno',
     *     note?: string|null,
     *     rejected?: bool,
     *     reject_reason?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/update-expense-item
     */
    public function updateItem(string $id, string $item, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports/' . rawurlencode($id) . '/items/' . rawurlencode($item), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar un gasto
     *
     * Lo quita de la comprobación mientras no esté aprobada. Contesta la comprobación.
     *
     * DELETE /v1/expense_reports/{id}/items/{item}
     *
     * @param string $id
     * @param string $item
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/delete-expense-item
     */
    public function deleteItem(string $id, string $item, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/expense_reports/' . rawurlencode($id) . '/items/' . rawurlencode($item), [], $options);
    }

    /**
     * Registrar dinero dado o devuelto
     *
     * Un anticipo (antes de aprobarla), un reembolso o una devolución (ya aprobada). Con method
     * nomina va en el siguiente recibo de nómina del empleado. Con el saldo en cero, una aprobada
     * se cierra.
     *
     * POST /v1/expense_reports/{id}/movements
     *
     * @param string $id
     * @param array{
     *     kind: 'anticipo'|'reembolso'|'devolucion',
     *     amount: float|int,
     *     date: string,
     *     method?: 'transferencia'|'efectivo'|'tarjeta'|'nomina',
     *     reference?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/create-expense-movement
     */
    public function createMovement(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/expense_reports/' . rawurlencode($id) . '/movements', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Deshacer un movimiento
     *
     * Lo quita (una cerrada vuelve a por liquidar). No uno que ya se pagó en la nómina.
     *
     * DELETE /v1/expense_reports/{id}/movements/{movement}
     *
     * @param string $id
     * @param string $movement
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'expense_report',
     *     issuer: string,
     *     number: int,
     *     label: string,
     *     person: string,
     *     person_name: string,
     *     kind: 'viaje'|'gastos',
     *     title: string,
     *     purpose: string|null,
     *     destination: string|null,
     *     abroad: bool,
     *     far: bool,
     *     start_date: string|null,
     *     end_date: string|null,
     *     status: 'draft'|'submitted'|'rejected'|'approved'|'closed',
     *     due_date: string|null,
     *     submitted_at: string|null,
     *     decided_at: string|null,
     *     decision_note: string|null,
     *     closed_at: string|null,
     *     in_payroll: bool,
     *     spent: float|int,
     *     rejected: float|int,
     *     proven: float|int,
     *     deductible: float|int,
     *     non_deductible: float|int,
     *     advances: float|int,
     *     reimbursed: float|int,
     *     returned: float|int,
     *     balance: float|int,
     *     ready: bool,
     *     issues: list<array{level: 'error'|'warning'|'policy'|'info', code: string, message: string}>,
     *     payroll: array{exempt: float|int, taxed: float|int, adjustment: float|int, net: float|int}|null,
     *     items: list<array{id: string, object: 'expense_item', date: string, category: 'hospedaje'|'alimentos'|'avion'|'transporte'|'auto'|'combustible'|'comidas'|'papeleria'|'mensajeria'|'software'|'otros', description: string|null, amount: float|int, foreign_amount: float|int|null, foreign_currency: string|null, people: int, payment: 'tarjeta_empresa'|'tarjeta_propia'|'efectivo'|'transferencia'|'otro'|null, receipt: 'cfdi'|'extranjero'|'ticket'|'ninguno', uuid: string|null, note: string|null, rejected: bool, reject_reason: string|null, deductible: float|int, non_deductible: float|int, over_policy: bool, issues: list<array<string, mixed>>, created_at: string|null}>,
     *     movements: list<array{id: string, object: 'expense_movement', kind: 'anticipo'|'reembolso'|'devolucion', amount: float|int, date: string, method: 'transferencia'|'efectivo'|'tarjeta'|'nomina', reference: string|null, in_payroll: bool, created_at: string|null}>,
     *     created_at: string|null,
     *     updated_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/viaticos-y-gastos/delete-expense-movement
     */
    public function deleteMovement(string $id, string $movement, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/expense_reports/' . rawurlencode($id) . '/movements/' . rawurlencode($movement), [], $options);
    }
}
