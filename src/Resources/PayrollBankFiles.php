<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollBankFiles.
 */
final class PayrollBankFiles
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Archivo para pagar la nómina en el banco
     *
     * El archivo de dispersión que paga el neto de cada empleado desde el portal de su banco: BBVA
     * (Net Cash), Banamex (BancaNet, layout D), Banorte (Banorte en su Empresa), Santander
     * (Enlace) o un CSV de SPEI para cualquier banco. Toma los recibos de nómina timbrados (y no
     * cancelados) con esa fecha de pago, los suma por empleado y le paga a la CLABE de su ficha
     * (clabe en el empleado): a la misma institución por cuenta, a otra por SPEI. No cobra ni
     * mueve dinero: usted lo sube al banco y lo autoriza ahí. Quien no se puede pagar (sin CLABE,
     * otro banco en Santander) va en excluded con su razón. Suba el primero como prueba: cada
     * portal lo valida antes de cargar nada.
     *
     * POST /v1/payroll_bank_files
     *
     * @param array{
     *     issuer?: string,
     *     payment_date: string,
     *     layout?: 'bbva'|'banamex'|'banorte'|'santander'|'spei',
     *     account?: string,
     *     sequence?: int,
     *     client_number?: string,
     *     issuer_number?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_bank_file',
     *     livemode: bool,
     *     issuer: string,
     *     layout: 'bbva'|'banamex'|'banorte'|'santander'|'spei',
     *     payment_date: string,
     *     account: string|null,
     *     file_name: string,
     *     content_type: 'text/plain'|'text/csv',
     *     content: string,
     *     content_base64: string,
     *     total: float|int,
     *     count: int,
     *     payments: list<array{employee: string|null, number: string|null, name: string, tax_id: string, amount: float|int, clabe: string, spei: bool, receipts: list<string>}>,
     *     excluded: list<array{employee: string|null, number: string|null, name: string, tax_id: string, amount: float|int, reason: string}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-payroll-bank-file
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_bank_files', ['body' => $params, 'idempotent' => true], $options);
    }
}
