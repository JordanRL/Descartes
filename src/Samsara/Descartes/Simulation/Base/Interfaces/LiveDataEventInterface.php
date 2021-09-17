<?php

namespace Samsara\Descartes\Simulation\Base\Interfaces;

use Samsara\Descartes\Application;

interface LiveDataEventInterface
{

    public function __invoke(LiveDataInterface $data);

    public function setApplication(Application $application): static;

}