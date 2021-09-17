<?php

namespace Samsara\Descartes\Collections\Base;

use Ds\Map;
use JetBrains\PhpStorm\Pure;

abstract class DescartesCollection implements \ArrayAccess, \Countable, \IteratorAggregate
{

    protected Map $register;

    public function offsetExists($offset): bool
    {
        return $this->register->offsetExists($offset);
    }

    public function offsetGet($offset): mixed
    {
        return $this->register->offsetGet($offset);
    }

    public function offsetUnset($offset): void
    {
        $this->register->offsetUnset($offset);
    }

    #[Pure]
    public function count(): int
    {
        return $this->register->count();
    }

    public function getIterator(): \Generator
    {
        return $this->register->getIterator();
    }
}