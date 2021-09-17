<?php

namespace Samsara\Descartes\Simulation\Base;

use Samsara\Descartes\Simulation\Base\Interfaces\SimulationInterface;

abstract class Simulation implements SimulationInterface
{

    private static self $instance;

    private array $nodes;
    private array $actors;

    public static function get(): static
    {
        if (!isset(static::$instance)) {
            static::$instance = new static::class;
        }

        return static::$instance;
    }

    public function getNode(int|string $index)
    {
        // TODO: Implement getNode() method.
    }

    public function addNode(int|string $index, $node)
    {
        // TODO: Implement addNode() method.
    }

    public function destroyNode(int|string $index)
    {
        // TODO: Implement destroyNode() method.
    }

    public function mapNodes(callable $callable)
    {
        // TODO: Implement mapNodes() method.
    }

    public function getActor(int|string $index)
    {
        // TODO: Implement getActor() method.
    }

    public function addActor(int|string $index, $actor)
    {
        // TODO: Implement addActor() method.
    }

    public function destroyActor(int|string $index)
    {
        // TODO: Implement destroyActor() method.
    }

    public function mapActors(callable $callable)
    {
        // TODO: Implement mapActors() method.
    }

}