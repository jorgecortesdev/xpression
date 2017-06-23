<?php

namespace App;

class AdditionNode extends OperatorNode
{
    public function evaluate()
    {
        return $this->left->evaluate() + $this->right->evaluate();
    }
}
