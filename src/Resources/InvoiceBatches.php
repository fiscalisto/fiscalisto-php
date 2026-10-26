<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Lotes: $fiscalisto->invoiceBatches.
 */
final class InvoiceBatches
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Timbrar un lote de facturas
     *
     * Hasta 1,000 facturas de ingreso de un emisor, timbradas en segundo plano. Se revisan todas
     * antes de empezar: si una no pasa, no se timbra ninguna. Responde 202; escuche
     * invoice_batch.completed o consulte el lote.
     *
     * POST /v1/invoice_batches
     *
     * @param array{
     *     issuer?: string,
     *     name?: string,
     *     invoices: list<array{issuer?: string, customer: string|array{tax_id: string, legal_name: string, tax_system: string, zip: string, email?: string|null, foreign?: array<string, mixed>, ieps_taxpayer?: bool}, items: list<array{product?: string, description?: string, product_key?: string, unit_key?: string, unit_name?: string|null, sku?: string|null, quantity?: float|int, unit_price?: float|int, discount?: float|int, taxability?: '01'|'02'|'03'|'04'|'05'|'06'|'07'|'08', iva?: '0'|'0.16'|'0.08'|'exento', ieps?: float|int, ieps_factor?: 'Tasa'|'Cuota', ieps_units?: float|int, iva_retention?: float|int, isr_retention?: float|int, predial?: list<string>, pedimentos?: list<string>, third_party?: array<string, mixed>, iedu?: array<string, mixed>, used_vehicle?: array<string, mixed>, addenda?: array<string, mixed>}>, type?: 'I'|'T', carta_porte?: array{modes?: list<'01'|'02'|'03'|'04'>, international?: array<string, mixed>, istmo?: array<string, mixed>, reverse_logistics?: bool, origin: array<string, mixed>, destinations: list<array<string, mixed>>, goods: list<array<string, mixed>>, vehicle?: array<string, mixed>, sea?: array<string, mixed>, air?: array<string, mixed>, rail?: array<string, mixed>, drivers: list<array<string, mixed>>, figures?: list<array<string, mixed>>}, ine?: array{process: 'Ordinario'|'Precampaña'|'Campaña', committee?: 'Ejecutivo Nacional'|'Ejecutivo Estatal'|'Directivo Estatal', accounting_id?: string, entities?: list<array<string, mixed>>}, leyendas?: list<array{text: string, disposition?: string, norm?: string}>, donation?: array{in_kind?: bool, deducted?: bool}, local_taxes?: list<array{retention: bool, name: string, rate: float|int, amount: float|int}>, export?: '01'|'02'|'03'|'04', comercio_exterior?: array{motive?: '05', owners?: list<array<string, mixed>>, incoterm?: string, certificate?: string, usd_rate: float|int, issuer_curp?: string, issuer_address?: array<string, mixed>, receiver_address?: array<string, mixed>, recipient?: array<string, mixed>, goods: list<array<string, mixed>>, notes?: string}, global?: array{periodicity: string, months: string, year: int}, use?: string, payment_form?: string, payment_method?: 'PUE'|'PPD', paid_later?: bool, currency?: string, series?: string, notes?: string, pdf_language?: 'es'|'en'|'bi', addenda?: array{type: 'walmart'|'soriana'|'liverpool'|'homedepot'|'chedraui'|'generic', values: array<string, mixed>, customer?: array<string, mixed>}, related?: array{relationship: string, uuids: list<string>}, exchange_rate?: float|int, folio?: int, continue_sequence?: bool, date?: string, send_email?: bool, email_cc?: string|null, metadata?: array<string, mixed>, reference?: string}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'invoice_batch',
     *     issuer: string,
     *     name: string,
     *     status: 'processing'|'completed',
     *     total: int,
     *     stamped: int,
     *     failed: int,
     *     processing?: int,
     *     created_at: string|null,
     *     completed_at: string|null,
     *     invoices?: list<array{index: int, reference: string|null, status: 'processing'|'valid'|'failed', invoice: string|null, uuid: string|null, total: float|int, error: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/lotes/create-invoice-batch
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/invoice_batches', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar lotes
     *
     * Los lotes de facturas, los más recientes primero, con cuántas se timbraron y cuántas
     * fallaron.
     *
     * GET /v1/invoice_batches
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'invoice_batch', issuer: string, name: string, status: 'processing'|'completed', total: int, stamped: int, failed: int, processing?: int, created_at: string|null, completed_at: string|null, invoices?: list<array<string, mixed>>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/lotes/list-invoice-batches
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/invoice_batches', $params, $options);
    }

    /**
     * Ver un lote
     *
     * Con cada factura: su estado, su id y su error.
     *
     * GET /v1/invoice_batches/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'invoice_batch',
     *     issuer: string,
     *     name: string,
     *     status: 'processing'|'completed',
     *     total: int,
     *     stamped: int,
     *     failed: int,
     *     processing?: int,
     *     created_at: string|null,
     *     completed_at: string|null,
     *     invoices?: list<array{index: int, reference: string|null, status: 'processing'|'valid'|'failed', invoice: string|null, uuid: string|null, total: float|int, error: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/lotes/get-invoice-batch
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/invoice_batches/' . rawurlencode($id), [], $options);
    }
}
