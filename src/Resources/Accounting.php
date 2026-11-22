<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->accounting.
 */
final class Accounting
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar las pólizas de un mes
     *
     * Las pólizas de diario del mes, con sus cuentas y código agrupador del SAT: una por cada CFDI
     * de ingreso o egreso vigente, emitido o recibido (los recibidos con la categoría de su
     * gasto); una por cada pago de un complemento; una por cada recibo de nómina; una con la
     * depreciación de los activos fijos; una por cada venta o baja de un activo, y las capturadas
     * a mano (POST /v1/accounting/manual_entries) con las reversiones de sus provisiones. Un PUE
     * se registra cobrado o pagado según su forma de pago. En pesos; un CFDI en otra moneda sin
     * tipo de cambio no se registra. No incluye movimientos de banco sin CFDI.
     *
     * GET /v1/accounting/journal_entries
     *
     * @param array{month: string, limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'journal_entry', issuer: string, type: 'invoice'|'payment_received'|'payment_made'|'payroll'|'employee_expenses'|'depreciation'|'manual'|'asset_disposal'|'bank_identification'|'foreign_supplier_operations', manual_entry: string|null, date: string, description: string, invoice: string|null, uuid: string|null, tax_id: string|null, total: float|int, currency: string, exchange_rate: float|int|null, edited: bool, lines: list<array<string, mixed>>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-journal-entries
     */
    public function journalEntries(array $params, array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/accounting/journal_entries', $params, $options);
    }

    /**
     * Ver la balanza de comprobación
     *
     * Saldo inicial, cargos, abonos y saldo final de cada cuenta en el mes. Los saldos iniciales
     * se acumulan desde el primer CFDI, o desde los saldos iniciales capturados en la app (las de
     * resultados, desde enero), y los resultados de cada año anterior se cierran a capital.
     *
     * GET /v1/accounting/trial_balance
     *
     * @param array{month: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'trial_balance',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     journal_entries: int,
     *     accounts: list<array{object: 'ledger_account', number: string, name: string, grouping_code: string, nature: 'debit'|'credit', opening_balance: float|int, debit: float|int, credit: float|int, closing_balance: float|int}>,
     *     totals: array{debit: float|int, credit: float|int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-trial-balance
     */
    public function trialBalance(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/trial_balance', ['query' => $params], $options);
    }

    /**
     * Ver el auxiliar de cuentas
     *
     * El libro mayor de un periodo de hasta 12 meses: el saldo inicial de cada cuenta, cada cargo
     * y abono con su póliza (journal_entry, el mismo id de journal_entries), su CFDI y el saldo
     * que deja, y el saldo final. Solo las cuentas que se movieron, o la que pida con account
     * aunque no tenga movimientos. Una cuenta que no está en el catálogo contesta account_missing.
     *
     * GET /v1/accounting/general_ledger
     *
     * @param array{from_month: string, to_month?: string, account?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'general_ledger',
     *     livemode: bool,
     *     issuer: string,
     *     from_month: string,
     *     to_month: string,
     *     accounts: list<array{object: 'ledger_account', number: string, name: string, grouping_code: string, nature: 'debit'|'credit', opening_balance: float|int, debit: float|int, credit: float|int, closing_balance: float|int, movements: list<array<string, mixed>>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-general-ledger
     */
    public function generalLedger(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/general_ledger', ['query' => $params], $options);
    }

    /**
     * Ver los estados financieros
     *
     * El estado de resultados (del mes y del año hasta ese mes) y el balance general al cierre del
     * mes, leídos de la misma balanza, así que siempre suman las mismas pólizas.
     *
     * GET /v1/accounting/financial_statements
     *
     * @param array{month: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'financial_statements',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     income_statement: array{month: array<string, mixed>, year_to_date: array<string, mixed>},
     *     balance_sheet: array{assets: array<string, mixed>, liabilities: array<string, mixed>, equity: array<string, mixed>, net_income_year_to_date: float|int, liabilities_and_equity: float|int, difference: float|int},
     *     journal_entries: int,
     *     opening_balances_date: string|null,
     *     missing_invoices: int,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-financial-statements
     */
    public function financialStatements(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/financial_statements', ['query' => $params], $options);
    }

    /**
     * Ver el estado de flujos de efectivo
     *
     * El estado de flujos de efectivo (NIF B-2, método indirecto) del mes o de enero al mes: la
     * utilidad, la depreciación y amortización que se suman, el cambio en capital de trabajo, y
     * las actividades de inversión y de financiamiento, hasta el efectivo al cierre. Cada cuenta
     * va a su actividad por su código agrupador; difference es 0 cuando la balanza cuadra. Como
     * Estados financieros › Flujo de efectivo en la app.
     *
     * GET /v1/accounting/cash_flow
     *
     * @param array{month: string, period?: 'month'|'year_to_date', issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cash_flow',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     period: 'month'|'year_to_date',
     *     net_income: float|int,
     *     operating: array{non_cash: list<array<string, mixed>>, working_capital: list<array<string, mixed>>, total: float|int},
     *     investing: array{lines: list<array<string, mixed>>, total: float|int},
     *     financing: array{lines: list<array<string, mixed>>, total: float|int},
     *     net_change: float|int,
     *     cash_beginning: float|int,
     *     cash_end: float|int,
     *     difference: float|int,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-cash-flow
     */
    public function cashFlow(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/cash_flow', ['query' => $params], $options);
    }

    /**
     * Ver el estado de cambios en el capital contable
     *
     * El estado de cambios en el capital contable (NIF B-4) de enero al mes: cada cuenta de
     * capital del 1 de enero al cierre, con sus aportaciones, retiros, dividendos y traspasos, y
     * el resultado del ejercicio. Como Estados financieros › Capital contable en la app.
     *
     * GET /v1/accounting/equity_changes
     *
     * @param array{month: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'equity_changes',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     accounts: list<array{grouping_code: string, name: string, beginning: float|int, movements: float|int, ending: float|int}>,
     *     net_income: float|int,
     *     beginning: float|int,
     *     movements: float|int,
     *     ending: float|int,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-equity-changes
     */
    public function equityChanges(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/equity_changes', ['query' => $params], $options);
    }

    /**
     * Comparar los estados financieros con otro mes
     *
     * El estado de resultados (del mes y de enero al mes) y el balance general junto a los del
     * mismo mes del año anterior (compare_to=previous_year, por omisión) o del mes anterior
     * (previous_month), con la variación y su porcentaje por grupo de cuentas. Como Estados
     * financieros › Comparativo en la app.
     *
     * GET /v1/accounting/comparative_statements
     *
     * @param array{
     *     month: string,
     *     compare_to?: 'previous_year'|'previous_month',
     *     issuer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'comparative_statements',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     compared_to: string,
     *     income_statement: array{month: array<string, mixed>, year_to_date: array<string, mixed>},
     *     balance_sheet: list<array{key: 'assets'|'liabilities'|'equity', name: string, lines: list<array<string, mixed>>, total: array<string, mixed>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-comparative-statements
     */
    public function comparativeStatements(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/comparative_statements', ['query' => $params], $options);
    }

    /**
     * Ver las razones financieras
     *
     * Liquidez, prueba ácida, endeudamiento, apalancamiento, márgenes, rendimiento sobre capital y
     * sobre activo, y días de cobro, de pago y de inventario al cierre del mes, con las cifras de
     * que salen. Rentabilidad y rotación usan los resultados de enero al mes. Como Estados
     * financieros › Razones financieras en la app.
     *
     * GET /v1/accounting/financial_ratios
     *
     * @param array{month: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'financial_ratios',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     ratios: list<array{key: 'liquidez'|'prueba_acida'|'endeudamiento'|'apalancamiento'|'margen_bruto'|'margen_operacion'|'margen_neto'|'rendimiento_capital'|'rendimiento_activo'|'dias_cobro'|'dias_pago'|'dias_inventario', name: string, value: float|int|null, unit: 'times'|'percent'|'days', description: string}>,
     *     inputs: array{current_assets: float|int, current_liabilities: float|int, inventory: float|int, receivables: float|int, payables: float|int, total_assets: float|int, total_liabilities: float|int, equity: float|int, revenue_year_to_date: float|int, income_before_taxes_year_to_date: float|int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-financial-ratios
     */
    public function financialRatios(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/financial_ratios', ['query' => $params], $options);
    }

    /**
     * Cruzar lo declarado con lo facturado
     *
     * Cada mes ya vencido del año: el IVA trasladado, acreditable y retenido y los ingresos para
     * ISR que el emisor declaró (de GET /v1/sat_declarations, después de POST
     * /v1/sat_declarations/refresh) contra lo que dicen sus CFDI. Hasta $2 de diferencia es
     * redondeo (las declaraciones van en pesos enteros). Una cifra que la declaración no trae en
     * un renglón reconocible es unreadable con declared null, nunca 0. También el IVA a favor y el
     * régimen con que factura. Gratis: no consulta al SAT.
     *
     * GET /v1/accounting/cross_checks
     *
     * @param array{year?: int, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cross_checks',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     months: list<array{month: string, status: 'matches'|'differs'|'not_filed'|'unreadable', checks: list<array<string, mixed>>}>,
     *     vat_balance_in_favor: array{periods: list<array<string, mixed>>, total: float|int, credited: float|int, remaining: float|int},
     *     tax_regimes: array{registered: list<string>, invoiced: list<array<string, mixed>>},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-cross-checks
     */
    public function crossChecks(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/cross_checks', ['query' => $params], $options);
    }

    /**
     * Ver el IVA a favor y preparar su devolución
     *
     * El IVA a favor de cada mes de los últimos cinco años (de las declaraciones leídas con POST
     * /v1/sat_declarations/refresh o, sin ellas, de sus CFDI, con estimated en true), cuánto se
     * acreditó después (del saldo más antiguo primero), cuánto queda, qué está en devolución y
     * cuándo prescribe. Con `month`, la revisión de ese mes antes de pedirlo en el SAT:
     * declaración, cruce con CFDI, DIOT, opinión de cumplimiento, Buzón Tributario, e.firma,
     * listas del SAT, CFDI de proveedores con hallazgos y CLABE, con el monto a pedir. No presenta
     * nada en el SAT. Gratis.
     *
     * GET /v1/accounting/vat_refund
     *
     * @param array{month?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'vat_refund',
     *     livemode: bool,
     *     issuer: string,
     *     available: float|int,
     *     in_refund: float|int,
     *     refunded: float|int,
     *     estimated: bool,
     *     balances: list<array{month: string, source: 'declaration'|'cfdi', amount: float|int, operation_number: string|null, credited: float|int, credited_in: list<array<string, mixed>>, available: float|int, status: 'available'|'credited'|'in_refund'|'refunded'|'denied'|'prescribed', prescribes_on: string}>,
     *     review: array{month: string, amount_to_request: float|int, remainder: bool, ready: bool, checks: list<array<string, mixed>>, suppliers: array<string, mixed>, customers: array<string, mixed>}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-vat-refund
     */
    public function vatRefund(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/vat_refund', ['query' => $params], $options);
    }

    /**
     * Ver los CFDI de una cifra del cruce
     *
     * Los CFDI que forman lo facturado (invoiced) de una cifra del cruce de un mes, con los mismos
     * cálculos de Impuestos: cada factura PUE o nota de crédito en su mes y cada factura PPD por
     * lo que se pagó en el mes, con lo que aporta. La suma de cfdi más adjustment es invoiced.
     * Sirve para ver por qué una cifra differs: con una diferencia, explanation trae los CFDI cuya
     * combinación la suma (cancelados después, PPD sin cobro en el mes, de los días vecinos de
     * otro mes, notas de crédito, cobros de PPD, repetidos o no declarados) y las posibles causas.
     * Gratis: no consulta al SAT.
     *
     * GET /v1/accounting/cross_checks/cfdi
     *
     * @param array{
     *     month: string,
     *     key: 'vat_charged'|'vat_creditable'|'vat_withheld'|'isr_income'|'isr_withheld_salaries'|'isr_withheld_suppliers'|'vat_withheld_suppliers',
     *     issuer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cross_check_cfdi',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     key: 'vat_charged'|'vat_creditable'|'vat_withheld'|'isr_income'|'isr_withheld_salaries'|'isr_withheld_suppliers'|'vat_withheld_suppliers',
     *     status: 'matches'|'differs'|'not_filed'|'unreadable',
     *     declared: float|int|null,
     *     declared_without_cfdi: float|int,
     *     invoiced: float|int,
     *     difference: float|int|null,
     *     operation_number: string|null,
     *     cfdi: list<array{uuid: string|null, type: 'invoice'|'credit_note'|'payment'|'withholding_certificate', date: string|null, tax_id: string|null, name: string|null, amount: float|int}>,
     *     adjustment: float|int,
     *     explanation: array{difference: float|int, exact: array<string, mixed>|null, ambiguous: bool, causes: list<array<string, mixed>>}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-cross-check-cfdi
     */
    public function crossCheckCfdi(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/cross_checks/cfdi', ['query' => $params], $options);
    }

    /**
     * Ver el catálogo de cuentas
     *
     * Las cuentas que usan las pólizas, con su código agrupador del SAT.
     *
     * GET /v1/accounting/accounts
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{object: 'ledger_account', number: string, name: string, grouping_code: string, nature: 'debit'|'credit'}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/list-ledger-accounts
     */
    public function accounts(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/accounts', ['query' => $params], $options);
    }

    /**
     * Agregar una cuenta al catálogo
     *
     * Una cuenta propia del emisor, para sus pólizas a mano: su número (que no se repite), su
     * nombre y una subcuenta del código agrupador del SAT. Entra al catálogo de la contabilidad
     * electrónica.
     *
     * POST /v1/accounting/accounts
     *
     * @param array{number: string, name: string, grouping_code: string, issuer?: string} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'ledger_account',
     *     number: string,
     *     name: string,
     *     grouping_code: string,
     *     nature: 'debit'|'credit',
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-ledger-account
     */
    public function createAccount(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/accounts', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver los estados financieros consolidados
     *
     * El estado de resultados y el balance general de varios RFC del espacio del emisor sumados
     * cuenta por cuenta (comparten el catálogo), menos las eliminaciones del mes (POST
     * /v1/accounting/consolidation_eliminations), con la hoja de consolidación (el saldo de cada
     * cuenta en cada RFC, lo eliminado y el consolidado) y lo que los RFC se facturaron entre
     * ellos sin impuestos. Los libros de cada RFC no cambian. Un emisor con un solo RFC contesta
     * parameter_invalid en rfcs.
     *
     * GET /v1/accounting/consolidated_statements
     *
     * @param array{rfcs: string, month: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'consolidated_statements',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     rfcs: list<string>,
     *     income_statement: array{month: array<string, mixed>, year_to_date: array<string, mixed>},
     *     balance_sheet: array{assets: array<string, mixed>, liabilities: array<string, mixed>, equity: array<string, mixed>, net_income_year_to_date: float|int, liabilities_and_equity: float|int, difference: float|int},
     *     worksheet: list<array{number: string, name: string, grouping_code: string, by_rfc: array<string, mixed>, eliminations: float|int, balance: float|int}>,
     *     eliminations: list<array{id: string, livemode: bool, object: 'consolidation_elimination', issuer: string, month: string, description: string, rfcs: list<string>, lines: list<array<string, mixed>>, updated_at: string|null}>,
     *     intercompany: list<array{issuer_rfc: string, receiver_rfc: string, month_amount: float|int, year_to_date_amount: float|int, invoices: int}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-consolidated-statements
     */
    public function consolidatedStatements(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/consolidated_statements', ['query' => $params], $options);
    }

    /**
     * Descargar la contabilidad electrónica
     *
     * El ZIP del mes para el Buzón Tributario: el catálogo (CT) y la balanza (BN, o BC si es
     * complementaria), cada uno en su ZIP con el nombre que espera el SAT, en el formato 1.3 del
     * Anexo 24. Con journal_request, también las pólizas (PL), que se entregan cuando el SAT las
     * pide. Con month AAAA-13, la balanza de comprobación ajustada al cierre del ejercicio (regla
     * 2.8.1.6 RMF): solo la balanza, con los saldos finales de diciembre como saldos iniciales y,
     * con closing_entry, la póliza de cierre.
     *
     * GET /v1/accounting/electronic_accounting
     *
     * @param array{
     *     month: string,
     *     closing_entry?: 'true'|'false',
     *     type?: 'normal'|'complementary',
     *     modified_on?: string,
     *     journal_request?: 'AF'|'FC'|'DE'|'CO',
     *     order_number?: string,
     *     procedure_number?: string,
     *     issuer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-electronic-accounting
     */
    public function electronicAccounting(array $params, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/electronic_accounting', ['query' => $params, 'as' => 'bytes'], $options);
    }

    /**
     * Descargar toda la contabilidad de un periodo
     *
     * Un ZIP para llevar los libros a otro sistema, de from_month a to_month (hasta 24 meses): el
     * catálogo (1-catalogo, Excel con número, nombre, nivel, código agrupador y naturaleza), los
     * saldos iniciales al primer día de from_month en deudor y acreedor (2-saldos-iniciales), las
     * pólizas de todo el periodo para CONTPAQi Contabilidad (un TXT) y para Aspel COI (un Excel
     * por mes), la balanza de comprobación de cada mes (una hoja por mes) y, en
     * contabilidad-electronica, el catálogo (CT) y la balanza de cada mes (BN) en XML 1.3 del
     * Anexo 24. LEEME.txt dice el orden en que se importa. Son los mismos libros de
     * financial_statements y electronic_accounting.
     *
     * GET /v1/accounting/books_export
     *
     * @param array{from_month: string, to_month?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-books-export
     */
    public function booksExport(array $params, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/books_export', ['query' => $params, 'as' => 'bytes'], $options);
    }

    /**
     * Ver la DIOT de un mes
     *
     * Lo efectivamente pagado a cada proveedor en el mes (facturas PUE y complementos de pago
     * recibidos), con sus notas de crédito como devoluciones, por tipo de operación. Sale de las
     * facturas recibidas que trajo de las descargas del SAT. Desde enero de 2025 (formato 2025).
     *
     * GET /v1/accounting/diot
     *
     * @param array{month: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'diot',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     proportion: float|int,
     *     lines: list<array{tax_id: string, name: string|null, third_party_type: '15'|'04'|'05', operation_type: '85'|'87'|'02'|'03'|'06'|'07', paid: array<string, mixed>, returns: array<string, mixed>, blacklisted: bool}>,
     *     warnings: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-diot
     */
    public function diot(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/diot', ['query' => $params], $options);
    }

    /**
     * Descargar la DIOT para el SAT
     *
     * El TXT de carga masiva de la DIOT 2025: 54 campos separados por |, pesos enteros. Con
     * group_small_suppliers=true junta en una línea global a los proveedores chicos (regla 4.5.2
     * RMF). Un mes sin pagos a proveedores responde diot_empty: esa se presenta sin operaciones en
     * el portal del SAT.
     *
     * GET /v1/accounting/diot/file
     *
     * @param array{month: string, group_small_suppliers?: bool, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-diot-file
     */
    public function diotFile(array $params, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/diot/file', ['query' => $params, 'as' => 'text'], $options);
    }

    /**
     * Ver los clientes con IEPS desglosado
     *
     * La relación trimestral de los clientes a los que el emisor les trasladó el IEPS por separado
     * (artículo 19, fracción II, tercer párrafo de la Ley del IEPS): bebidas alcohólicas, bebidas
     * energetizantes, bebidas saborizadas y alimentos de alta densidad calórica, de sus facturas
     * de ingreso no canceladas. Público en general y extranjeros no van. Se presenta cada
     * trimestre en el MULTI-IEPS, Anexo 1 (regla 5.2.2 de la RMF 2026), en el mes siguiente al
     * trimestre.
     *
     * GET /v1/accounting/ieps_customers
     *
     * @param array{year: string, quarter?: '1'|'2'|'3'|'4', issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'ieps_customers',
     *     livemode: bool,
     *     issuer: string,
     *     year: int,
     *     quarters: list<array{quarter: int, due_month: string, customers: list<array<string, mixed>>, total: float|int}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-ieps-customers
     */
    public function iepsCustomers(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/ieps_customers', ['query' => $params], $options);
    }

    /**
     * Descargar los clientes con IEPS desglosado
     *
     * La relación de un trimestre en CSV (UTF-8): RFC, nombre, facturas e IEPS trasladado de cada
     * cliente, y el total; la misma que descarga la app en Impuestos.
     *
     * GET /v1/accounting/ieps_customers/file
     *
     * @param array{year: string, quarter: '1'|'2'|'3'|'4', issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-ieps-customers-file
     */
    public function iepsCustomersFile(array $params, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/ieps_customers/file', ['query' => $params, 'as' => 'text'], $options);
    }
}
