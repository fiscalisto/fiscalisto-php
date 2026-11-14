<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Verificar comprobantes: $fiscalisto->cfdiVerifications.
 */
final class CfdiVerifications
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Verificar un CFDI en el SAT
     *
     * Si cualquier CFDI (suyo, de un proveedor o de un cliente) existe en el SAT y está vigente o
     * cancelado, si se puede cancelar, y si su emisor y su receptor están en las listas del SAT.
     * Mande su XML, el texto de su QR, o el UUID con los dos RFC y el total. Consulta el servicio
     * público del SAT, sin e.firma. No usa timbres. En pruebas también consulta el SAT real: los
     * comprobantes de prueba no están ahí y responden not_found.
     *
     * POST /v1/cfdi_verifications
     *
     * @param array{
     *     xml?: string,
     *     qr?: string,
     *     uuid?: string,
     *     issuer_tax_id?: string,
     *     receiver_tax_id?: string,
     *     total?: float|int,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'cfdi_verification',
     *     livemode: bool,
     *     uuid: string,
     *     issuer_tax_id: string,
     *     receiver_tax_id: string,
     *     total: float|int,
     *     source: 'xml'|'qr'|'fields',
     *     sat_status: 'active'|'canceled'|'not_found'|'data_mismatch',
     *     cancellable: 'without_acceptance'|'with_acceptance'|'not_cancellable'|null,
     *     cancellation_status: 'in_process'|'rejected'|'deadline_passed'|'accepted'|'without_acceptance'|null,
     *     issuer_efos: bool|null,
     *     sat: array{code: string, state: string, cancellable: string|null, cancellation_status: string|null, efos_validation: string|null},
     *     xml: array{version: string|null, type: string|null, issued_at: string|null, stamped_at: string|null, issuer_name: string|null, receiver_name: string|null, currency: string|null}|null,
     *     issuer_sat_lists: array{object: 'sat_list_check', tax_id: string, name: string|null, listed: bool, risk: 'high'|'medium'|'none'|'unknown', verified: bool, lists: list<array<string, mixed>>, lists_updated_at: string|null, lists_unavailable: list<string>}|null,
     *     receiver_sat_lists: array{object: 'sat_list_check', tax_id: string, name: string|null, listed: bool, risk: 'high'|'medium'|'none'|'unknown', verified: bool, lists: list<array<string, mixed>>, lists_updated_at: string|null, lists_unavailable: list<string>}|null,
     *     checked_at: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/verificar-comprobantes/verify-cfdi
     */
    public function create(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/cfdi_verifications', ['body' => $params, 'idempotent' => true], $options);
    }
}
