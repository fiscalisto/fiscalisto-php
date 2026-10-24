<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Emisores: $fiscalisto->issuers.
 */
final class Issuers
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Crear un emisor
     *
     * Agrega un RFC que va a timbrar. Después suba su CSD (POST /v1/issuers/{id}/certificates) y,
     * solo en producción, firme una vez el contrato con el PAC con su e.firma (POST
     * /v1/issuers/{id}/efirma).
     *
     * POST /v1/issuers
     *
     * @param array{
     *     tax_id: string,
     *     legal_name: string,
     *     tax_system: string,
     *     zip: string,
     *     employer_registration?: string|null,
     *     curp?: string|null,
     *     metadata?: array<string, mixed>,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'issuer',
     *     tax_id: string,
     *     legal_name: string|null,
     *     tax_system: string|null,
     *     zip: string|null,
     *     status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived',
     *     requirement: string|null,
     *     certificate: array{serial_number: string|null, expires_at: string|null}|null,
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     created_at: string|null,
     *     archived_at: string|null,
     *     metadata: array<string, mixed>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/create-issuer
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers', ['body' => $params], $options);
    }

    /**
     * Listar emisores
     *
     * GET /v1/issuers
     *
     * @param array{
     *     limit?: int,
     *     starting_after?: string,
     *     tax_id?: string,
     *     include_archived?: bool,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'issuer', tax_id: string, legal_name: string|null, tax_system: string|null, zip: string|null, status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived', requirement: string|null, certificate: array<string, mixed>|null, employer_registration: string|null, curp: string|null, stamps_as: string, created_at: string|null, archived_at: string|null, metadata: array<string, mixed>}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/list-issuers
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/issuers', $params, $options);
    }

    /**
     * Ver un emisor
     *
     * GET /v1/issuers/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'issuer',
     *     tax_id: string,
     *     legal_name: string|null,
     *     tax_system: string|null,
     *     zip: string|null,
     *     status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived',
     *     requirement: string|null,
     *     certificate: array{serial_number: string|null, expires_at: string|null}|null,
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     created_at: string|null,
     *     archived_at: string|null,
     *     metadata: array<string, mixed>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/get-issuer
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/issuers/' . rawurlencode($id), [], $options);
    }

    /**
     * Actualizar un emisor
     *
     * Solo cambia lo que mande. El RFC no cambia: cree otro emisor.
     *
     * POST /v1/issuers/{id}
     *
     * @param string $id
     * @param array{
     *     legal_name?: string,
     *     tax_system?: string,
     *     zip?: string,
     *     employer_registration?: string|null,
     *     curp?: string|null,
     *     metadata?: array<string, mixed>|null,
     * } $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'issuer',
     *     tax_id: string,
     *     legal_name: string|null,
     *     tax_system: string|null,
     *     zip: string|null,
     *     status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived',
     *     requirement: string|null,
     *     certificate: array{serial_number: string|null, expires_at: string|null}|null,
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     created_at: string|null,
     *     archived_at: string|null,
     *     metadata: array<string, mixed>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/update-issuer
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id), ['body' => $params], $options);
    }

    /**
     * Archivar un emisor
     *
     * Deja de timbrar; sus comprobantes se quedan.
     *
     * DELETE /v1/issuers/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'issuer',
     *     tax_id: string,
     *     legal_name: string|null,
     *     tax_system: string|null,
     *     zip: string|null,
     *     status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived',
     *     requirement: string|null,
     *     certificate: array{serial_number: string|null, expires_at: string|null}|null,
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     created_at: string|null,
     *     archived_at: string|null,
     *     metadata: array<string, mixed>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/archive-issuer
     */
    public function archive(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/issuers/' . rawurlencode($id), [], $options);
    }

    /**
     * Subir el CSD
     *
     * El certificado de sello digital (.cer y .key en base64) y la contraseña de la llave. Se
     * guarda cifrado y solo se usa para sellar. En pruebas se revisa pero se timbra con el CSD de
     * pruebas del SAT.
     *
     * POST /v1/issuers/{id}/certificates
     *
     * @param string $id
     * @param array{cer: string, key: string, password: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'issuer',
     *     tax_id: string,
     *     legal_name: string|null,
     *     tax_system: string|null,
     *     zip: string|null,
     *     status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived',
     *     requirement: string|null,
     *     certificate: array{serial_number: string|null, expires_at: string|null}|null,
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     created_at: string|null,
     *     archived_at: string|null,
     *     metadata: array<string, mixed>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/upload-certificate
     */
    public function uploadCertificate(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/certificates', ['body' => $params], $options);
    }

    /**
     * Firmar el contrato con el PAC
     *
     * Una sola vez por RFC antes de timbrar en producción: firma el contrato de servicio del PAC
     * (Finkok) con la e.firma del emisor. La e.firma se usa en memoria para esa firma y nunca se
     * guarda.
     *
     * POST /v1/issuers/{id}/efirma
     *
     * @param string $id
     * @param array{cer: string, key: string, password: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'issuer',
     *     tax_id: string,
     *     legal_name: string|null,
     *     tax_system: string|null,
     *     zip: string|null,
     *     status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived',
     *     requirement: string|null,
     *     certificate: array{serial_number: string|null, expires_at: string|null}|null,
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     created_at: string|null,
     *     archived_at: string|null,
     *     metadata: array<string, mixed>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/sign-efirma
     */
    public function signEfirma(string $id, array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/efirma', ['body' => $params], $options);
    }
}
