<?php

namespace App\Algorithms;

use App\Collections\Queue;
use App\Collections\Stack;
use App\Algorithms\Rules\IsNumeric;
use App\Algorithms\Rules\IsOperator;
use App\Algorithms\Rules\IsLeftBrace;
use App\Algorithms\Rules\IsRightBrace;

class ShuntingYard implements Algorithm
{
    public $output;

    public $operators;

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

    public function apply(array $tokens)
    {
        foreach ($tokens as $step => $token) {
            foreach ($this->rules as $rule) {
                if ($rule->check($this, $token)) {
                    continue;
                }
            }
        }

        while ( ! $this->operators->empty()) {
            $this->output->enqueue($this->operators->pop());
        }

        return $this->output->toArray();
    }
}
