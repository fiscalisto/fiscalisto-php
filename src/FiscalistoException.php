<?php

declare(strict_types=1);

namespace Fiscalisto;

/**
 * Un error de la API (o de la conexión, con type connection_error). errorCode es estable:
 * decida con él; getMessage() es para mostrarlo a una persona. getCode() es el código HTTP.
 */
class FiscalistoException extends \RuntimeException
{
    /** invalid_request_error, authentication_error, invoice_error, balance_error, rate_limit_error… */
    public readonly string $type;
    /** El código estable del error (invoice_rejected, insufficient_balance…). */
    public readonly string $errorCode;
    /** El campo que hay que corregir (items.0.unit_price). */
    public readonly ?string $param;
    /** El código del SAT o del PAC cuando ellos lo rechazaron (CFDI40145). */
    public readonly ?string $satCode;
    /** El comprobante rechazado (inv_…), cuando lo hay. */
    public readonly ?string $invoice;
    public readonly ?string $docUrl;
    /** Búsquelo en Desarrolladores › Solicitudes o mándelo a soporte. */
    public readonly ?string $requestId;
    /** El código HTTP (null: la solicitud no llegó). */
    public readonly ?int $status;
    /** @var array<string, mixed> El objeto error tal como llegó. */
    public readonly array $raw;

    /** @param array<string, mixed> $raw */
    public function __construct(array $raw, ?int $status = null, ?string $requestId = null, ?\Throwable $previous = null)
    {
        $text = static fn (string $k): ?string => isset($raw[$k]) && is_string($raw[$k]) ? $raw[$k] : null;
        $this->raw = $raw;
        $this->type = $text('type') ?? 'api_error';
        $this->errorCode = $text('code') ?? 'unknown';
        $this->param = $text('param');
        $this->satCode = $text('sat_code');
        $this->invoice = $text('invoice');
        $this->docUrl = $text('doc_url');
        $this->requestId = $text('request_id') ?? $requestId;
        $this->status = $status;
        parent::__construct($text('message') ?? 'Error de la API de Fiscalisto', $status ?? 0, $previous);
    }
}
