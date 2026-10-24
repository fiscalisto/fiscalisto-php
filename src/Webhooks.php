<?php

declare(strict_types=1);

namespace Fiscalisto;

/** $fiscalisto->webhooks: verificar lo que llega a su endpoint. */
final class Webhooks
{
    /**
     * Igual que Webhook::verify.
     *
     * @param array<string, string|list<string>> $headers
     * @return array<string, mixed>
     * @throws WebhookException
     */
    public function verify(string $payload, array $headers, string $secret, int $tolerance = 300, ?int $now = null): array
    {
        return Webhook::verify($payload, $headers, $secret, $tolerance, $now);
    }
}
