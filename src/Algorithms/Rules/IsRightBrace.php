<?php

namespace App\Algorithms\Rules;

class IsRightBrace
{
    public function check($algorithm, $token)
    {
        if ($token === ')') {
            while($algorithm->operators->peek() != '(') {
                $algorithm->output->enqueue($algorithm->operators->pop());
            }
            $algorithm->operators->pop();

            return true;
        }

        return false;
    }
}