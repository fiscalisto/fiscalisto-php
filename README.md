# fiscalisto/fiscalisto

El SDK de la [API de facturación de Fiscalisto](https://fiscalisto.com/docs/api): timbre CFDI 4.0 (facturas, pagos, notas de crédito, nómina, retenciones y lotes) desde PHP.

- La forma de cada arreglo documentada para PHPStan, Psalm y su editor, con la descripción de cada campo y su nombre en el XML del SAT.
- `Idempotency-Key` automática en cada `POST`: un reintento nunca timbra, crea ni manda nada dos veces.
- Reintentos solo de lo que es seguro repetir.
- Listas que se recorren solas con `foreach`.
- Webhooks verificados en una línea.
- Sin dependencias: PHP 8.1 o más reciente, con `curl` y `json`.

```bash
composer require fiscalisto/fiscalisto
```

```php
use Fiscalisto\Fiscalisto;

$fiscalisto = new Fiscalisto(); // la llave viene de FISCALISTO_API_KEY

$invoice = $fiscalisto->invoices->create([
    'customer' => ['tax_id' => 'ICV060329BY0', 'legal_name' => 'INMOBILIARIA CVA', 'tax_system' => '601', 'zip' => '33826'],
    'payment_form' => '03',
    'items' => [['description' => 'Mensualidad', 'product_key' => '86121700', 'quantity' => 2, 'unit_price' => 2500]],
], ['idempotency_key' => 'pedido-A-1042']);

echo $invoice['uuid'], ' ', $invoice['total'];
```

La guía completa está en [fiscalisto.com/docs/api/sdk](https://fiscalisto.com/docs/api/sdk) y cada página de la [referencia](https://fiscalisto.com/docs/api) trae su ejemplo con el SDK.

## Con agentes de IA

Para que Claude Code, Cursor, Codex u otro agente integre Fiscalisto, conecte el servidor MCP de la documentación (sin llave) y pídale que empiece con `get_started`:

```bash
claude mcp add --transport http fiscalisto-docs https://fiscalisto.com/docs/api/mcp
```

La guía de integración en una página está en [fiscalisto.com/docs/api/SKILL.md](https://fiscalisto.com/docs/api/SKILL.md) y el índice de la documentación para agentes en [llms.txt](https://fiscalisto.com/docs/api/llms.txt). Otros clientes y más: [fiscalisto.com/docs/api/agentes](https://fiscalisto.com/docs/api/agentes).

## Desarrollo

`src/FiscalistoApi.php` y `src/Resources/` se generan desde la especificación OpenAPI con `bun run openapi` en la raíz del repositorio; no los edite. Lo demás se escribe a mano.

```bash
php tests/run.php
vendor/bin/phpstan analyse
```
