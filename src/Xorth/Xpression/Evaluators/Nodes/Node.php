<?php

namespace Xorth\Xpression\Evaluators\Nodes;

abstract class Node
{
    /**
     * Evaluator class
     *
     * @var \Xorth\Xpression\Evaluators\Evaluator
     */
    protected $evaluator;

    /**
     * Make a new instance of a Node.
     *
     * @param \Xorth\Xpression\Evaluators\Evaluator $evaluator
     */
    public function __construct($evaluator)
    {
        $this->evaluator = $evaluator;
    }

    /**
     * Evaluate the exprssion.
     *
     * @return integer|float
     */
    abstract public function evaluate();
}