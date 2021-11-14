<?php

namespace Xorth\Xpression\Algorithms;

interface Algorithm
{
    /**
     * Method to apply the algorithm to an array
     * of tokens to transform it to a notation
     * that can be evaluated.
     *
     * @param array $tokens
     * @return array
     */
    public function apply(array $tokens): array;
}