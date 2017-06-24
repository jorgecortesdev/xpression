<?php

namespace App;

class ShuntingYard implements Algorithm
{
    protected $output;

    protected $operators;

    protected $supportedOperators = [
        '^' => ['value' => 4, 'associativity' => 'right'],
        '*' => ['value' => 3, 'associativity' => 'left'],
        '/' => ['value' => 3, 'associativity' => 'left'],
        '+' => ['value' => 2, 'associativity' => 'left'],
        '-' => ['value' => 2, 'associativity' => 'left'],
    ];

    function __construct()
    {
        $this->output = new Queue();
        $this->operators = new Stack();
    }

    public function apply(array $tokens)
    {
        foreach ($tokens as $step => $token) {

            switch ($token) {

                case is_numeric($token):
                    $this->output->enqueue($token);
                    break;

                case $this->is_operator($token):
                    $topOperator = $this->operators->peek();

                    while( ! $this->operators->empty()
                            && $this->is_operator($topOperator)
                            && (
                                ($this->is_left_operator($token) && $this->get_precedence($topOperator) >= $this->get_precedence($token))
                                ||
                                ($this->is_right_operator($token) && $this->get_precedence($topOperator) > $this->get_precedence($token))
                                )) {
                        $topOperator = $this->operators->pop();
                        $this->output->enqueue($topOperator);
                        $topOperator = $this->operators->peek();
                    }
                    $this->operators->push($token);
                    break;

                case $this->is_left_brace($token):
                    $this->operators->push($token);
                    break;

                case $this->is_right_brace($token):
                    while($this->operators->peek() != '(') {
                        $this->output->enqueue($this->operators->pop());
                    }
                    $this->operators->pop();
                    break;

            }

        }

        while ( ! $this->operators->empty()) {
            $this->output->enqueue($this->operators->pop());
        }

        return $this->output->toArray();
    }

    protected function is_operator($token)
    {
        return in_array($token, array_keys($this->supportedOperators));
    }

    protected function is_left_brace($token)
    {
        return $token === '(';
    }

    protected function is_right_brace($token)
    {
        return $token === ')';
    }

    public function get_precedence($operator)
    {
        return $this->supportedOperators[$operator]['value'];
    }

    public function is_right_operator($operator)
    {
        return $this->supportedOperators[$operator]['associativity'] === 'right';
    }

    public function is_left_operator($operator)
    {
        return $this->supportedOperators[$operator]['associativity'] === 'left';
    }
}
