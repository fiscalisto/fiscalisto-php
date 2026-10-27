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
     * gasto); una por cada pago de un complemento; una por cada recibo de nómina, y una con la
     * depreciación de los activos fijos. Un PUE se registra cobrado o pagado según su forma de
     * pago. En pesos; un CFDI en otra moneda sin tipo de cambio no se registra. No incluye
     * movimientos de banco sin CFDI ni provisiones.
     *
     * GET /v1/accounting/journal_entries
     *
     * @param array{month: string, limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'journal_entry', issuer: string, type: 'invoice'|'payment_received'|'payment_made'|'payroll'|'depreciation', date: string, description: string, invoice: string|null, uuid: string|null, tax_id: string|null, total: float|int, currency: string, exchange_rate: float|int|null, lines: list<array<string, mixed>>}>
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
     * Ver los CFDI de una cifra del cruce
     *
     * Los CFDI que forman lo facturado (invoiced) de una cifra del cruce de un mes, con los mismos
     * cálculos de Impuestos: cada factura PUE o nota de crédito en su mes y cada factura PPD por
     * lo que se pagó en el mes, con lo que aporta. La suma de cfdi más adjustment es invoiced.
     * Sirve para ver por qué una cifra differs. Gratis: no consulta al SAT.
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
     * Descargar la contabilidad electrónica
     *
     * El ZIP del mes para el Buzón Tributario: el catálogo (CT) y la balanza (BN, o BC si es
     * complementaria), cada uno en su ZIP con el nombre que espera el SAT, en el formato 1.3 del
     * Anexo 24. Con journal_request, también las pólizas (PL), que se entregan cuando el SAT las
     * pide.
     *
     * GET /v1/accounting/electronic_accounting
     *
     * @param array{
     *     month: string,
     *     type?: 'normal'|'complementary',
     *     modified_on?: string,
     *     journal_request?: 'AF'|'FC'|'DE'|'CO',
     *     order_number?: string,
     *     procedure_number?: string,
     *     issuer?: string,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string El XML.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-electronic-accounting
     */
    public function electronicAccounting(array $params, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/electronic_accounting', ['query' => $params, 'as' => 'text'], $options);
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
}
