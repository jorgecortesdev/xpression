<?php

namespace App;

class Stack
{
    protected $stack;

    public function __construct(array $stack = null)
    {
        $this->stack = $stack ?? [];
    }

    public function empty()
    {
        return empty($this->stack);
    }

    public function peek()
    {
        return end($this->stack);
    }

    public function pop()
    {
        return array_pop($this->stack);
    }

    public function push($item)
    {
        array_push($this->stack, $item);

        return $this;
    }

    public function __toString()
    {
        return implode(' ', $this->stack);
    }

    public function toArray()
    {
        return $this->stack;
    }
}
