<?php

declare(strict_types=1);

namespace Fiscalisto;

/**
 * El SDK de la API de facturación de Fiscalisto.
 *
 * ```php
 * $fiscalisto = new \Fiscalisto\Fiscalisto(); // la llave viene de FISCALISTO_API_KEY
 * $factura = $fiscalisto->invoices->create([
 *     'customer' => ['tax_id' => 'ICV060329BY0', 'legal_name' => 'INMOBILIARIA CVA', 'tax_system' => '601', 'zip' => '33826'],
 *     'payment_form' => '03',
 *     'items' => [['description' => 'Consultoría', 'product_key' => '80101500', 'unit_price' => 1000]],
 * ]);
 * ```
 *
 * @see https://fiscalisto.com/docs/api
 */
final class Fiscalisto extends FiscalistoApi
{
    /** Verificar lo que llega a su endpoint: $fiscalisto->webhooks->verify(…). */
    public readonly Webhooks $webhooks;

    /**
     * @param string|null $apiKey Su llave fk_test_… o fk_live_…; sin ella, la variable FISCALISTO_API_KEY.
     * @param array{base_url?: string, max_retries?: int, timeout?: float|int, transport?: callable, sleep?: callable} $options
     */
    public function __construct(?string $apiKey = null, array $options = [])
    {
        parent::__construct($apiKey, $options);
        $this->webhooks = new Webhooks();
    }
}
