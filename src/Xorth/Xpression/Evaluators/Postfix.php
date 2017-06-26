<?php

namespace Xorth\Xpression\Evaluators;

use Xorth\Xpression\Collections\Queue;
use Xorth\Xpression\Collections\Stack;

class Postfix implements Evaluator
{
    /**
     * A queue of tokens.
     *
     * @var \Xorth\Xpression\Collections\Queue
     */
    protected $queue;

    /**
     * A stack to save the results.
     *
     * @var \Xorth\Xpression\Collections\Stack
     */
    public $stack;

    /**
     * Evaluators nodes.
     *
     * @var array
     */
    protected $nodes = [
        '+' => 'Xorth\Xpression\Evaluators\Nodes\AdditionNode',
        '/' => 'Xorth\Xpression\Evaluators\Nodes\DivisionNode',
        '*' => 'Xorth\Xpression\Evaluators\Nodes\MultiplicationNode',
        '^' => 'Xorth\Xpression\Evaluators\Nodes\ExponentialNode',
        '-' => 'Xorth\Xpression\Evaluators\Nodes\SubstractionNode',
    ];

    /**
     * Make a new Postfix instance.
     */
    public function __construct()
    {
        $this->stack = new Stack();
    }

    /**
     * Set the tokens to process.
     *
     * @param  array  $tokens
     * @return $this
     */
    public function tokens(array $tokens)
    {
        $this->queue = new Queue($tokens);

        return $this;
    }

    /**
     * Evaluate the setted tokens to reduce them
     * to a number.
     *
     * @return integer|float
     */
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
