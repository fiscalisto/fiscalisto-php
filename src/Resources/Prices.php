<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Listas de precios: $fiscalisto->prices.
 */
final class Prices
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver los precios de un cliente
     *
     * Lo que un cliente paga por unos productos a una cantidad: el precio por unidad sin IVA de su
     * lista (la suya, la de su grupo o la de todos), su descuento y el siguiente escalón de
     * mayoreo. No guarda nada.
     *
     * POST /v1/prices
     *
     * @param array{
     *     issuer?: string,
     *     customer: string,
     *     items: list<array{product: string, quantity?: float|int, unit?: string|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'price_quote',
     *     livemode: bool,
     *     customer: string,
     *     items: list<array{product: string, quantity: float|int, unit: string|null, unit_price: float|int, catalog_price: float|int, discount_percent: float|int, price_list: string|null, next_step: array<string, mixed>|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/listas-de-precios/quote-prices
     */
    public function quote(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/prices', ['body' => $params, 'idempotent' => true], $options);
    }
}
