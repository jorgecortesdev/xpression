<?php

namespace App;

class MultiplicationNode extends OperatorNode
{
    public function evaluate()
    {
        return $this->left->evaluate() * $this->right->evaluate();
    }
}
