<?php

namespace App\Collections;

use Countable;

class Stack implements Countable
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

    public function peek()
    {
        return end($this->items);
    }

    public function pop()
    {
        return array_pop($this->items);
    }

    public function push($item)
    {
        $this->items[] = $item;

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
