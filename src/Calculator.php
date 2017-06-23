<?php

namespace App;

class Calculator implements Node
{
    protected $output;

    protected $operators;

    protected $precedence = [
        '^' => ['value' => 4, 'associativity' => 'right'],
        '*' => ['value' => 3, 'associativity' => 'left'],
        '/' => ['value' => 3, 'associativity' => 'left'],
        '+' => ['value' => 2, 'associativity' => 'left'],
        '-' => ['value' => 2, 'associativity' => 'left'],
    ];

    public function __construct($input)
    {
        $this->output = new Stack();
        $this->operators = new Stack();

        $this->shuntingYard($input);
    }

    public function evaluate()
    {
        $value = 0;
        foreach ($this->nodes as $node) {
            $value += $node->evaluate();
        }
        return $value;
    }

    public function __toString()
    {
        return "1 + (2 * 3)";
    }

    protected function shuntingYard($expression)
    {
        $input = explode(' ', $expression);

        foreach ($input as $step => $token) {

            switch ($token) {

                case is_numeric($token):
                    $this->output->push($token);
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
                        $this->output->push($topOperator);
                        $topOperator = $this->operators->peek();
                    }
                    $this->operators->push($token);
                    break;

                case $this->is_left_brace($token):
                    $this->operators->push($token);
                    break;

                case $this->is_right_brace($token):
                    while($this->operators->peek() != '(') {
                        $this->output->push($this->operators->pop());
                    }
                    $this->operators->pop();
                    break;

            }

        }

        while ( ! $this->operators->empty()) {
            $this->output->push($this->operators->pop());
        }

    }

    protected function is_operator($token)
    {
        return in_array($token, array_keys($this->precedence));
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
        return $this->precedence[$operator]['value'];
    }

    public function is_right_operator($operator)
    {
        return $this->precedence[$operator]['associativity'] === 'right';
    }

    public function is_left_operator($operator)
    {
        return $this->precedence[$operator]['associativity'] === 'left';
    }

    public function getRawOutput()
    {
        return $this->output->toArray();
    }
}