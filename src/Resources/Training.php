<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->training.
 */
final class Training
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Capacitación
     *
     * Como «Nómina › Capacitación» de la app: quién firma las constancias DC-3 (con hasta 50
     * trabajadores el patrón o su representante legal; con más, el representante del patrón y el
     * de los trabajadores ante la comisión mixta: Acuerdo de la STPS del 14 de junio de 2013,
     * artículo 24, fracción II), cuántos trabajadores cuenta, los años del plan de capacitación
     * con el día límite del aviso a la STPS de cada uno (60 días hábiles, artículo 26, fracción
     * I), las constancias por renovar y cuántas faltan por entregar.
     *
     * GET /v1/training
     *
     * @param array{issuer?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'training',
     *     livemode: bool,
     *     issuer: string,
     *     settings: array{company_name: string|null, legal_rep: string|null, commission_employer_rep: string|null, workers_rep: string|null, commission: list<array<string, mixed>>, commission_constituted_on: string|null, workers_count: int|null, plan_start: string|null, plan_end: string|null, occupations: array<string, mixed>},
     *     workers: int,
     *     workers_from_payroll: bool,
     *     mixed_commission: bool,
     *     plan_years: list<array{from: string, to: string, list_by: string}>,
     *     renewals: list<array{employee: string, name: string, course: string, thematic_area: string, until: string, expired: bool}>,
     *     totals: array{due: int, late: int, missing_occupation: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-training
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/training', ['query' => $params], $options);
    }

    /**
     * Configurar la capacitación
     *
     * Quién firma las constancias, la comisión mixta (LFT 153-E: igual número por cada parte),
     * cuántos trabajadores contar si no todos están en Nómina, las fechas del plan (dos años como
     * máximo, LFT 153-H) y la ocupación del Catálogo Nacional de Ocupaciones de cada puesto. Lo
     * que no manda no cambia. Contesta training.
     *
     * POST /v1/training/settings
     *
     * @param array{
     *     issuer?: string,
     *     company_name?: string|null,
     *     legal_rep?: string|null,
     *     commission_employer_rep?: string|null,
     *     workers_rep?: string|null,
     *     commission?: list<array{name: string, side: 'patron'|'trabajadores', role?: string|null}>,
     *     commission_constituted_on?: string|null,
     *     workers_count?: int|null,
     *     plan_start?: string|null,
     *     plan_end?: string|null,
     *     occupations?: array<string, mixed>,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'training',
     *     livemode: bool,
     *     issuer: string,
     *     settings: array{company_name: string|null, legal_rep: string|null, commission_employer_rep: string|null, workers_rep: string|null, commission: list<array<string, mixed>>, commission_constituted_on: string|null, workers_count: int|null, plan_start: string|null, plan_end: string|null, occupations: array<string, mixed>},
     *     workers: int,
     *     workers_from_payroll: bool,
     *     mixed_commission: bool,
     *     plan_years: list<array{from: string, to: string, list_by: string}>,
     *     renewals: list<array{employee: string, name: string, course: string, thematic_area: string, until: string, expired: bool}>,
     *     totals: array{due: int, late: int, missing_occupation: int},
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/update-training-settings
     */
    public function updateSettings(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/training/settings', ['body' => $params, 'idempotent' => true], $options);
    }

    /**
     * Constancias para el aviso a la STPS
     *
     * Las constancias DC-3 emitidas de los cursos que terminaron entre from y to, con lo que pide
     * el aviso a la STPS (artículo 26, fracción I: nombre, CURP, ocupación, puesto, estudios,
     * curso, área temática, horas, fechas y agente capacitador), ordenadas por folio. El día
     * límite para presentarlo de cada año del plan viene en plan_years de GET /v1/training. El
     * aviso se presenta en el sistema de la STPS, que no tiene API.
     *
     * GET /v1/training/certificates
     *
     * @param array{issuer?: string, from: string, to: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'list',
     *     data: list<array{object: 'training_certificate', folio: int, name: string, curp: string, occupation: string, position: string|null, education: string|null, course: string, thematic_area: string, hours: float|int, start_date: string, end_date: string, trainer: string, trainer_registration: string|null, delivered_at: string|null}>,
     *     has_more: bool,
     *     url: string,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/list-training-certificates
     */
    public function certificates(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/training/certificates', ['query' => $params], $options);
    }
}
