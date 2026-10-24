<?php

declare(strict_types=1);

namespace Fiscalisto;

/** El webhook no es de Fiscalisto: falta un encabezado, la hora o la firma no cuadran. */
class WebhookException extends \RuntimeException
{
}
