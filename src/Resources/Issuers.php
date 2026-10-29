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
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
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
     *     sat_downloads: array{available: bool, efirma_expires_at: string|null},
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     sandbox: string|null,
     *     test_clock: array{frozen_time: string}|null,
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
        return $this->client->request('POST', '/v1/issuers', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar emisores
     *
     * Los emisores de la cuenta en el modo de la llave, los más recientes primero. Una llave
     * limitada a algunos emisores solo ve los suyos.
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
     * @return Collection<array{id: string, livemode: bool, object: 'issuer', tax_id: string, legal_name: string|null, tax_system: string|null, zip: string|null, status: 'active'|'needs_certificate'|'certificate_expired'|'needs_efirma'|'archived', requirement: string|null, certificate: array<string, mixed>|null, sat_downloads: array<string, mixed>, employer_registration: string|null, curp: string|null, stamps_as: string, sandbox: string|null, test_clock: array<string, mixed>|null, created_at: string|null, archived_at: string|null, metadata: array<string, mixed>}>
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
     * Un emisor: sus datos fiscales, si ya puede timbrar (status, CSD y contrato con el PAC) y su
     * registro patronal.
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
     *     sat_downloads: array{available: bool, efirma_expires_at: string|null},
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     sandbox: string|null,
     *     test_clock: array{frozen_time: string}|null,
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
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
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
     *     sat_downloads: array{available: bool, efirma_expires_at: string|null},
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     sandbox: string|null,
     *     test_clock: array{frozen_time: string}|null,
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
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
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
     *     sat_downloads: array{available: bool, efirma_expires_at: string|null},
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     sandbox: string|null,
     *     test_clock: array{frozen_time: string}|null,
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
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
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
     *     sat_downloads: array{available: bool, efirma_expires_at: string|null},
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     sandbox: string|null,
     *     test_clock: array{frozen_time: string}|null,
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
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/certificates', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Firmar el contrato con el PAC
     *
     * Una sola vez por RFC antes de timbrar en producción: firma el contrato de servicio del PAC
     * (Finkok) con la e.firma del emisor. La e.firma se usa en memoria para esa firma y no se
     * guarda, salvo que mande keep_for_downloads: true para pedirle al SAT las facturas del emisor
     * (POST /v1/sat_downloads); entonces se guarda cifrada y puede borrarla con DELETE.
     *
     * POST /v1/issuers/{id}/efirma
     *
     * @param string $id
     * @param array{cer: string, key: string, password: string, keep_for_downloads?: bool} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
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
     *     sat_downloads: array{available: bool, efirma_expires_at: string|null},
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     sandbox: string|null,
     *     test_clock: array{frozen_time: string}|null,
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
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/efirma', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Borrar la e.firma guardada
     *
     * Borra la e.firma que guardó con keep_for_downloads. El emisor sigue timbrando; ya no puede
     * pedir descargas al SAT hasta que la mande de nuevo.
     *
     * DELETE /v1/issuers/{id}/efirma
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
     *     sat_downloads: array{available: bool, efirma_expires_at: string|null},
     *     employer_registration: string|null,
     *     curp: string|null,
     *     stamps_as: string,
     *     sandbox: string|null,
     *     test_clock: array{frozen_time: string}|null,
     *     created_at: string|null,
     *     archived_at: string|null,
     *     metadata: array<string, mixed>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/delete-efirma
     */
    public function deleteEfirma(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/issuers/' . rawurlencode($id) . '/efirma', [], $options);
    }

    /**
     * Crear una liga de alta
     *
     * Una página en fiscalisto.com donde el dueño del emisor sube su CSD y firma el contrato con
     * el PAC con su e.firma, sin que esos archivos ni sus contraseñas pasen por su plataforma.
     * Mande a su cliente a url; al terminar vuelve a return_url y llega issuer.ready. Cada liga
     * sirve para un emisor, hasta que vence.
     *
     * POST /v1/issuers/{id}/onboarding_links
     *
     * @param string $id
     * @param array{return_url?: string, expires_in_hours?: int} $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'issuer_onboarding_link',
     *     livemode: bool,
     *     issuer: string,
     *     url: string,
     *     return_url: string|null,
     *     expires_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/create-issuer-onboarding-link
     */
    public function createOnboardingLink(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/onboarding_links', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Ver la opinión de cumplimiento (32-D)
     *
     * La última opinión que trajo del SAT: positiva, negativa (con sus motivos), sin obligaciones
     * o en suspensión. result es null hasta la primera consulta. No usa timbres.
     *
     * GET /v1/issuers/{id}/compliance_opinion
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'compliance_opinion',
     *     livemode: bool,
     *     issuer: string,
     *     result: 'positive'|'negative'|'no_obligations'|'suspended'|null,
     *     date: string|null,
     *     folio: string|null,
     *     reasons: list<string>,
     *     pdf: bool,
     *     checked_at: string|null,
     *     last_error: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-compliance-opinion
     */
    public function complianceOpinion(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/issuers/' . rawurlencode($id) . '/compliance_opinion', [], $options);
    }

    /**
     * Pedir la opinión de cumplimiento al SAT
     *
     * La pide al SAT ahora con la e.firma guardada del emisor (POST /v1/issuers/{id}/efirma con
     * keep_for_downloads: true). 1 timbre en producción, una vez cada 10 minutos; regresa si el
     * SAT no contesta. Si el SAT tarda, contesta status processing y el resultado llega a GET
     * /v1/issuers/{id}/compliance_opinion. En pruebas da una positiva de ejemplo.
     *
     * POST /v1/issuers/{id}/compliance_opinion/refresh
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_refresh',
     *     livemode: bool,
     *     issuer: string,
     *     document: 'compliance_opinion'|'tax_status_certificate'|'sat_mailbox',
     *     status: 'completed'|'processing',
     *     refreshed_at: string|null,
     *     next_refresh_at: string|null,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/refresh-compliance-opinion
     */
    public function refreshComplianceOpinion(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/compliance_opinion/refresh', ['idempotent' => true], $options);
    }

    /**
     * Descargar el PDF de la opinión de cumplimiento
     *
     * El PDF de la última opinión, como lo da el SAT. No usa timbres.
     *
     * GET /v1/issuers/{id}/compliance_opinion/pdf
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-compliance-opinion-pdf
     */
    public function complianceOpinionPdf(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/issuers/' . rawurlencode($id) . '/compliance_opinion/pdf', ['as' => 'bytes'], $options);
    }

    /**
     * Ver la constancia de situación fiscal
     *
     * Lo que dice la última constancia generada: razón social, regímenes, código postal, estatus
     * en el padrón e idCIF. No usa timbres.
     *
     * GET /v1/issuers/{id}/tax_status_certificate
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'tax_status_certificate',
     *     livemode: bool,
     *     issuer: string,
     *     issued_on: string|null,
     *     id_cif: string|null,
     *     tax_id: string,
     *     legal_name: string|null,
     *     tax_systems: list<array{code: string, name: string}>,
     *     zip: string|null,
     *     status: string|null,
     *     pdf: bool,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-tax-status-certificate
     */
    public function taxStatusCertificate(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/issuers/' . rawurlencode($id) . '/tax_status_certificate', [], $options);
    }

    /**
     * Generar la constancia de situación fiscal en el SAT
     *
     * Genera una constancia nueva con la e.firma guardada del emisor. 1 timbre en producción, una
     * vez cada 10 minutos; regresa si el SAT no contesta. En pruebas hace una con los datos del
     * emisor.
     *
     * POST /v1/issuers/{id}/tax_status_certificate/refresh
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_refresh',
     *     livemode: bool,
     *     issuer: string,
     *     document: 'compliance_opinion'|'tax_status_certificate'|'sat_mailbox',
     *     status: 'completed'|'processing',
     *     refreshed_at: string|null,
     *     next_refresh_at: string|null,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/refresh-tax-status-certificate
     */
    public function refreshTaxStatusCertificate(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/tax_status_certificate/refresh', ['idempotent' => true], $options);
    }

    /**
     * Descargar el PDF de la constancia
     *
     * El PDF de la última constancia, como lo da el SAT. No usa timbres.
     *
     * GET /v1/issuers/{id}/tax_status_certificate/pdf
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return string Los bytes del PDF.
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-tax-status-certificate-pdf
     */
    public function taxStatusCertificatePdf(string $id, array $options = []): string
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/issuers/' . rawurlencode($id) . '/tax_status_certificate/pdf', ['as' => 'bytes'], $options);
    }

    /**
     * Revisar el buzón tributario en el SAT
     *
     * Lee los avisos del buzón tributario del emisor ahora, con su e.firma guardada; nunca abre
     * notificaciones (abrirlas firma el acuse y corren los plazos). 1 timbre en producción, una
     * vez cada 10 minutos. En pruebas deja dos avisos de ejemplo.
     *
     * POST /v1/issuers/{id}/sat_mailbox/refresh
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'sat_refresh',
     *     livemode: bool,
     *     issuer: string,
     *     document: 'compliance_opinion'|'tax_status_certificate'|'sat_mailbox',
     *     status: 'completed'|'processing',
     *     refreshed_at: string|null,
     *     next_refresh_at: string|null,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/refresh-sat-mailbox
     */
    public function refreshSatMailbox(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/sat_mailbox/refresh', ['idempotent' => true], $options);
    }

    /**
     * Ver el portal de autofactura de un emisor
     *
     * El portal de autofactura del emisor: su dirección, hasta cuándo se puede facturar un ticket
     * y cómo se arma la factura global.
     *
     * GET /v1/issuers/{id}/self_invoicing
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'self_invoicing',
     *     livemode: bool,
     *     issuer: string,
     *     portal_url: string,
     *     window: 'month'|'days',
     *     window_days: int,
     *     global_periodicity: '01'|'02'|'03'|'04',
     *     global_invoice: 'auto'|'off',
     *     ask_total: bool,
     *     portal_title: string|null,
     *     portal_message: string|null,
     *     code_hint: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/autofactura/get-self-invoicing
     */
    public function getSelfInvoicing(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/issuers/' . rawurlencode($id) . '/self_invoicing', [], $options);
    }

    /**
     * Cambiar las reglas de autofactura
     *
     * Hasta cuándo se puede facturar un ticket y cada cuánto se timbra la factura global.
     *
     * POST /v1/issuers/{id}/self_invoicing
     *
     * @param string $id
     * @param array{
     *     window?: 'month'|'days',
     *     window_days?: int,
     *     global_periodicity?: '01'|'02'|'03'|'04',
     *     global_invoice?: 'auto'|'off',
     *     ask_total?: bool,
     *     portal_title?: string|null,
     *     portal_message?: string|null,
     *     code_hint?: string|null,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'self_invoicing',
     *     livemode: bool,
     *     issuer: string,
     *     portal_url: string,
     *     window: 'month'|'days',
     *     window_days: int,
     *     global_periodicity: '01'|'02'|'03'|'04',
     *     global_invoice: 'auto'|'off',
     *     ask_total: bool,
     *     portal_title: string|null,
     *     portal_message: string|null,
     *     code_hint: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/autofactura/update-self-invoicing
     */
    public function updateSelfInvoicing(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/issuers/' . rawurlencode($id) . '/self_invoicing', ['body' => $params, 'idempotent' => true], $options);
    }
}
