<?php

namespace App\Evaluators\Nodes;

abstract class Node
{
    protected $evaluator;

    public function __construct($evaluator)
    {
        $this->evaluator = $evaluator;
    }

    abstract public function evaluate();
}