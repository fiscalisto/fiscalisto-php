<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto;

/**
 * Cada recurso de la API. Úselo por medio de Fiscalisto.
 */
abstract class FiscalistoApi extends Core
{
    /** Cuenta. */
    public readonly Resources\Account $account;

    /** Cuenta. */
    public readonly Resources\TestData $testData;

    /** Entornos de prueba. */
    public readonly Resources\Sandboxes $sandboxes;

    /** Entornos de prueba. */
    public readonly Resources\TestClocks $testClocks;

    /** Cuenta. */
    public readonly Resources\Balance $balance;

    /** Emisores. */
    public readonly Resources\Issuers $issuers;

    /** Facturas. */
    public readonly Resources\Invoices $invoices;

    /** Cuentas por cobrar. */
    public readonly Resources\Receivables $receivables;

    /** Conciliación bancaria. */
    public readonly Resources\BankTransactions $bankTransactions;

    /** Pagos y notas de crédito. */
    public readonly Resources\Payments $payments;

    /** Pagos y notas de crédito. */
    public readonly Resources\CreditNotes $creditNotes;

    /** Anticipos. */
    public readonly Resources\Advances $advances;

    /** Retenciones. */
    public readonly Resources\Retentions $retentions;

    /** Nómina. */
    public readonly Resources\Employees $employees;

    /** Nómina. */
    public readonly Resources\PayrollReceipts $payrollReceipts;

    /** Nómina. */
    public readonly Resources\PayrollBatches $payrollBatches;

    /** Lotes. */
    public readonly Resources\InvoiceBatches $invoiceBatches;

    /** Clientes. */
    public readonly Resources\TaxIds $taxIds;

    /** Sucursales. */
    public readonly Resources\Branches $branches;

    /** Clientes. */
    public readonly Resources\Customers $customers;

    /** Clientes. */
    public readonly Resources\CustomerDataRequests $customerDataRequests;

    /** Productos. */
    public readonly Resources\Products $products;

    /** Cumplimiento SAT. */
    public readonly Resources\SatMailboxMessages $satMailboxMessages;

    /** Cumplimiento SAT. */
    public readonly Resources\SatFindings $satFindings;

    /** Inventario. */
    public readonly Resources\Warehouses $warehouses;

    /** Inventario. */
    public readonly Resources\StockMovements $stockMovements;

    /** Inventario. */
    public readonly Resources\StockAdjustments $stockAdjustments;

    /** Catálogos del SAT. */
    public readonly Resources\SatCatalogs $satCatalogs;

    /** Listas del SAT. */
    public readonly Resources\SatLists $satLists;

    /** Descargas del SAT. */
    public readonly Resources\SatDownloads $satDownloads;

    /** Descargas del SAT. */
    public readonly Resources\SatInvoices $satInvoices;

    /** Declaraciones del SAT. */
    public readonly Resources\SatDeclarations $satDeclarations;

    /** Autofactura. */
    public readonly Resources\Tickets $tickets;

    /** Contabilidad. */
    public readonly Resources\Accounting $accounting;

    /** Tiendas en línea. */
    public readonly Resources\StoreConnections $storeConnections;

    /** Facturas recurrentes. */
    public readonly Resources\RecurringInvoices $recurringInvoices;

    /** Cotizaciones. */
    public readonly Resources\Quotes $quotes;

    /** Webhooks. */
    public readonly Resources\WebhookEndpoints $webhookEndpoints;

    /** Eventos. */
    public readonly Resources\Events $events;

    /**
     * @param string|null $apiKey Su llave fk_test_… o fk_live_…; sin ella, la variable FISCALISTO_API_KEY.
     * @param array{base_url?: string, max_retries?: int, timeout?: float|int, transport?: callable, sleep?: callable} $options
     */
    public function __construct(?string $apiKey = null, array $options = [])
    {
        parent::__construct($apiKey, $options);
        $this->account = new Resources\Account($this);
        $this->testData = new Resources\TestData($this);
        $this->sandboxes = new Resources\Sandboxes($this);
        $this->testClocks = new Resources\TestClocks($this);
        $this->balance = new Resources\Balance($this);
        $this->issuers = new Resources\Issuers($this);
        $this->invoices = new Resources\Invoices($this);
        $this->receivables = new Resources\Receivables($this);
        $this->bankTransactions = new Resources\BankTransactions($this);
        $this->payments = new Resources\Payments($this);
        $this->creditNotes = new Resources\CreditNotes($this);
        $this->advances = new Resources\Advances($this);
        $this->retentions = new Resources\Retentions($this);
        $this->employees = new Resources\Employees($this);
        $this->payrollReceipts = new Resources\PayrollReceipts($this);
        $this->payrollBatches = new Resources\PayrollBatches($this);
        $this->invoiceBatches = new Resources\InvoiceBatches($this);
        $this->taxIds = new Resources\TaxIds($this);
        $this->branches = new Resources\Branches($this);
        $this->customers = new Resources\Customers($this);
        $this->customerDataRequests = new Resources\CustomerDataRequests($this);
        $this->products = new Resources\Products($this);
        $this->satMailboxMessages = new Resources\SatMailboxMessages($this);
        $this->satFindings = new Resources\SatFindings($this);
        $this->warehouses = new Resources\Warehouses($this);
        $this->stockMovements = new Resources\StockMovements($this);
        $this->stockAdjustments = new Resources\StockAdjustments($this);
        $this->satCatalogs = new Resources\SatCatalogs($this);
        $this->satLists = new Resources\SatLists($this);
        $this->satDownloads = new Resources\SatDownloads($this);
        $this->satInvoices = new Resources\SatInvoices($this);
        $this->satDeclarations = new Resources\SatDeclarations($this);
        $this->tickets = new Resources\Tickets($this);
        $this->accounting = new Resources\Accounting($this);
        $this->storeConnections = new Resources\StoreConnections($this);
        $this->recurringInvoices = new Resources\RecurringInvoices($this);
        $this->quotes = new Resources\Quotes($this);
        $this->webhookEndpoints = new Resources\WebhookEndpoints($this);
        $this->events = new Resources\Events($this);
    }
}
