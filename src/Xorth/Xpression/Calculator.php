<?php

namespace Xorth\Xpression;

use Xorth\Xpression\Algorithms\Algorithm;
use Xorth\Xpression\Evaluators\Evaluator;
use Xorth\Xpression\Tokenizers\Tokenizer;

class Calculator
{
    /**
     * Class needed to tokenize the expression.
     *
     * @var \Xorth\Xpression\Tokenizers\Tokenizer
     */
    protected $tokenizer;

    /**
     * The algorithm class to process the expression.
     *
     * @var \Xorth\Xpression\Algorithms\Algorithm
     */
    protected $algorithm;

    /**
     * The evaluator class to grab the result.
     *
     * @var \Xorth\Xpression\Evaluators\Evaluator
     */
    protected $evaluator;

    /**
     * The tokens to process.
     *
     * @var array
     */
    protected $tokens;

    /**
     * Make a new instance of calculator.
     *
     * @param Tokenizer $tokenizers
     * @param Algorithm $algorithms
     * @param Evaluator $evaluators
     */
    public function __construct(Tokenizer $tokenizer, Algorithm $algorithm, Evaluator $evaluator)
    {
        $this->tokenizer = $tokenizer;
        $this->algorithm = $algorithm;
        $this->evaluator = $evaluator;
    }

    /**
     * Read the expression to process.
     *
     * @param string $expresion
     * @return $this
     */
    public function read($expresion)
    {
        $this->tokens = $this->tokenizer->process($expresion);

        return $this;
    }

    /**
     * Evaluate the expression and return the result.
     *
     * @return integer|float
     */
    public function evaluate()
    {
        return $this->evaluator->tokens(
            $this->algorithm->apply($this->tokens)
        )->evaluate();
    }
}
