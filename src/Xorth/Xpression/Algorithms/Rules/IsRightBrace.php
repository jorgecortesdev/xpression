<?php

namespace Xorth\Xpression\Algorithms\Rules;

class IsRightBrace
{
    /**
     * Check if the token is right brace.
     *
     * @param  \Xorth\Xpression\Algorithms\ShuntingYard $algorithm
     * @param  string $token
     * @return boolean
     */
    public function check($algorithm, $token)
    {
        if ($token !== ')') {
            return false;
        }

        while($algorithm->operators->peek() != '(') {
            $algorithm->output->enqueue($algorithm->operators->pop());
        }

        $algorithm->operators->pop();

        return true;

    }
}