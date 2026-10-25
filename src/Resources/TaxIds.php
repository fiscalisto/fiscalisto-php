<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Clientes: $fiscalisto->taxIds.
 */
final class TaxIds
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Validar los datos fiscales de un cliente
     *
     * Antes de timbrar: si el RFC, el nombre, el régimen, el código postal y el uso van a pasar.
     * Sin cif_id revisa lo que se puede revisar sin el SAT (formato, régimen para ese tipo de
     * persona, código postal en el catálogo, uso para el régimen, nombre sin «S.A. de C.V.») y las
     * listas del SAT. Con el idCIF de la constancia lee el registro del SAT y compara nombre,
     * código postal y régimen, como hará el PAC. No usa timbres.
     *
     * POST /v1/tax_ids/validate
     *
     * @param array{
     *     tax_id: string,
     *     legal_name?: string,
     *     tax_system?: string,
     *     zip?: string,
     *     use?: string,
     *     cif_id?: string,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'tax_id_validation',
     *     tax_id: string,
     *     kind: 'company'|'person'|'generic',
     *     valid: bool,
     *     checked_with_sat: bool,
     *     errors: list<array{param: string, code: string, message: string, suggestion: string|null}>,
     *     warnings: list<array{param: string, code: string, message: string, suggestion: string|null}>,
     *     sat_record: array{legal_name: string|null, zip: string|null, tax_systems: list<string>}|null,
     *     sat_error: string|null,
     *     sat_lists: array{object: 'sat_list_check', tax_id: string, name: string|null, listed: bool, risk: 'high'|'medium'|'none', lists: list<array<string, mixed>>, lists_updated_at: string|null}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/clientes/validate-tax-id
     */
    public function validate(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/tax_ids/validate', ['body' => $params, 'idempotent' => true], $options);
    }
}
