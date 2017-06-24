<?php

namespace App;

class Queue
{
    protected $queue;

    public function __construct(array $queue = null)
    {
        $this->queue = $queue ?? [];
    }

    public function empty()
    {
        return empty($this->queue);
    }

    public function getFront()
    {
        return current(reset($this->queue));
    }

    public function dequeue()
    {
        return array_shift($this->queue);
    }

    public function enqueue($item)
    {
        array_push($this->queue, $item);

        return $this;
    }

    public function __toString()
    {
        return implode(' ', $this->queue);
    }


    public function toArray()
    {
        return $this->queue;
    }
}
