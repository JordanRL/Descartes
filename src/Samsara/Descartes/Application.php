<?php

namespace Samsara\Descartes;

use Evenement\EventEmitter;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;
use Samsara\Descartes\Collections\LiveDataCollection;
use Samsara\Descartes\Data\Base\LiveData;
use Samsara\Descartes\Simulation\Base\Interfaces\LiveDataEventInterface;
use Samsara\Descartes\Simulation\Base\Interfaces\LiveDataInterface;
use Samsara\Descartes\Simulation\Base\Simulation;

class Application
{

    private LoopInterface $loop;

    private LiveDataCollection $liveDataCollection;
    private EventEmitter $liveDataEvents;
    private EventEmitter $gridEvents;

    private int|float $liveDataInterval;
    private int|float $gridInterval;

    public function __construct(int|float $liveDataInterval = 30, int|float $gridInterval = 60)
    {
        $this->loop = Loop::get();
        $this->liveDataEvents = new EventEmitter();
        $this->liveDataInterval = $liveDataInterval;
        $this->gridEvents = new EventEmitter();
        $this->gridInterval = $gridInterval;
    }

    public function processLiveData()
    {
        $this->liveDataEvents->emit('tick', []);
    }

    public function processGridUpdate()
    {
        $this->gridEvents->emit('tick', []);
    }

    public function getLiveData($key): LiveDataInterface
    {
        if ($this->liveDataCollection->offsetExists($key)) {
            $this->liveDataEvents->emit('read', [$key, $this->liveDataCollection[$key]]);
            $this->liveDataEvents->emit('read_' . $key, [$key, $this->liveDataCollection[$key]]);

            return $this->liveDataCollection[$key];
        } else {
            return new LiveData();
        }
    }

    public function addLiveData($key, LiveDataInterface $data)
    {
        if (!isset($this->liveDataCollection[$key])) {
            $this->liveDataCollection[$key] = $data;

            $this->liveDataEvents->emit('add', [$key, $data]);
        }
    }

    public function removeLiveData($key)
    {
        if (isset($this->liveDataCollection[$key])) {
            $this->liveDataEvents->emit('remove', [$key, $this->liveDataCollection[$key]]);

            unset($this->liveDataCollection[$key]);
        }
    }

    public function addLiveDataEvent($event, LiveDataEventInterface $dataEvent)
    {
        $this->liveDataEvents->on($event, $dataEvent);
    }

    public function addLiveDataEventOnce($event, LiveDataEventInterface $dataEvent)
    {
        $this->liveDataEvents->once($event, $dataEvent);
    }

    public function addTimer(int|float $timeout, callable $callback)
    {
        $this->loop->addTimer($timeout, $callback);
    }

    public function addPeriodicTimer(int|float $interval, callable $callback)
    {
        $this->loop->addPeriodicTimer($interval, $callback);
    }

    public function runSimulation()
    {

        $this->addPeriodicTimer($this->liveDataInterval, [$this, 'processLiveData']);
        $this->addPeriodicTimer($this->gridInterval, [$this, 'processGridUpdate']);

        $this->loop->run();
    }

}