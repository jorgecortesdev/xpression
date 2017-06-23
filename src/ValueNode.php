<?php

namespace App;

class ValueNode extends Node
{
    protected $value;

    public function __construct($value)
    {
        $this->value = (int) trim($value);
    }

    public function evaluate()
    {
        return $this->value;
    }
}