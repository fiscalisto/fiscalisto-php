<?php

declare(strict_types=1);

namespace Fiscalisto;

/** La solicitud no tuvo respuesta (red caída o tiempo agotado). Lo lanza un transport. */
class TransportException extends \RuntimeException
{
    public function __construct(string $message, public readonly bool $timedOut = false)
    {
        parent::__construct($message);
    }
}
