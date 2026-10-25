<?php

// Generado por `bun run openapi` desde la lista de errores de la API: no lo edite.

declare(strict_types=1);

namespace Fiscalisto;

/**
 * Los códigos de error de la API, para comparar `$e->errorCode` sin escribir el texto:
 * `if ($e->errorCode === ErrorCode::INVOICE_REJECTED)`. Vea https://fiscalisto.com/docs/api/errores.
 */
final class ErrorCode
{
    /** El depósito no se puede conciliar, clasificar o reabrir así (ya está conciliado, las facturas son de otro cliente o una está cancelada…). El mensaje dice por qué. */
    public const BANK_TRANSACTION_INVALID = 'bank_transaction_invalid';

    /** Una factura del lote no pasa la revisión; param dice cuál (invoices.3.items.0.unit_price). Ninguna del lote se timbró. */
    public const BATCH_INVALID = 'batch_invalid';

    /** El cuerpo pasa de 10 MB. Divida el trabajo en varios lotes. */
    public const BODY_TOO_LARGE = 'body_too_large';

    /** La API se llama desde su servidor, nunca desde el navegador: la llave secreta quedaría expuesta. */
    public const BROWSER_NOT_SUPPORTED = 'browser_not_supported';

    /** El SAT no aceptó la solicitud de cancelación; message dice por qué. */
    public const CANCELLATION_FAILED = 'cancellation_failed';

    /** El catálogo del SAT no respondió (503). Reintente en unos segundos. */
    public const CATALOG_UNAVAILABLE = 'catalog_unavailable';

    /** El CSD no sirve: no es un certificado de sello (es una e.firma), está vencido, el .key no corresponde o la contraseña no abre la llave. */
    public const CERTIFICATE_INVALID = 'certificate_invalid';

    /** Suba primero el CSD del emisor; después firme el contrato con su e.firma. */
    public const CERTIFICATE_REQUIRED = 'certificate_required';

    /** No se pudo conectar con la API (connection_error). */
    public const CONNECTION_FAILED = 'connection_failed';

    /** Ya hay un cliente con ese RFC en el catálogo del emisor (o un producto con ese SKU). */
    public const CUSTOMER_EXISTS = 'customer_exists';

    /** Llegó al tope del día de algo que no se paga con timbres: comprobantes en pruebas (1,000), RFC revisados en las listas del SAT o constancias consultadas. Retry-After dice cuántos segundos faltan para la medianoche de la Ciudad de México. */
    public const DAILY_LIMIT = 'daily_limit';

    /** El cliente ya mandó sus datos con esa liga: una solicitud completada no se cancela. */
    public const DATA_REQUEST_COMPLETED = 'data_request_completed';

    /** El mes no tiene pagos a proveedores: esa DIOT se presenta sin operaciones desde el portal del SAT. */
    public const DIOT_EMPTY = 'diot_empty';

    /** La e.firma no sirve: no es una e.firma (es un CSD), es de otro RFC, está vencida o la contraseña no abre la llave. */
    public const EFIRMA_INVALID = 'efirma_invalid';

    /** Para pedirle al SAT las facturas de un emisor en producción, guarde antes su e.firma: POST /v1/issuers/{id}/efirma con keep_for_downloads: true. También si la guardada venció. */
    public const EFIRMA_REQUIRED = 'efirma_required';

    /** No se pudo mandar el correo; el comprobante sí está timbrado. */
    public const EMAIL_FAILED = 'email_failed';

    /** La cuenta llegó al máximo de webhooks en este modo. */
    public const ENDPOINT_LIMIT = 'endpoint_limit';

    /** Lo que timbra exige el encabezado Idempotency-Key (8 a 255 caracteres, uno nuevo por comprobante). Así un reintento nunca timbra dos veces. */
    public const IDEMPOTENCY_KEY_MISSING = 'idempotency_key_missing';

    /** Esa Idempotency-Key ya se usó con otro cuerpo. Use una nueva para un comprobante distinto. */
    public const IDEMPOTENCY_KEY_REUSED = 'idempotency_key_reused';

    /** La cuenta no tiene timbres de producción. Compre un paquete en Desarrolladores › Timbres. En pruebas nunca pasa. Para enterarse antes, escuche balance.low o active la recarga automática. */
    public const INSUFFICIENT_BALANCE = 'insufficient_balance';

    /** Algo falló de nuestro lado. Repita la solicitud con la misma Idempotency-Key: nunca se timbra dos veces. Si sigue, escríbanos con el request_id. */
    public const INTERNAL_ERROR = 'internal_error';

    /** La llave no existe, se revocó o expiró. Cree otra en Desarrolladores › Llaves. */
    public const INVALID_API_KEY = 'invalid_api_key';

