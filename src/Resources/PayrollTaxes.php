<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollTaxes.
 */
final class PayrollTaxes
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Impuesto sobre nómina del mes
     *
     * El impuesto sobre nómina de cada estado: la suma de los recibos timbrados con fecha de pago
     * en el mes, por el estado donde trabaja cada empleado (ClaveEntFed), menos las percepciones
     * de excluded_perception_types, por la tasa del estado y sus sobretasas. Se declara y paga en
     * el portal de finanzas de cada estado.
     *
     * GET /v1/payroll_taxes
     *
     * @param array{issuer?: string, month: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_tax',
     *     livemode: bool,
     *     issuer: string,
     *     month: string,
     *     total: float|int,
     *     states: list<array{state: string, name: string, employees: int, receipts: int, paid: float|int, excluded: float|int, base: float|int, rate: float|int, tax: float|int, surcharges: list<array<string, mixed>>, total: float|int, option: string|null, options: list<array<string, mixed>>|null, law: string|null}>,
     *     perceptions: list<array{type: string, label: string, amount: float|int, excluded: bool}>,
     *     excluded_perception_types: list<string>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-payroll-tax
     */
    public function get(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payroll_taxes', ['query' => $params], $options);
    }

    /**
     * Qué no grava el impuesto sobre nómina
     *
     * Las percepciones que no suman a la base (por omisión, las que casi todos los estados dejan
     * fuera: PTU, reembolsos, indemnizaciones, primas de antigüedad, jubilaciones, cuotas de
     * seguridad social pagadas por el patrón y viáticos) y la opción de tasa de cada estado que la
     * tiene, guardadas para el emisor. Lo que no mande se queda como estaba.
     *
     * POST /v1/payroll_taxes/settings
     *
     * @param array{
     *     issuer?: string,
     *     excluded_perception_types?: list<string>,
     *     state_options?: array<string, mixed>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_tax_settings',
     *     livemode: bool,
     *     issuer: string,
     *     excluded_perception_types: list<string>|null,
     *     state_options: array<string, mixed>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-payroll-tax-settings
     */
    public function updateSettings(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_taxes/settings', ['body' => $params, 'idempotent' => true], $options);
    }
}
