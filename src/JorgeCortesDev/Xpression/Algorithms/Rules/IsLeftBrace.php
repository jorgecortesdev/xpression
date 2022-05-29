<?php

namespace JorgeCortesDev\Xpression\Algorithms\Rules;

use JorgeCortesDev\Xpression\Algorithms\ShuntingYard;

class IsLeftBrace
{
    /**
     * Check if the token is left brace.
     *
     * @param ShuntingYard $algorithm
     * @param string $token
     * @return boolean
     */
    public function check(ShuntingYard $algorithm, string $token): bool
    {
        if ($token !== '(') {
            return false;
        }

        $algorithm->operators->push($token);
        return true;

    }
}