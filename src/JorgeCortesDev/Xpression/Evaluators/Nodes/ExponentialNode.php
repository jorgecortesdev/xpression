<?php

namespace JorgeCortesDev\Xpression\Evaluators\Nodes;

class ExponentialNode extends Node
{
    /**
     * Evaluate the expression.
     *
     * @return int|float
     */
    public function evaluate(): float|int
    {
        $rightOperand = $this->evaluator->stack->pop();
        $leftOperand = $this->evaluator->stack->pop();

        return $leftOperand ** $rightOperand;
    }
}
