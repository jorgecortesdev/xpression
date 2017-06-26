<?php

namespace Xorth\Xpression\Evaluators;

interface Evaluator
{
    /**
     * Set the tokens to process.
     *
     * @param  array  $tokens
     * @return $this
     */
    public function tokens(array $tokens);

    /**
     * Evaluate the setted tokens to reduce them
     * to a number.
     *
     * @return integer|float
     */
    public function evaluate();
}