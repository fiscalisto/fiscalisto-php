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

    /** Cuenta. */
    public readonly Resources\Balance $balance;

    /** Emisores. */
    public readonly Resources\Issuers $issuers;

    /** Facturas. */
    public readonly Resources\Invoices $invoices;

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

    /** Lotes. */
    public readonly Resources\InvoiceBatches $invoiceBatches;

    /** Clientes. */
    public readonly Resources\TaxIds $taxIds;

    /** Clientes. */
    public readonly Resources\Customers $customers;

    /** Clientes. */
    public readonly Resources\CustomerDataRequests $customerDataRequests;

    /** Productos. */
    public readonly Resources\Products $products;

    /** Catálogos del SAT. */
    public readonly Resources\SatCatalogs $satCatalogs;

    /** Listas del SAT. */
    public readonly Resources\SatLists $satLists;

    /** Descargas del SAT. */
    public readonly Resources\SatDownloads $satDownloads;

    /** Descargas del SAT. */
    public readonly Resources\SatInvoices $satInvoices;

    /** Autofactura. */
    public readonly Resources\Tickets $tickets;

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
        $this->balance = new Resources\Balance($this);
        $this->issuers = new Resources\Issuers($this);
        $this->invoices = new Resources\Invoices($this);
        $this->payments = new Resources\Payments($this);
        $this->creditNotes = new Resources\CreditNotes($this);
        $this->advances = new Resources\Advances($this);
        $this->retentions = new Resources\Retentions($this);
        $this->employees = new Resources\Employees($this);
        $this->payrollReceipts = new Resources\PayrollReceipts($this);
        $this->invoiceBatches = new Resources\InvoiceBatches($this);
        $this->taxIds = new Resources\TaxIds($this);
        $this->customers = new Resources\Customers($this);
        $this->customerDataRequests = new Resources\CustomerDataRequests($this);
        $this->products = new Resources\Products($this);
        $this->satCatalogs = new Resources\SatCatalogs($this);
        $this->satLists = new Resources\SatLists($this);
        $this->satDownloads = new Resources\SatDownloads($this);
        $this->satInvoices = new Resources\SatInvoices($this);
        $this->tickets = new Resources\Tickets($this);
        $this->webhookEndpoints = new Resources\WebhookEndpoints($this);
        $this->events = new Resources\Events($this);
    }
}
