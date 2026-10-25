<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cuenta: $fiscalisto->testData.
 */
final class TestData
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Reiniciar los datos de prueba
     *
     * Deja el modo de pruebas como nuevo: cada emisor de pruebas conserva su RFC y su CSD de
     * pruebas pero pierde sus facturas, clientes, productos, lotes, ligas y descargas, y se borran
     * los eventos y el registro de solicitudes de pruebas. Las llaves y los webhooks se quedan.
     * Con seed (por omisión) deja 3 clientes y 3 productos de ejemplo. Solo con una llave
     * fk_test_; producción nunca se toca.
     *
     * POST /v1/test_data/reset
     *
     * @param array{seed?: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'test_data_reset',
     *     livemode: false,
     *     issuers: int,
     *     deleted_rows: int,
     *     deleted_events: int,
     *     customers_created: int,
     *     products_created: int,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cuenta/reset-test-data
     */
    public function reset(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/test_data/reset', ['body' => $params, 'idempotent' => true], $options);
    }
}