    /** El cuerpo no es un objeto JSON válido. */
    public const INVALID_JSON = 'invalid_json';

    /** La factura no cumple una regla del SAT que Fiscalisto revisa antes de mandarla al PAC (uso contra régimen, totales, complementos…). No se usó ningún timbre. */
    public const INVOICE_INVALID = 'invoice_invalid';

    /** Solo una factura de ingreso PUE vigente se marca pagada o por cobrar; una PPD se paga con su complemento de pago (type P). */
    public const INVOICE_NOT_MARKABLE = 'invoice_not_markable';

    /** La acción es para facturas timbradas (enviar, cancelar, sustituir). */
    public const INVOICE_NOT_STAMPED = 'invoice_not_stamped';

    /** El PAC o el SAT no la aceptaron. sat_code trae su código (CFDI40xxx) y message qué corregir. La factura queda como rejected; no se usó ningún timbre. */
    public const INVOICE_REJECTED = 'invoice_rejected';

    /** El emisor está archivado: ya no timbra. Sus comprobantes se pueden consultar y cancelar. */
    public const ISSUER_ARCHIVED = 'issuer_archived';

    /** Se crearon 500 emisores en 24 horas. Escríbanos si necesita más. */
    public const ISSUER_CREATION_LIMIT = 'issuer_creation_limit';

    /** Ese RFC ya es un emisor de la cuenta en este modo. */
    public const ISSUER_EXISTS = 'issuer_exists';

    /** No existe ese emisor en la cuenta (o es del otro modo). */
    public const ISSUER_MISSING = 'issuer_missing';

    /** La llave no puede usar ese emisor. */
    public const ISSUER_NOT_ALLOWED = 'issuer_not_allowed';

    /** La cuenta tiene varios emisores y la solicitud no dice cuál: mande issuer (iss_…). */
    public const ISSUER_REQUIRED = 'issuer_required';

    /** La llave es de un entorno de prueba y la solicitud es de toda la cuenta (como crear o borrar entornos): use una llave de pruebas de la cuenta. */
    public const KEY_IN_SANDBOX = 'key_in_sandbox';

    /** La llave es de solo lectura: puede hacer GET, validar RFC, revisar listas del SAT y calcular recibos de nómina, pero nada que timbre, cancele, envíe o cambie datos. */
    public const KEY_READ_ONLY = 'key_read_only';

    /** La llave está limitada a algunos emisores y la solicitud toca otro (o crea uno nuevo, o usa algo de toda la cuenta como webhooks). */
    public const KEY_RESTRICTED = 'key_restricted';

    /** El objeto es del otro modo: una llave fk_test_ solo ve lo de pruebas y una fk_live_ lo de producción. */
    public const LIVEMODE_MISMATCH = 'livemode_mismatch';

    /** La ruta existe pero no con ese método (por ejemplo, PUT: la API usa POST para actualizar). */
    public const METHOD_NOT_ALLOWED = 'method_not_allowed';

    /** Falta el encabezado Authorization: Bearer fk_test_… o fk_live_…. */
    public const MISSING_API_KEY = 'missing_api_key';

    /** Un campo tiene un valor que no se acepta (formato, catálogo del SAT, rango). param dice cuál y message cómo corregirlo. */
    public const PARAMETER_INVALID = 'parameter_invalid';

    /** Falta un campo obligatorio. param dice cuál. */
    public const PARAMETER_MISSING = 'parameter_missing';

    /** Mandó un campo que no existe (casi siempre un nombre mal escrito, como legalName en vez de legal_name). Nunca se ignora en silencio. */
    public const PARAMETER_UNKNOWN = 'parameter_unknown';

    /** El recibo de nómina no se puede calcular o timbrar con esos datos (periodo, días, registro patronal del emisor…). */
    public const PAYROLL_INVALID = 'payroll_invalid';

    /** La cotización no tiene los datos fiscales del cliente: agrégueselos con POST /v1/quotes/{id} (customer) o mándela con auto_invoice para que los dé al aceptarla. */
    public const QUOTE_CUSTOMER_MISSING = 'quote_customer_missing';

    /** La cotización no se pudo guardar o ya no cambia (aceptada, rechazada o facturada), o no se puede mandar así. El mensaje dice por qué. */
    public const QUOTE_INVALID = 'quote_invalid';

    /** Solo se borra una cotización que nunca se envió. */
    public const QUOTE_NOT_DRAFT = 'quote_not_draft';

    /** La cotización se rechazó o venció: no se factura. Si venció, cámbiele valid_until (es una versión nueva). */
    public const QUOTE_NOT_INVOICEABLE = 'quote_not_invoiceable';

