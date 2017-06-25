<?php

namespace App;

use App\Algorithms\Algorithm;
use App\Evaluators\Evaluator;
use App\Tokenizers\Tokenizer;

class Calculator
{
    protected $tokenizer;
    protected $algorithm;
    protected $evaluator;

    protected $tokens;

    public function __construct(Tokenizer $tokenizer, Algorithm $algorithm, Evaluator $evaluator)
    {
        $this->tokenizer = $tokenizer;
        $this->algorithm = $algorithm;
        $this->evaluator = $evaluator;
    }

    public function read($expresion)
    {
        $this->tokens = $this->tokenizer->process($expresion);

        return $this;
    }

    public function evaluate()
    {
        return $this->evaluator->tokens(
            $this->algorithm->apply($this->tokens)
        )->evaluate();
    }

}