<?php

namespace Xorth\Xpression\Algorithms\Rules;

class IsOperator
{
    /**
     * Supported operators.
     *
     * @var array
     */
    protected $supportedOperators = [
        '^' => ['value' => 4, 'associativity' => 'right'],
        '*' => ['value' => 3, 'associativity' => 'left'],
        '/' => ['value' => 3, 'associativity' => 'left'],
        '+' => ['value' => 2, 'associativity' => 'left'],
        '-' => ['value' => 2, 'associativity' => 'left'],
    ];

    /**
     * Check if the token is a supported operator.
     *
     * @param  \Xorth\Xpression\Algorithms\ShuntingYard $algorithm
     * @param  string $token
     * @return boolean
     */
    public function check($algorithm, $token)
    {
        if ( ! $this->isOperator($token)) {
            return false;
        }
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

    /**
     * Is the token operator.
     *
     * @param string $token
     * @return boolean
     */
    protected function isOperator($token) {
        return in_array($token, array_keys($this->supportedOperators));
    }

    /**
     * Has grater or equal precedence.
     *
     * @param string $a
     * @param string $b
     * @return boolean
     */
    protected function hasGreaterOrEqualPrecedence($a, $b)
    {
        return $this->getPrecedence($a) >= $this->getPrecedence($b);
    }

    /**
     * Has grater precedence.
     *
     * @param string $a
     * @param string $b
     * @return boolean
     */
    protected function hasGreaterPrecedence($a, $b)
    {
        return $this->getPrecedence($a) > $this->getPrecedence($b);
    }

    /**
     * Return the precedence of the operator.
     *
     * @param string $operator
     * @return integer
     */
    protected function getPrecedence($operator)
    {
        return $this->supportedOperators[$operator]['value'];
    }

    /**
     * Is right operator.
     *
     * @param string $operator
     * @return boolean
     */
    protected function isRightOperator($operator)
    {
        return $this->supportedOperators[$operator]['associativity'] === 'right';
    }

    /**
     * Is left operator.
     *
     * @param string $operator
     * @return boolean
     */
    protected function isLeftOperator($operator)
    {
        return $this->supportedOperators[$operator]['associativity'] === 'left';
    }
}