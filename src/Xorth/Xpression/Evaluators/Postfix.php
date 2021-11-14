<?php

namespace Xorth\Xpression\Evaluators;

use Xorth\Xpression\Collections\Queue;
use Xorth\Xpression\Collections\Stack;

class Postfix implements Evaluator
{
    /**
     * A stack to save the results.
     *
     * @var Stack
     */
    public Stack $stack;
    /**
     * A queue of tokens.
     *
     * @var Queue
     */
    protected Queue $queue;
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
        '-' => 'Xorth\Xpression\Evaluators\Nodes\SubtractionNode',
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
     * @param array $tokens
     * @return $this
     */
    public function tokens(array $tokens): static
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
    public function evaluate(): float|int
    {
        while (!$this->queue->empty()) {
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
