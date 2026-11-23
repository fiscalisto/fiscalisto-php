<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Emisores: $fiscalisto->settingChanges.
 */
final class SettingChanges
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar los cambios a los ajustes
     *
     * Como Ajustes › Cambios en la app: cada ajuste de la empresa que alguien cambió (por ahora la
     * cobranza automática y los horarios), de qué a qué, quién, por dónde y cuándo, del más
     * reciente al más antiguo. Valen para toda la empresa: cualquiera de sus emisores lee los
     * mismos.
     *
     * GET /v1/setting_changes
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string, setting?: string} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, object: 'setting_change', issuer: string, livemode: bool, setting: string, name: string, before: string, after: string, changed_by: string|null, source: 'app'|'api'|'mcp', created: string, undone: string|null, undoable: bool}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/list-setting-changes
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/setting_changes', $params, $options);
    }

    /**
     * Deshacer un cambio a un ajuste
     *
     * Regresa el ajuste al valor que tenía antes de ese cambio, como «Deshacer» en la app, y
     * devuelve el cambio nuevo que eso hizo (que también se puede deshacer). Solo el cambio más
     * reciente de cada ajuste y mientras conserve el valor que dejó: si no, 400
     * setting_change_not_undoable.
     *
     * POST /v1/setting_changes/{id}/undo
     *
     * @param string $id
     * @param array{idempotency_key?: string, timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     object: 'setting_change',
     *     issuer: string,
     *     livemode: bool,
     *     setting: string,
     *     name: string,
     *     before: string,
     *     after: string,
     *     changed_by: string|null,
     *     source: 'app'|'api'|'mcp',
     *     created: string,
     *     undone: string|null,
     *     undoable: bool,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/emisores/undo-setting-change
     */
    public function undo(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('POST', '/v1/setting_changes/' . rawurlencode($id) . '/undo', ['idempotent' => true], $options);
    }
}
