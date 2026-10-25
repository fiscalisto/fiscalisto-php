<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cuenta: $fiscalisto->balance.
 */
final class Balance
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver los timbres
     *
     * Los timbres de producción que le quedan, por paquete. En pruebas se timbra gratis.
     *
     * GET /v1/balance
     *
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'balance',
     *     livemode: bool,
     *     available: int,
     *     unlimited: bool,
     *     low_balance_at: int,
     *     auto_recharge: array{timbres: int, at: int, max_per_month: int}|null,
     *     packs: list<array{timbres: int, remaining: int, purchased_at: string|null, expires_at: string|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cuenta/get-balance
     */
    public function get(array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/balance', [], $options);
    }
}
