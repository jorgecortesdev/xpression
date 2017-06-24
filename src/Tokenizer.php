<?php

namespace App;

interface Tokenizer
{
    public function process($expression);
}