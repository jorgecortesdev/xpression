<?php

namespace App\Algorithms\Rules;

class IsNumeric
{
    public function check($algorithm, $token)
    {
        if (is_numeric($token)) {
            $algorithm->output->enqueue($token);
            return true;
        }

        return false;
    }
}