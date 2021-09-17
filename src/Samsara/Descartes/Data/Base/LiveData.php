<?php

namespace Samsara\Descartes\Data\Base;

use Ds\Map;
use Samsara\Descartes\Simulation\Base\Interfaces\LiveDataInterface;

class LiveData implements LiveDataInterface, \IteratorAggregate
{
    private Map $register;

    public function __construct()
    {
        $this->register = new Map();
    }

    public function isNull(): bool
    {
        return $this->register->isEmpty();
    }

    public function getIterator(): \Generator
    {
        return $this->register->getIterator();
    }

    public function getData($key)
    {
        return $this->register->offsetGet($key);
    }

    public function setData($key, $value): static
    {
        $this->register->offsetSet($key, $value);

        return $this;
    }

}