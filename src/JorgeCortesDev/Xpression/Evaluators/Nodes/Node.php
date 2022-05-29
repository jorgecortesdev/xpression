<?php

namespace JorgeCortesDev\Xpression\Evaluators\Nodes;

use JorgeCortesDev\Xpression\Evaluators\Evaluator;

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
     * @return int|float
     */
    abstract public function evaluate(): float|int;
}
