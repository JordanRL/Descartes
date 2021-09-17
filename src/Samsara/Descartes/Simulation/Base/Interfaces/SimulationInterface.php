<?php


namespace Samsara\Descartes\Simulation\Base\Interfaces;


interface SimulationInterface
{

    /*
     * Node related functions
     */
    public function getNode(int|string $index);
    public function addNode(int|string $index, $node);
    public function destroyNode(int|string $index);
    public function mapNodes(callable $callable);

    /*
     * Actor related functions
     */
    public function getActor(int|string $index);
    public function addActor(int|string $index, $actor);
    public function destroyActor(int|string $index);
    public function mapActors(callable $callable);

}