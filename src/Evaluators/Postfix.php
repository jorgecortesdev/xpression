<?php

namespace App\Evaluators;

use App\Collections\Queue;
use App\Collections\Stack;

class Postfix implements Evaluator
{
    protected $queue;

    public $stack;

    protected $nodes = [
        '+' => 'App\Evaluators\Nodes\AdditionNode',
        '/' => 'App\Evaluators\Nodes\DivisionNode',
        '*' => 'App\Evaluators\Nodes\MultiplicationNode',
        '^' => 'App\Evaluators\Nodes\ExponentialNode',
        '-' => 'App\Evaluators\Nodes\SubstractionNode',
    ];

    public function __construct()
    {
        $this->stack = new Stack();
    }

    public function tokens(array $tokens)
    {
        $this->queue = new Queue($tokens);

        return $this;
    }

    public function evaluate()
    {
        while ( ! $this->queue->empty()) {
            $token = $this->queue->dequeue();
            if (is_numeric($token)) {
                $this->stack->push($token);
                continue;
            }

            $class = $this->nodes[$token];
            $value = (new $class($this))->evaluate();

            $this->stack->push($value);
        }
        return $this->stack->pop();
    }
}
