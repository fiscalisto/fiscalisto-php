<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->taxDeterminations.
 */
final class TaxDeterminations
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver la determinación de impuestos de un mes
     *
     * El IVA cobrado y pagado del mes según sus pólizas (y el que le retuvieron sus clientes), el
     * IVA por pagar o a favor que resulta, el pago provisional de ISR que sugiere Impuestos y la
     * póliza de determinación, si ya se registró. Como Cierre del mes › Impuestos del mes en la
     * app.
     *
     * GET /v1/accounting/tax_determinations/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'tax_determination',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     vat_collected: float|int,
     *     vat_creditable: float|int,
     *     vat_withheld_by_customers: float|int,
     *     vat: float|int,
     *     ieps_collected: float|int,
     *     ieps_creditable: float|int,
     *     ieps: float|int,
     *     suggested_isr: float|int|null,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-tax-determination
     */
    public function get(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/tax_determinations/' . rawurlencode($month), ['query' => $params], $options);
    }

    /**
     * Registrar la determinación de impuestos de un mes
     *
     * Registra (o reemplaza) la póliza del último día del mes: IVA trasladado cobrado contra IVA
     * acreditable pagado y el IVA retenido por clientes, la diferencia a IVA por pagar o IVA a
     * favor, e isr a Pagos provisionales de ISR contra ISR por pagar. Al pagarlos, registre el
     * retiro del banco contra esas cuentas (POST /v1/accounting/bank_movements/{id}/post). Sin IVA
     * ni ISR contesta parameter_invalid en month; en un mes cerrado, period_closed.
     *
     * POST /v1/accounting/tax_determinations/{month}
     *
     * @param string $month
     * @param array{issuer?: string, isr: float|int} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'tax_determination',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     vat_collected: float|int,
     *     vat_creditable: float|int,
     *     vat_withheld_by_customers: float|int,
     *     vat: float|int,
     *     ieps_collected: float|int,
     *     ieps_creditable: float|int,
     *     ieps: float|int,
     *     suggested_isr: float|int|null,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/create-tax-determination
     */
    public function create(string $month, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/tax_determinations/' . rawurlencode($month), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Quitar la determinación de impuestos de un mes
     *
     * Quita la póliza de determinación del mes. En un mes cerrado contesta period_closed.
     *
     * DELETE /v1/accounting/tax_determinations/{month}
     *
     * @param string $month
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'tax_determination',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     date: string,
     *     vat_collected: float|int,
     *     vat_creditable: float|int,
     *     vat_withheld_by_customers: float|int,
     *     vat: float|int,
     *     ieps_collected: float|int,
     *     ieps_creditable: float|int,
     *     ieps: float|int,
     *     suggested_isr: float|int|null,
     *     manual_entry: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/delete-tax-determination
     */
    public function delete(string $month, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/accounting/tax_determinations/' . rawurlencode($month), ['query' => $params], $options);
    }
}
