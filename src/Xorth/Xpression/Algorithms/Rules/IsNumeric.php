<?php

namespace Xorth\Xpression\Algorithms\Rules;

use Xorth\Xpression\Algorithms\ShuntingYard;

class IsNumeric
{
    /**
     * Check if the token is numeric.
     *
     * @param ShuntingYard $algorithm
     * @param string $token
     * @return boolean
     */
    public function check(ShuntingYard $algorithm, string $token): bool
    {
        if (!is_numeric($token)) {
            return false;
        }

        $algorithm->output->enqueue((int)$token);
        return true;
    }
}