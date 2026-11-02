<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->imssFiles.
 */
final class ImssFiles
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Archivos para IDSE o SUA
     *
     * Los archivos de los movimientos pendientes: para IDSE (formato de 168 posiciones, un archivo
     * por tipo: reingresos, modificaciones de salario y bajas; necesita la guía de su
     * subdelegación) o para importar en SUA (ASEG.TXT con las altas y MOVT.TXT con los demás). El
     * salario se declara topado a 25 UMA y nunca abajo del mínimo. El emisor necesita
     * employer_registration. Los que el IMSS rechazaría van en refused con su razón. No los marca
     * como presentados: hágalo con POST /v1/imss_movements/report cuando el IMSS los reciba.
     *
     * POST /v1/imss_files
     *
     * @param array{
     *     issuer?: string,
     *     format: 'idse'|'sua',
     *     movements?: list<string>,
     *     guide?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'imss_files',
     *     livemode: bool,
     *     issuer: string,
     *     format: 'idse'|'sua',
     *     files: list<array{file_name: string, description: string, count: int, content: string, content_base64: string}>,
     *     movements: list<string>,
     *     refused: list<array{movement: string, employee_name: string, problems: list<string>}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-imss-files
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/imss_files', ['body' => $params, 'idempotent' => true], $options);
    }
}
