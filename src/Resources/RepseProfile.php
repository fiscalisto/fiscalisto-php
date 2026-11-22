<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->repseProfile.
 */
final class RepseProfile
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Ver los datos del sujeto obligado
     *
     * Los datos del emisor que pide el SISUB del Infonavit y no están en Fiscalisto: folio del
     * REPSE, correo, teléfono, domicilio, representante legal y, de una persona moral, su acta
     * constitutiva y folio mercantil. Como «Datos del sujeto obligado» en «Nómina › REPSE».
     *
     * GET /v1/repse_profile
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'repse_profile',
     *     livemode: bool,
     *     issuer: string,
     *     stps_folio: string|null,
     *     email: string|null,
     *     phone: string|null,
     *     address: string|null,
     *     legal_representative: string|null,
     *     sole_administrator: string|null,
     *     deed_number: string|null,
     *     notary_name: string|null,
     *     notary_number: string|null,
     *     deed_date: string|null,
     *     commercial_folio: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-repse-profile
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/repse_profile', ['query' => $params], $options);
    }

    /**
     * Guardar los datos del sujeto obligado
     *
     * Cambia lo que mande; lo demás queda y "" lo vacía. El teléfono va con 10 dígitos y deed_date
     * como AAAA-MM-DD; si no, contesta parameter_invalid en ese campo.
     *
     * POST /v1/repse_profile
     *
     * @param array{
     *     issuer?: string,
     *     stps_folio?: string,
     *     email?: string,
     *     phone?: string,
     *     address?: string,
     *     legal_representative?: string,
     *     sole_administrator?: string,
     *     deed_number?: string,
     *     notary_name?: string,
     *     notary_number?: string,
     *     deed_date?: string|'',
     *     commercial_folio?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'repse_profile',
     *     livemode: bool,
     *     issuer: string,
     *     stps_folio: string|null,
     *     email: string|null,
     *     phone: string|null,
     *     address: string|null,
     *     legal_representative: string|null,
     *     sole_administrator: string|null,
     *     deed_number: string|null,
     *     notary_name: string|null,
     *     notary_number: string|null,
     *     deed_date: string|null,
     *     commercial_folio: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-repse-profile
     */
    public function update(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/repse_profile', ['body' => $params, 'idempotent' => true], $options);
    }
}
