<?php

namespace Microit\StoreBase\Collections;

use Countable;
use Iterator;

/**
 * @template-implements Iterator<array-key, mixed>
 */
abstract class Collection implements Countable, Iterator
{
    protected array $values = [];

    protected int $position = 0;

    public function current(): mixed
    {
        return $this->values[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->values[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function count(): int
    {
        return count($this->values);
    }
}
