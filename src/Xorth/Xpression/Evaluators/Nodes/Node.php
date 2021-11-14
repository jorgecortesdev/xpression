<?php

namespace Xorth\Xpression\Evaluators\Nodes;

use Xorth\Xpression\Evaluators\Evaluator;

abstract class Node
{
    /**
     * Evaluator class
     *
     * @var Evaluator
     */
    protected Evaluator $evaluator;

    /**
     * Make a new instance of a Node.
     *
     * @param Evaluator $evaluator
     */
    public function __construct(Evaluator $evaluator)
    {
        $this->evaluator = $evaluator;
    }

    /**
     * Evaluate the expression.
     *
     * @return integer|float
     */
    abstract public function evaluate(): float|int;
}