<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Nómina: $fiscalisto->payrollCalendar.
 */
final class PayrollCalendar
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Calendario de nómina
     *
     * Como «Nómina › Calendario» de la app: cada nómina en su fecha de pago (con cuántos de sus
     * recibos están timbrados y el último día para timbrarlos), y lo que se paga por ella, con el
     * artículo de la ley de cada fecha: cuotas del IMSS (día 17 del mes siguiente, LSS art. 39),
     * RCV e Infonavit (bimestrales, día 17), impuesto sobre nómina de cada estado donde trabajan
     * sus empleados, aguinaldo (antes del 20 de diciembre), PTU, prima de riesgo de trabajo
     * (febrero) y ajuste anual. Una fecha de pago al IMSS que cae en día inhábil o viernes pasa al
     * siguiente día hábil (CFF art. 12, RACERF art. 3).
     *
     * GET /v1/payroll_calendar
     *
     * @param array{issuer?: string, days_ahead?: int, days_back?: int} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_calendar',
     *     livemode: bool,
     *     issuer: string,
     *     today: string,
     *     events: list<array{object: 'payroll_calendar_event', obligation: 'pago'|'imss'|'rcv_infonavit'|'isn'|'aguinaldo'|'ptu'|'prima_riesgo'|'ajuste_anual'|'icsoe'|'sisub', key: string, title: string, due_date: string, basis: string, to_confirm: string|null, paid: bool, paid_at: string|null, state: string|null, payroll: array<string, mixed>|null}>,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/get-payroll-calendar
     */
    public function get(array $params = [], array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/payroll_calendar', ['query' => $params], $options);
    }

    /**
     * Marcar un pago de nómina como pagado
     *
     * Marca (paid true) o desmarca (false) un pago del calendario de nómina: imss, rcv_infonavit,
     * isn, aguinaldo, ptu, prima_riesgo, ajuste_anual, icsoe o sisub, con su key como lo da GET
     * /v1/payroll_calendar. Una nómina (pago) queda hecha al timbrar sus recibos.
     *
     * POST /v1/payroll_calendar/mark
     *
     * @param array{
     *     issuer?: string,
     *     obligation: 'imss'|'rcv_infonavit'|'isn'|'aguinaldo'|'ptu'|'prima_riesgo'|'ajuste_anual'|'icsoe'|'sisub',
     *     key: string,
     *     paid: bool,
     * } $params
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     object: 'payroll_calendar_event',
     *     obligation: 'pago'|'imss'|'rcv_infonavit'|'isn'|'aguinaldo'|'ptu'|'prima_riesgo'|'ajuste_anual'|'icsoe'|'sisub',
     *     key: string,
     *     title: string,
     *     due_date: string,
     *     basis: string,
     *     to_confirm: string|null,
     *     paid: bool,
     *     paid_at: string|null,
     *     state: string|null,
     *     payroll: array{periodicity: string, period: array<string, mixed>, stamp_by: string, employees: int, stamped: int}|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/nomina/mark-payroll-calendar-event
     */
    public function mark(array $params, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/payroll_calendar/mark', ['body' => $params, 'idempotent' => true], $options);
    }
}
