<?php

namespace JorgeCortesDev\Xpression\Evaluators;

use JorgeCortesDev\Xpression\Collections\Queue;
use JorgeCortesDev\Xpression\Collections\Stack;

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
        '+' => 'JorgeCortesDev\Xpression\Evaluators\Nodes\AdditionNode',
        '/' => 'JorgeCortesDev\Xpression\Evaluators\Nodes\DivisionNode',
        '*' => 'JorgeCortesDev\Xpression\Evaluators\Nodes\MultiplicationNode',
        '^' => 'JorgeCortesDev\Xpression\Evaluators\Nodes\ExponentialNode',
        '-' => 'JorgeCortesDev\Xpression\Evaluators\Nodes\SubtractionNode',
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
     * @return int|float
     */
    public function evaluate(): float|int
    {
        while (! $this->queue->empty()) {
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
