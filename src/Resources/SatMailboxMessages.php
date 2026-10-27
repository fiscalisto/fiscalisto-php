<?php

// Generado por `bun run openapi` desde la especificación OpenAPI de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto\Resources;

use Fiscalisto\Collection;
use Fiscalisto\Core;
use Fiscalisto\FiscalistoException;

/**
 * Cumplimiento SAT: $fiscalisto->satMailboxMessages.
 */
final class SatMailboxMessages
{
    public function __construct(private readonly Core $client)
    {
    }

    /**
     * Listar avisos del buzón tributario
     *
     * Los avisos que trajo del buzón del emisor, los más recientes primero. No usa timbres.
     *
     * GET /v1/sat_mailbox_messages
     *
     * @param array{limit?: int, starting_after?: string, issuer?: string, unread?: bool} $params
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return Collection<array{id: string, livemode: bool, object: 'sat_mailbox_message', issuer: string, subject: string, summary: string|null, source: 'mailbox'|'email', unread: bool, urgency: 'urgent'|'attention'|'informational', kind: string, action_required: bool, received_at: string|null, created_at: string|null}>
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/list-sat-mailbox-messages
     */
    public function list(array $params = [], array $options = []): Collection
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->list('/v1/sat_mailbox_messages', $params, $options);
    }

    /**
     * Ver un aviso del buzón tributario
     *
     * Un aviso del buzón, con su urgencia y si pide hacer algo.
     *
     * GET /v1/sat_mailbox_messages/{id}
     *
     * @param string $id
     * @param array{timeout?: float|int, max_retries?: int} $options
     * @return array{
     *     id: string,
     *     livemode: bool,
     *     object: 'sat_mailbox_message',
     *     issuer: string,
     *     subject: string,
     *     summary: string|null,
     *     source: 'mailbox'|'email',
     *     unread: bool,
     *     urgency: 'urgent'|'attention'|'informational',
     *     kind: string,
     *     action_required: bool,
     *     received_at: string|null,
     *     created_at: string|null,
     * }
     * @throws FiscalistoException
     * @see https://fiscalisto.com/docs/api/referencia/cumplimiento-sat/get-sat-mailbox-message
     */
    public function get(string $id, array $options = []): array
    {
        // @phpstan-ignore return.type (lo que contesta la API, documentado arriba)
        return $this->client->request('GET', '/v1/sat_mailbox_messages/' . rawurlencode($id), [], $options);
    }
}
