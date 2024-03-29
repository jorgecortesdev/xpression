<?php

namespace JorgeCortesDev\Xpression\Algorithms\Rules;

use JorgeCortesDev\Xpression\Algorithms\ShuntingYard;

class IsOperator
{
    /**
     * Supported operators.
     *
     * @var array
     */
    protected array $supportedOperators = [
        '^' => ['value' => 4, 'associativity' => 'right'],
        '*' => ['value' => 3, 'associativity' => 'left'],
        '/' => ['value' => 3, 'associativity' => 'left'],
        '+' => ['value' => 2, 'associativity' => 'left'],
        '-' => ['value' => 2, 'associativity' => 'left'],
    ];

    /**
     * Check if the token is a supported operator.
     *
     * @param ShuntingYard $algorithm
     * @param string $token
     * @return bool
     */
    public function check(ShuntingYard $algorithm, string $token): bool
    {
        if (! $this->isOperator($token)) {
            return false;
        }
        $topOperator = $algorithm->operators->peek();

        while (! $algorithm->operators->empty()
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
     * @return bool
     */
    protected function isOperator(string $token): bool
    {
        return in_array($token, array_keys($this->supportedOperators));
    }

    /**
     * Is left operator.
     *
     * @param string $operator
     * @return bool
     */
    protected function isLeftOperator(string $operator): bool
    {
        return $this->supportedOperators[$operator]['associativity'] === 'left';
    }

    /**
     * Has grater or equal precedence.
     *
     * @param string $a
     * @param string $b
     * @return bool
     */
    protected function hasGreaterOrEqualPrecedence(string $a, string $b): bool
    {
        return $this->getPrecedence($a) >= $this->getPrecedence($b);
    }

    /**
     * Return the precedence of the operator.
     *
     * @param string $operator
     * @return int
     */
    protected function getPrecedence(string $operator): int
    {
        return $this->supportedOperators[$operator]['value'];
    }

    /**
     * Is right operator.
     *
     * @param string $operator
     * @return bool
     */
    protected function isRightOperator(string $operator): bool
    {
        return $this->supportedOperators[$operator]['associativity'] === 'right';
    }

    /**
     * Has grater precedence.
     *
     * @param string $a
     * @param string $b
     * @return bool
     */
    protected function hasGreaterPrecedence(string $a, string $b): bool
    {
        return $this->getPrecedence($a) > $this->getPrecedence($b);
    }
}
