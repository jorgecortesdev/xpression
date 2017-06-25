<?php

namespace App\Collections;

use Countable;

class Queue implements Countable
{
    protected $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function empty()
    {
        return empty($this->items);
    }

    public function getFront()
    {
        return current(reset($this->items));
    }

    public function dequeue()
    {
        return array_shift($this->items);
    }

    public function enqueue($item)
    {
        array_push($this->items, $item);

        return $this;
    }

    public function __toString()
    {
        return implode(' ', $this->items);
    }

    public function toArray()
    {
        return $this->items;
    }

    public function count()
    {
        return count($this->items);
    }
}
