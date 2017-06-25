<?php

namespace App\Tokenizers;

interface Tokenizer
{
    public function process($expression);
}