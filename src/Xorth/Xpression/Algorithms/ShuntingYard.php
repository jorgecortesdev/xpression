<?php

namespace Xorth\Xpression\Algorithms;

use Xorth\Xpression\Algorithms\Rules\IsLeftBrace;
use Xorth\Xpression\Algorithms\Rules\IsNumeric;
use Xorth\Xpression\Algorithms\Rules\IsOperator;
use Xorth\Xpression\Algorithms\Rules\IsRightBrace;
use Xorth\Xpression\Collections\Queue;
use Xorth\Xpression\Collections\Stack;

class ShuntingYard implements Algorithm
{
    /**
     * The tokens ordered for be processed.
     *
     * @var \Xorth\Xpression\Collections\Queue
     */
    public Queue $output;

    /**
     * Used to stack the operators during the process.
     *
     * @var \Xorth\Xpression\Collections\Stack
     */
    public Stack $operators;

    /**
     * Array of rules.
     *
     * @var array
     */
    protected $rules;

    function __construct()
    {
        $this->output = new Queue();
        $this->operators = new Stack();

        $this->rules[] = new IsNumeric();
        $this->rules[] = new IsOperator();
        $this->rules[] = new IsLeftBrace();
        $this->rules[] = new IsRightBrace();
    }

    /**
     * Method to apply the algorithm to an array
     * of tokens to transform it to a notation
     * that can be evaluated.
     *
     * @param array $tokens
     * @return array
     */
    public function apply(array $tokens): array
    {
        foreach ($tokens as $token) {
            foreach ($this->rules as $rule) {
                if ($rule->check($this, $token)) {
                    continue;
                }
            }
        }

        while (!$this->operators->empty()) {
            $this->output->enqueue($this->operators->pop());
        }

        return $this->output->toArray();
    }
}
