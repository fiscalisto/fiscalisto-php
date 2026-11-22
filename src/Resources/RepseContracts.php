<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->repseContracts.
 */
final class RepseContracts
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Registrar un contrato de servicios especializados
     *
     * Un contrato de servicios u obras especializadas (LFT art. 15 y 15-A) con su cliente, el
     * centro de trabajo y quién trabaja en él y desde cuándo, como «Nómina › REPSE › + Contrato»
     * en la app. Con él se arman los informes cuatrimestrales ICSOE del IMSS (LSS art. 15-A) y
     * SISUB del Infonavit (Ley del Infonavit art. 29 Bis) de GET /v1/repse_returns/{period}, y
     * aparecen sus fechas en el calendario de nómina. Un número de contrato que ya usó contesta
     * parameter_invalid en number; un trabajador de otro emisor, en workers.
     *
     * POST /v1/repse_contracts
     *
     * @param array{
     *     issuer?: string,
     *     number: string,
     *     kind: string,
     *     contract_object: string,
     *     service: string,
     *     amount: float|int,
     *     start_date: string,
     *     end_date?: string|null,
     *     estimated_workers: int,
     *     client_tax_id: string,
     *     client_name: string,
     *     client_employer_registration?: string|null,
     *     client_address: array{street: string, exterior?: string, interior?: string, neighborhood?: string, zip: string, municipality: string, state: string},
     *     site_address: array{street: string, exterior?: string, interior?: string, neighborhood?: string, zip: string, municipality: string, state: string},
     *     workers: list<array{employee: string, start_date: string, end_date?: string|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'repse_contract',
     *     issuer: string,
     *     number: string,
     *     kind: string,
     *     contract_object: string,
     *     service: string,
     *     amount: float|int,
     *     start_date: string,
     *     end_date: string|null,
     *     estimated_workers: int,
     *     client_tax_id: string,
     *     client_name: string,
     *     client_employer_registration: string|null,
     *     client_address: array{street: string, exterior: string|null, interior: string|null, neighborhood: string|null, zip: string, municipality: string, state: string},
     *     site_address: array{street: string, exterior: string|null, interior: string|null, neighborhood: string|null, zip: string, municipality: string, state: string},
     *     workers: list<array{employee: string, name: string, start_date: string, end_date: string|null}>,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/create-repse-contract
     */
    public function create(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/repse_contracts', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Listar contratos de servicios especializados
     *
     * Los contratos del emisor que no ha archivado, por fecha de inicio (el más antiguo primero) y
     * número.
     *
     * GET /v1/repse_contracts
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'repse_contract', issuer: string, number: string, kind: string, contract_object: string, service: string, amount: float|int, start_date: string, end_date: string|null, estimated_workers: int, client_tax_id: string, client_name: string, client_employer_registration: string|null, client_address: array<string, mixed>, site_address: array<string, mixed>, workers: list<array<string, mixed>>, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-repse-contracts
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/repse_contracts', $params, $options);
    }

    /**
     * Ver un contrato de servicios especializados
     *
     * Un contrato con su cliente, centro de trabajo y trabajadores.
     *
     * GET /v1/repse_contracts/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'repse_contract',
     *     issuer: string,
     *     number: string,
     *     kind: string,
     *     contract_object: string,
     *     service: string,
     *     amount: float|int,
     *     start_date: string,
     *     end_date: string|null,
     *     estimated_workers: int,
     *     client_tax_id: string,
     *     client_name: string,
     *     client_employer_registration: string|null,
     *     client_address: array{street: string, exterior: string|null, interior: string|null, neighborhood: string|null, zip: string, municipality: string, state: string},
     *     site_address: array{street: string, exterior: string|null, interior: string|null, neighborhood: string|null, zip: string, municipality: string, state: string},
     *     workers: list<array{employee: string, name: string, start_date: string, end_date: string|null}>,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-repse-contract
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/repse_contracts/' . rawurlencode($id), [], $options);
    }

    /**
     * Cambiar un contrato de servicios especializados
     *
     * Cambia lo que mande; lo demás queda. workers reemplaza la lista completa: para que alguien
     * deje el contrato, póngale end_date en vez de quitarlo, así sigue en los informes de los
     * meses que trabajó. Un contrato que terminó lleva su end_date.
     *
     * POST /v1/repse_contracts/{id}
     *
     * @param string $id
     * @param array{
     *     number?: string,
     *     kind?: string,
     *     contract_object?: string,
     *     service?: string,
     *     amount?: float|int,
     *     start_date?: string,
     *     end_date?: string|null,
     *     estimated_workers?: int,
     *     client_tax_id?: string,
     *     client_name?: string,
     *     client_employer_registration?: string|null,
     *     client_address?: array{street: string, exterior?: string, interior?: string, neighborhood?: string, zip: string, municipality: string, state: string},
     *     site_address?: array{street: string, exterior?: string, interior?: string, neighborhood?: string, zip: string, municipality: string, state: string},
     *     workers?: list<array{employee: string, start_date: string, end_date?: string|null}>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'repse_contract',
     *     issuer: string,
     *     number: string,
     *     kind: string,
     *     contract_object: string,
     *     service: string,
     *     amount: float|int,
     *     start_date: string,
     *     end_date: string|null,
     *     estimated_workers: int,
     *     client_tax_id: string,
     *     client_name: string,
     *     client_employer_registration: string|null,
     *     client_address: array{street: string, exterior: string|null, interior: string|null, neighborhood: string|null, zip: string, municipality: string, state: string},
     *     site_address: array{street: string, exterior: string|null, interior: string|null, neighborhood: string|null, zip: string, municipality: string, state: string},
     *     workers: list<array{employee: string, name: string, start_date: string, end_date: string|null}>,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-repse-contract
     */
    public function update(string $id, array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/repse_contracts/' . rawurlencode($id), ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Archivar un contrato de servicios especializados
     *
     * Lo archiva: sale de la lista y de todos los informes, también de los pasados. Para un
     * contrato que terminó, mejor póngale end_date con POST /v1/repse_contracts/{id}.
     *
     * DELETE /v1/repse_contracts/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{id: string, object: string, deleted: true}
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/delete-repse-contract
     */
    public function delete(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('DELETE', '/v1/repse_contracts/' . rawurlencode($id), [], $options);
    }
}
