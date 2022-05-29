<?php

namespace JorgeCortesDev\Xpression\Algorithms\Rules;

use JorgeCortesDev\Xpression\Algorithms\ShuntingYard;

class IsRightBrace
{
    /**
     * Check if the token is right brace.
     *
     * @param ShuntingYard $algorithm
     * @param string $token
     * @return bool
     */
    public function check(ShuntingYard $algorithm, string $token): bool
    {
        if ($token !== ')') {
            return false;
        }

        while ($algorithm->operators->peek() != '(') {
            $algorithm->output->enqueue($algorithm->operators->pop());
        }

        $algorithm->operators->pop();

        return true;
    }
}
