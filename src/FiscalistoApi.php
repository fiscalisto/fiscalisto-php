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

    /** Cuentas por cobrar. */
    public readonly Resources\Customers $customers;

    /** Flujo de efectivo. */
    public readonly Resources\CashForecast $cashForecast;

    /** Conciliación bancaria. */
    public readonly Resources\BankTransactions $bankTransactions;

    /** Tickets de compra. */
    public readonly Resources\PurchaseReceipts $purchaseReceipts;

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

    /** Nómina. */
    public readonly Resources\PayrollBankFiles $payrollBankFiles;

    /** Nómina. */
    public readonly Resources\ImssMovements $imssMovements;

    /** Nómina. */
    public readonly Resources\ImssFiles $imssFiles;

    /** Nómina. */
    public readonly Resources\EmployeeDeductions $employeeDeductions;

    /** Nómina. */
    public readonly Resources\VariableSalaries $variableSalaries;

    /** Nómina. */
    public readonly Resources\AnnualAdjustments $annualAdjustments;

    /** Nómina. */
    public readonly Resources\PayrollTaxes $payrollTaxes;

    /** Lotes. */
    public readonly Resources\InvoiceBatches $invoiceBatches;

    /** Clientes. */
    public readonly Resources\TaxIds $taxIds;

    /** Sucursales. */
    public readonly Resources\Branches $branches;

    /** Centros de costo. */
    public readonly Resources\CostCenters $costCenters;

    /** Listas de precios. */
    public readonly Resources\PriceLists $priceLists;

    /** Listas de precios. */
    public readonly Resources\CustomerGroups $customerGroups;

    /** Listas de precios. */
    public readonly Resources\Prices $prices;

    /** Asistencia. */
    public readonly Resources\Attendance $attendance;

    /** Viáticos y gastos. */
    public readonly Resources\ExpensePeople $expensePeople;

    /** Viáticos y gastos. */
    public readonly Resources\ExpenseReports $expenseReports;

    /** Viáticos y gastos. */
    public readonly Resources\ExpensePolicy $expensePolicy;

    /** Clientes. */
    public readonly Resources\CustomerDataRequests $customerDataRequests;

    /** Productos. */
    public readonly Resources\Products $products;

    /** Cumplimiento SAT. */
    public readonly Resources\SatMailboxMessages $satMailboxMessages;

    /** Cumplimiento SAT. */
    public readonly Resources\SatFindings $satFindings;

    /** Cumplimiento SAT. */
    public readonly Resources\SatFindingCounterparties $satFindingCounterparties;

    /** Cumplimiento SAT. */
    public readonly Resources\CompanyReport $companyReport;

    /** Cumplimiento SAT. */
    public readonly Resources\MaterialitySuppliers $materialitySuppliers;

    /** Cumplimiento SAT. */
    public readonly Resources\MaterialityInvoices $materialityInvoices;

    /** Cumplimiento SAT. */
    public readonly Resources\SatReviews $satReviews;

    /** Cumplimiento SAT. */
    public readonly Resources\SatRiskCheck $satRiskCheck;

    /** Cumplimiento SAT. */
    public readonly Resources\TaxDiscrepancy $taxDiscrepancy;

    /** Inventario. */
    public readonly Resources\Warehouses $warehouses;

    /** Inventario. */
    public readonly Resources\StockMovements $stockMovements;

    /** Inventario. */
    public readonly Resources\StockAdjustments $stockAdjustments;

    /** Inventario. */
    public readonly Resources\ProductionOrders $productionOrders;

    /** Catálogos del SAT. */
    public readonly Resources\SatCatalogs $satCatalogs;

    /** Listas del SAT. */
    public readonly Resources\SatLists $satLists;

    /** Verificar comprobantes. */
    public readonly Resources\CfdiVerifications $cfdiVerifications;

    /** Equipo. */
    public readonly Resources\Members $members;

    /** Equipo. */
    public readonly Resources\Invitations $invitations;

    /** Equipo. */
    public readonly Resources\Roles $roles;

    /** Equipo. */
    public readonly Resources\Permissions $permissions;

    /** Exportaciones. */
    public readonly Resources\Exports $exports;

    /** Descargas del SAT. */
    public readonly Resources\SatDownloads $satDownloads;

    /** Descargas del SAT. */
    public readonly Resources\SatInvoices $satInvoices;

    /** Descargas del SAT. */
    public readonly Resources\SatRetentions $satRetentions;

    /** Portal de proveedores. */
    public readonly Resources\PortalSuppliers $portalSuppliers;

    /** Portal de proveedores. */
    public readonly Resources\SupplierInvoices $supplierInvoices;

    /** Declaraciones del SAT. */
    public readonly Resources\SatDeclarations $satDeclarations;

    /** Declaraciones del SAT. */
    public readonly Resources\SatRefreshes $satRefreshes;

    /** Autofactura. */
    public readonly Resources\Tickets $tickets;

    /** Contabilidad. */
    public readonly Resources\Accounting $accounting;

    /** Contabilidad. */
    public readonly Resources\ManualEntries $manualEntries;

    /** Contabilidad. */
    public readonly Resources\OpeningBalances $openingBalances;

    /** Contabilidad. */
    public readonly Resources\FixedAssets $fixedAssets;

    /** Contabilidad. */
    public readonly Resources\ClosedPeriod $closedPeriod;

    /** Contabilidad. */
    public readonly Resources\FxRevaluations $fxRevaluations;

    /** Contabilidad. */
    public readonly Resources\CostOfSales $costOfSales;

    /** Contabilidad. */
    public readonly Resources\Budgets $budgets;

    /** Contabilidad. */
    public readonly Resources\InflationAdjustments $inflationAdjustments;

    /** Contabilidad. */
    public readonly Resources\InflationAccounts $inflationAccounts;

    /** Contabilidad. */
    public readonly Resources\DepreciationReconciliations $depreciationReconciliations;

    /** Contabilidad. */
    public readonly Resources\BookDepreciationRates $bookDepreciationRates;

    /** Contabilidad. */
    public readonly Resources\CostCenterResults $costCenterResults;

    /** Contabilidad. */
    public readonly Resources\PayrollProvisions $payrollProvisions;

    /** Contabilidad. */
    public readonly Resources\TaxDeterminations $taxDeterminations;

    /** Contabilidad. */
    public readonly Resources\LedgerBankAccounts $ledgerBankAccounts;

    /** Contabilidad. */
    public readonly Resources\BankMovements $bankMovements;

    /** Tiendas en línea. */
    public readonly Resources\StoreConnections $storeConnections;

    /** Facturas recurrentes. */
    public readonly Resources\RecurringInvoices $recurringInvoices;

    /** Cotizaciones. */
    public readonly Resources\Quotes $quotes;

    /** Pedidos. */
    public readonly Resources\SalesOrders $salesOrders;

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
        $this->customers = new Resources\Customers($this);
        $this->cashForecast = new Resources\CashForecast($this);
        $this->bankTransactions = new Resources\BankTransactions($this);
        $this->purchaseReceipts = new Resources\PurchaseReceipts($this);
        $this->payments = new Resources\Payments($this);
        $this->creditNotes = new Resources\CreditNotes($this);
        $this->advances = new Resources\Advances($this);
        $this->retentions = new Resources\Retentions($this);
        $this->employees = new Resources\Employees($this);
        $this->payrollReceipts = new Resources\PayrollReceipts($this);
        $this->payrollBatches = new Resources\PayrollBatches($this);
        $this->payrollBankFiles = new Resources\PayrollBankFiles($this);
        $this->imssMovements = new Resources\ImssMovements($this);
        $this->imssFiles = new Resources\ImssFiles($this);
        $this->employeeDeductions = new Resources\EmployeeDeductions($this);
        $this->variableSalaries = new Resources\VariableSalaries($this);
        $this->annualAdjustments = new Resources\AnnualAdjustments($this);
        $this->payrollTaxes = new Resources\PayrollTaxes($this);
        $this->invoiceBatches = new Resources\InvoiceBatches($this);
        $this->taxIds = new Resources\TaxIds($this);
        $this->branches = new Resources\Branches($this);
        $this->costCenters = new Resources\CostCenters($this);
        $this->priceLists = new Resources\PriceLists($this);
        $this->customerGroups = new Resources\CustomerGroups($this);
        $this->prices = new Resources\Prices($this);
        $this->attendance = new Resources\Attendance($this);
        $this->expensePeople = new Resources\ExpensePeople($this);
        $this->expenseReports = new Resources\ExpenseReports($this);
        $this->expensePolicy = new Resources\ExpensePolicy($this);
        $this->customerDataRequests = new Resources\CustomerDataRequests($this);
        $this->products = new Resources\Products($this);
        $this->satMailboxMessages = new Resources\SatMailboxMessages($this);
        $this->satFindings = new Resources\SatFindings($this);
        $this->satFindingCounterparties = new Resources\SatFindingCounterparties($this);
        $this->companyReport = new Resources\CompanyReport($this);
        $this->materialitySuppliers = new Resources\MaterialitySuppliers($this);
        $this->materialityInvoices = new Resources\MaterialityInvoices($this);
        $this->satReviews = new Resources\SatReviews($this);
        $this->satRiskCheck = new Resources\SatRiskCheck($this);
        $this->taxDiscrepancy = new Resources\TaxDiscrepancy($this);
        $this->warehouses = new Resources\Warehouses($this);
        $this->stockMovements = new Resources\StockMovements($this);
        $this->stockAdjustments = new Resources\StockAdjustments($this);
        $this->productionOrders = new Resources\ProductionOrders($this);
        $this->satCatalogs = new Resources\SatCatalogs($this);
        $this->satLists = new Resources\SatLists($this);
        $this->cfdiVerifications = new Resources\CfdiVerifications($this);
        $this->members = new Resources\Members($this);
        $this->invitations = new Resources\Invitations($this);
        $this->roles = new Resources\Roles($this);
        $this->permissions = new Resources\Permissions($this);
        $this->exports = new Resources\Exports($this);
        $this->satDownloads = new Resources\SatDownloads($this);
        $this->satInvoices = new Resources\SatInvoices($this);
        $this->satRetentions = new Resources\SatRetentions($this);
        $this->portalSuppliers = new Resources\PortalSuppliers($this);
        $this->supplierInvoices = new Resources\SupplierInvoices($this);
        $this->satDeclarations = new Resources\SatDeclarations($this);
        $this->satRefreshes = new Resources\SatRefreshes($this);
        $this->tickets = new Resources\Tickets($this);
        $this->accounting = new Resources\Accounting($this);
        $this->manualEntries = new Resources\ManualEntries($this);
        $this->openingBalances = new Resources\OpeningBalances($this);
        $this->fixedAssets = new Resources\FixedAssets($this);
        $this->closedPeriod = new Resources\ClosedPeriod($this);
        $this->fxRevaluations = new Resources\FxRevaluations($this);
        $this->costOfSales = new Resources\CostOfSales($this);
        $this->budgets = new Resources\Budgets($this);
        $this->inflationAdjustments = new Resources\InflationAdjustments($this);
        $this->inflationAccounts = new Resources\InflationAccounts($this);
        $this->depreciationReconciliations = new Resources\DepreciationReconciliations($this);
        $this->bookDepreciationRates = new Resources\BookDepreciationRates($this);
        $this->costCenterResults = new Resources\CostCenterResults($this);
        $this->payrollProvisions = new Resources\PayrollProvisions($this);
        $this->taxDeterminations = new Resources\TaxDeterminations($this);
        $this->ledgerBankAccounts = new Resources\LedgerBankAccounts($this);
        $this->bankMovements = new Resources\BankMovements($this);
        $this->storeConnections = new Resources\StoreConnections($this);
        $this->recurringInvoices = new Resources\RecurringInvoices($this);
        $this->quotes = new Resources\Quotes($this);
        $this->salesOrders = new Resources\SalesOrders($this);
        $this->webhookEndpoints = new Resources\WebhookEndpoints($this);
        $this->events = new Resources\Events($this);
    }
}
