<?php

namespace Xorth\Xpression\Tokenizers;

class SimpleTokenizer implements Tokenizer
{
    /**
     * Processes an infix notation string to split
     * it in tokens.
     *
     * in tokens.
     *
     * @param string $expression
     * @return array
     */
    public function process(string $expression): array
    {
        return explode(' ', $expression);
    }
}