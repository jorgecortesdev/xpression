<?php

namespace App;

class SimpleTokenizer implements Tokenizer
{
    public function process($expression)
    {
        return $input = explode(' ', $expression);
    }
}