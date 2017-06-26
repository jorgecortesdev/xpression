<?php

namespace Xorth\Xpression\Algorithms\Rules;

class IsNumeric
{
    /**
     * Check if the token is numeric.
     *
     * @param  \Xorth\Xpression\Algorithms\ShuntingYard $algorithm
     * @param  string $token
     * @return boolean
     */
    public function check($algorithm, $token)
    {
        if ( ! is_numeric($token)) {
            return false;
        }

        $algorithm->output->enqueue((int) $token);
        return true;
    }
}