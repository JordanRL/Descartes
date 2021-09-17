<?php

namespace Samsara\Descartes\Collections;

use Samsara\Descartes\Simulation\Base\Interfaces\LiveDataInterface;
use Samsara\Exceptions\UsageError\IntegrityConstraint;

final class LiveDataCollection extends Base\DescartesCollection
{

    /**
     * @inheritDoc
     * @throws IntegrityConstraint
     */
    public function offsetSet($offset, $value)
    {
        if (($value instanceof LiveDataInterface) !== true) {
            throw new IntegrityConstraint(
                'LiveDataCollection can only accept instances of LiveDataInterface',
                'Use the collection only with the correct instances',
                'The LiveDataCollection class can only store values which are instances of LiveDataInterface'
            );
        }

        $this->register->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return LiveDataInterface
     */
    public function offsetGet($offset): LiveDataInterface
    {
        return parent::offsetGet($offset);
    }
}