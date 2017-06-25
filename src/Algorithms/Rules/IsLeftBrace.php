<?php

namespace App\Algorithms\Rules;

class IsLeftBrace
{
    public function check($algorithm, $token)
    {
        if ($token === '(') {
            $algorithm->operators->push($token);

            return true;
        }

        return false;
    }
}