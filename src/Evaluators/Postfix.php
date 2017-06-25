<?php

namespace App\Evaluators;

use App\Collections\Queue;
use App\Collections\Stack;

class Postfix implements Evaluator
{
    protected $queue;
    protected $stack;

    public function __construct(array $tokens)
    {
        $this->queue = new Queue($tokens);
        $this->stack = new Stack();
    }

    public function evaluate()
    {
        while ( ! $this->queue->empty()) {
            $token = $this->queue->dequeue();
            if (is_numeric($token)) {
                $this->stack->push($token);
                continue;
            }

            $rightOperand = $this->stack->pop();
            $leftOperand = $this->stack->pop();
            $expression = $leftOperand . $token . $rightOperand;
            $value = eval("return ({$expression});");
            $this->stack->push($value);
        }
        return $this->stack->pop();
    }
}
