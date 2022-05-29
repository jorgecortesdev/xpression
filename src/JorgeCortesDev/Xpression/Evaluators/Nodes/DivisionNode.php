<?php

namespace JorgeCortesDev\Xpression\Evaluators\Nodes;

class DivisionNode extends Node
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
        return $leftOperand / $rightOperand;
    }
}
