<?php


namespace Samsara\Descartes\Simulation;

use Samsara\Descartes\Simulation\Base\FieldAwareSimulation;

class TwoDGridSimulation extends FieldAwareSimulation
{

    private array $xRange;
    private array $yRange;

    public function setGridRange(array $xRange, array $yRange): self
    {
        $this->xRange = $xRange;
        $this->yRange = $yRange;

        return $this;
    }

}