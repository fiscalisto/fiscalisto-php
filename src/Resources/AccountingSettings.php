<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Contabilidad: $fiscalisto->accountingSettings.
 */
final class AccountingSettings
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver cómo se lleva la contabilidad
     *
     * Si cada cliente y cada proveedor tiene su propia subcuenta (party_subaccounts), como
     * Catálogo de cuentas › Subcuentas por cliente y proveedor en la app.
     *
     * GET /v1/accounting/settings
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'accounting_settings',
     *     livemode: bool,
     *     issuer: string,
     *     party_subaccounts: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/get-accounting-settings
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/accounting/settings', ['query' => $params], $options);
    }

    /**
     * Cambiar cómo se lleva la contabilidad
     *
     * Con party_subaccounts en true, lo que debe cada cliente va a su subcuenta de Clientes
     * (105-01-0001, 105-01-0002…) y lo que se le debe a cada proveedor a la suya de Proveedores
     * (201-01-0001…), numeradas una vez en el orden en que aparecen sus CFDI y con su nombre; la
     * balanza, los auxiliares, las pólizas y la contabilidad electrónica las usan. En false, sus
     * saldos vuelven a Clientes y Proveedores; los números se conservan si se vuelve a activar.
     * Aplica a toda la empresa del emisor y va a la bitácora.
     *
     * POST /v1/accounting/settings
     *
     * @param array{issuer?: string, party_subaccounts: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'accounting_settings',
     *     livemode: bool,
     *     issuer: string,
     *     party_subaccounts: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/contabilidad/update-accounting-settings
     */
    public function update(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/accounting/settings', ['body' => $params, 'idempotent' => true], $options);
    }
}
