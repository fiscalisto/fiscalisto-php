<?php

declare(strict_types=1);

namespace Fiscalisto;

/**
 * Una lista: data y hasMore son la primera página; recorrerla con foreach da todos los objetos,
 * página por página.
 *
 * @template T of array<string, mixed>
 * @implements \IteratorAggregate<int, T>
 * @implements \ArrayAccess<string, mixed>
 */
final class Collection implements \IteratorAggregate, \ArrayAccess
{
    /** @var array{object: string, data: list<T>, has_more: bool, url: string}|null */
    private ?array $first = null;

    /** @param \Closure(?string): array{object: string, data: list<T>, has_more: bool, url: string} $page */
    /** $forward: with ending_before, pages go to newer ones, each read oldest first. */
    public function __construct(private readonly \Closure $page, private readonly bool $forward = false)
    {
    }

    /**
     * La primera página, como la contesta la API (object, data, has_more, url).
     *
     * @return array{object: string, data: list<T>, has_more: bool, url: string}
     */
    public function firstPage(): array
    {
        return $this->first ??= ($this->page)(null);
    }

    /** @return list<T> */
    public function data(): array
    {
        return $this->firstPage()['data'];
    }

    public function hasMore(): bool
    {
        return (bool) $this->firstPage()['has_more'];
    }

    /** @return \Generator<int, T> */
    public function getIterator(): \Generator
    {
        $page = $this->firstPage();
        while (true) {
            yield from $this->forward ? array_reverse($page['data']) : $page['data'];
            $last = $page['data'] === [] ? null : $page['data'][$this->forward ? 0 : count($page['data']) - 1];
            if (!$page['has_more'] || $last === null) {
                return;
            }
            $id = $last['id'] ?? null;
            if (!is_string($id)) {
                return;
            }
            $page = ($this->page)($id);
        }
    }

    /** $lista['data'], $lista['has_more']: la primera página como arreglo, igual que antes de que la ruta tuviera páginas. */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->firstPage()[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->firstPage()[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \LogicException('Una lista de la API no se cambia.');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \LogicException('Una lista de la API no se cambia.');
    }

    /**
     * Todos los objetos en un arreglo, hasta $max (por omisión 10,000).
     *
     * @return list<T>
     */
    public function toArray(int $max = 10_000): array
    {
        $all = [];
        foreach ($this as $item) {
            if (count($all) >= $max) {
                break;
            }
            $all[] = $item;
        }
        return $all;
    }
}
