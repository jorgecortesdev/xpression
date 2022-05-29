<?php

namespace JorgeCortesDev\Xpression\Algorithms\Rules;

use JorgeCortesDev\Xpression\Algorithms\ShuntingYard;

class IsNumeric
{
    /**
     * Check if the token is numeric.
     *
     * @param ShuntingYard $algorithm
     * @param string $token
     * @return bool
     */
    public function check(ShuntingYard $algorithm, string $token): bool
    {
        if (! is_numeric($token)) {
            return false;
        }

        $algorithm->output->enqueue((int)$token);

        return true;
    }
}
