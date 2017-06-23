<?php

namespace App;

class OperatorNode implements Node
{
    protected $left;
    protected $right;

    public function __construct($left, $right)
    {
        $this->left = $left;
        $this->right = $right;
    }
}
