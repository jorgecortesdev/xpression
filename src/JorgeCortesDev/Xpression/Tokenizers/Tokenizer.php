<?php

namespace JorgeCortesDev\Xpression\Tokenizers;

interface Tokenizer
{
    /**
     * Processes an infix notation string to split
     * it in tokens.
     *
     * @param string $expression
     * @return array
     */
    public function process(string $expression): array;
}
