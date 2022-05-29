<?php

namespace JorgeCortesDev\Xpression;

use JorgeCortesDev\Xpression\Algorithms\Algorithm;
use JorgeCortesDev\Xpression\Evaluators\Evaluator;
use JorgeCortesDev\Xpression\Tokenizers\Tokenizer;

class Calculator
{
    /**
     * Class needed to tokenize the expression.
     *
     * @var Tokenizer
     */
    protected Tokenizer $tokenizer;

    /**
     * The algorithm class to process the expression.
     *
     * @var Algorithm
     */
    protected Algorithm $algorithm;

    /**
     * The evaluator class to grab the result.
     *
     * @var Evaluator
     */
    protected Evaluator $evaluator;

    /**
     * The tokens to process.
     *
     * @var array
     */
    protected array $tokens;

    /**
     * Make a new instance of calculator.
     *
     * @param Tokenizer $tokenizer
     * @param Algorithm $algorithm
     * @param Evaluator $evaluator
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
     * @param string $expression
     * @return $this
     */
    public function read(string $expression): static
    {
        $this->tokens = $this->tokenizer->process($expression);

        return $this;
    }

    /**
     * Evaluate the expression and return the result.
     *
     * @return integer|float
     */
    public function evaluate(): float|int
    {
        return $this->evaluator->tokens(
            $this->algorithm->apply($this->tokens)
        )->evaluate();
    }
}