    /** Demasiadas solicitudes con la llave. Espere lo que dice Retry-After y reintente. */
    public const RATE_LIMIT = 'rate_limit';

    /** La factura recurrente no se pudo guardar: el día, la hora, la zona o la factura no son válidos. El mensaje dice cuál. */
    public const RECURRING_INVALID = 'recurring_invalid';

    /** El emisor ya tiene el máximo de facturas recurrentes activas (25 en pruebas, 5,000 en producción). Pause o borre las que ya no use. */
    public const RECURRING_LIMIT = 'recurring_limit';

    /** Aún no toca timbrar la factura recurrente (409): su next_invoice_on es después de hoy. Para una factura antes de tiempo, use POST /v1/invoices. */
    public const RECURRING_NOT_DUE = 'recurring_not_due';

    /** La factura recurrente está en pausa: reanúdela con active: true para timbrarla. */
    public const RECURRING_PAUSED = 'recurring_paused';

    /** Otra solicitud con la misma Idempotency-Key sigue en proceso. Espere un momento y repítala. */
    public const REQUEST_IN_PROGRESS = 'request_in_progress';

    /** No existe un objeto con ese id (o es de otro emisor o del otro modo). */
    public const RESOURCE_MISSING = 'resource_missing';

    /** La constancia de retenciones no cumple una regla del SAT. No se usó ningún timbre. */
    public const RETENTION_INVALID = 'retention_invalid';

    /** La acción es para constancias timbradas. */
    public const RETENTION_NOT_STAMPED = 'retention_not_stamped';

    /** El PAC o el SAT no aceptaron la constancia; sat_code trae su código. */
    public const RETENTION_REJECTED = 'retention_rejected';

    /** No existe esa ruta. Revise la dirección y la versión (/v1). */
    public const ROUTE_NOT_FOUND = 'route_not_found';

    /** No se pudo crear el entorno de prueba: falta su nombre o la cuenta ya tiene 25 (borre uno que ya no use). */
    public const SANDBOX_INVALID = 'sandbox_invalid';

    /** El SAT rechazó la solicitud de descarga. El mensaje trae su motivo, por ejemplo que ya se pidió el mismo periodo con los mismos filtros demasiadas veces (el SAT pone un límite de por vida). */
    public const SAT_REQUEST_REJECTED = 'sat_request_rejected';

    /** Demasiados timbres seguidos del mismo emisor. Espere lo que dice Retry-After; para muchas facturas use POST /v1/invoice_batches. */
    public const STAMP_RATE_LIMIT = 'stamp_rate_limit';

    /** Esa tienda ya está conectada a este emisor. */
    public const STORE_ALREADY_CONNECTED = 'store_already_connected';

    /** La tienda no aceptó la conexión o no respondió como se esperaba (llaves equivocadas, permisos read_orders/write_orders que faltan, una tienda que no vende en pesos). El mensaje dice qué contestó. */
    public const STORE_CONNECTION_FAILED = 'store_connection_failed';

    /** La tienda se desconectó: conéctela otra vez con POST /v1/store_connections. */
    public const STORE_DISCONNECTED = 'store_disconnected';

    /** El vendedor aún no autoriza la conexión en authorize_url. */
    public const STORE_NOT_AUTHORIZED = 'store_not_authorized';

    /** Esa plataforma aún no está disponible en Fiscalisto. */
    public const STORE_PLATFORM_UNAVAILABLE = 'store_platform_unavailable';

    /** Los complementos de pago y las notas de crédito no se sustituyen: se cancelan y se emite otro. */
    public const SUBSTITUTION_UNSUPPORTED = 'substitution_unsupported';

    /** Esto solo existe en pruebas (como reiniciar los datos de prueba): use su llave fk_test_. */
    public const TEST_MODE_ONLY = 'test_mode_only';

    /** Ese folio ya está registrado para el emisor con otro total o con otra propina (409). Con el mismo total se contesta el ticket que ya existe. */
    public const TICKET_FOLIO_TAKEN = 'ticket_folio_taken';

    /** El ticket no se pudo registrar: el folio trae caracteres no válidos, la fecha de venta está en el futuro o es de hace más de un año, el producto ya no está en el catálogo… El mensaje dice cuál. */
    public const TICKET_INVALID = 'ticket_invalid';

    /** El ticket ya se facturó o entró en una factura global: no se puede cancelar. */
    public const TICKET_NOT_PENDING = 'ticket_not_pending';

    /** La API no contestó a tiempo (connection_error). Con lo que timbra, repita con la misma Idempotency-Key para saber si se timbró. */
    public const TIMEOUT = 'timeout';

    /** Mande el cuerpo con Content-Type: application/json. */
    public const UNSUPPORTED_CONTENT_TYPE = 'unsupported_content_type';
}
