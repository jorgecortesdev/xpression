<?php

namespace Xorth\Xpression\Evaluators\Nodes;

class MultiplicationNode extends Node
{
    /**
     * Evaluate the expression.
     *
     * @return integer|float
     */
    public function evaluate(): float|int
    {
        $rightOperand = $this->evaluator->stack->pop();
        $leftOperand = $this->evaluator->stack->pop();
        return $leftOperand * $rightOperand;
    }
}
