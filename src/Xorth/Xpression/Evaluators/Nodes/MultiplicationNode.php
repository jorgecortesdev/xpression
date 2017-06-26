<?php

namespace Xorth\Xpression\Evaluators\Nodes;

class MultiplicationNode extends Node
{
    /**
     * Evaluate the exprssion.
     *
     * @return integer|float
     */
    public function evaluate()
    {
        $rightOperand = $this->evaluator->stack->pop();
        $leftOperand = $this->evaluator->stack->pop();
        return $leftOperand * $rightOperand;
    }
}
