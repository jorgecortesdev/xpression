<?php

namespace Xorth\Xpression\Algorithms\Rules;

class IsLeftBrace
{
    /**
     * Check if the token is left brace.
     *
     * @param  \Xorth\Xpression\Algorithms\ShuntingYard $algorithm
     * @param  string $token
     * @return boolean
     */
    public function check($algorithm, $token)
    {
        if ($token !== '(') {
            return false;
        }

        $algorithm->operators->push($token);
        return true;

    }
}