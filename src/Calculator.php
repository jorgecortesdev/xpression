<?php

namespace App;

class Calculator implements Node
{
    protected $tokenizer;
    protected $algorithm;
    protected $tokens;

    public function __construct(Tokenizer $tokenizer, Algorithm $algorithm)
    {
        $this->tokenizer = $tokenizer;
        $this->algorithm = $algorithm;
    }

    public function read($expresion)
    {
        $this->tokens = $this->tokenizer->process($expresion);

        return $this;
    }

    public function evaluate()
    {
        return $this->algorithm->apply($this->tokens);
    }

}