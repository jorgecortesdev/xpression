<?php

namespace App\Algorithms\Rules;

class IsOperator
{
    protected $supportedOperators = [
        '^' => ['value' => 4, 'associativity' => 'right'],
        '*' => ['value' => 3, 'associativity' => 'left'],
        '/' => ['value' => 3, 'associativity' => 'left'],
        '+' => ['value' => 2, 'associativity' => 'left'],
        '-' => ['value' => 2, 'associativity' => 'left'],
    ];

    public function check($algorithm, $token)
    {
        if ($this->isOperator($token)) {
            $topOperator = $algorithm->operators->peek();

            while( ! $algorithm->operators->empty()
                    && $this->isOperator($topOperator)
                    && (
                        ($this->isLeftOperator($token) && $this->hasGreaterOrEqualPrecedence($topOperator, $token))
                        ||
                        ($this->isRightOperator($token) && $this->hasGreaterPrecedence($topOperator, $token))
                        )
                    ) {
                $topOperator = $algorithm->operators->pop();
                $algorithm->output->enqueue($topOperator);
                $topOperator = $algorithm->operators->peek();
            }

            $algorithm->operators->push($token);

            return true;
        }

        return false;
    }

    protected function isOperator($token) {
        return in_array($token, array_keys($this->supportedOperators));
    }

    public function hasGreaterOrEqualPrecedence($a, $b)
    {
        return $this->getPrecedence($a) >= $this->getPrecedence($b);
    }

    public function hasGreaterPrecedence($a, $b)
    {
        return $this->getPrecedence($a) > $this->getPrecedence($b);
    }

    public function getPrecedence($operator)
    {
        return $this->supportedOperators[$operator]['value'];
    }

    public function isRightOperator($operator)
    {
        return $this->supportedOperators[$operator]['associativity'] === 'right';
    }

    public function isLeftOperator($operator)
    {
        return $this->supportedOperators[$operator]['associativity'] === 'left';
    }
}