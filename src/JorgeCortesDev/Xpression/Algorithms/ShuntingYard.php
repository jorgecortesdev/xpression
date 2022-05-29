<?php

namespace JorgeCortesDev\Xpression\Algorithms;

use JorgeCortesDev\Xpression\Algorithms\Rules\IsLeftBrace;
use JorgeCortesDev\Xpression\Algorithms\Rules\IsNumeric;
use JorgeCortesDev\Xpression\Algorithms\Rules\IsOperator;
use JorgeCortesDev\Xpression\Algorithms\Rules\IsRightBrace;
use JorgeCortesDev\Xpression\Collections\Queue;
use JorgeCortesDev\Xpression\Collections\Stack;

class ShuntingYard implements Algorithm
{
    /**
     * The tokens ordered for be processed.
     *
     * @var \JorgeCortesDev\Xpression\Collections\Queue
     */
    public Queue $output;

    /**
     * Used to stack the operators during the process.
     *
     * @var \JorgeCortesDev\Xpression\Collections\Stack
     */
    public Stack $operators;

    /**
     * Array of rules.
     *
     * @var array
     */
    protected $rules;

    public function __construct()
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

        while (! $this->operators->empty()) {
            $this->output->enqueue($this->operators->pop());
        }

        return $this->output->toArray();
    }
}
