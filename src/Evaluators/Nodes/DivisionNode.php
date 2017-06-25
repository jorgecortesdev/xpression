<?php

namespace App\Evaluators\Nodes;

class DivisionNode extends Node
{
    public function evaluate()
    {
        $rightOperand = $this->evaluator->stack->pop();
        $leftOperand = $this->evaluator->stack->pop();
        return $leftOperand / $rightOperand;
    }
}
