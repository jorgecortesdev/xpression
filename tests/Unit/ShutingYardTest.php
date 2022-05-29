<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use JorgeCortesDev\Xpression\Algorithms\ShuntingYard;
use JorgeCortesDev\Xpression\Tokenizers\SimpleTokenizer;

class ShutingYardTest extends TestCase
{
    protected ShuntingYard $algorithm;
    protected SimpleTokenizer $tokenizer;

    public function setUp(): void
    {
        parent::setUp();

        $this->algorithm = new ShuntingYard;
        $this->tokenizer = new SimpleTokenizer;
    }

    /** @test */
    function it_can_transform_an_infix_notation_with_two_operands_to_postfix_notation()
    {
        $expression = "3 + 4";

        $tokens = $this->tokenizer->process($expression);

        $this->assertEquals(
            [3, 4, '+'],
            $this->algorithm->apply($tokens)
        );
    }

    /** @test */
    function it_can_transform_an_infix_notation_with_three_operands_to_postfix_notation()
    {
        $expression = "3 + 4 + 5";

        $tokens = $this->tokenizer->process($expression);

        $this->assertEquals(
            [3, 4, '+', 5, '+'],
            $this->algorithm->apply($tokens)
        );
    }

    /** @test */
    function it_can_transform_an_infix_notation_with_different_operators_to_postfix_notation()
    {
        $expression = "2 - 2 * 3";

        $tokens = $this->tokenizer->process($expression);

        $this->assertEquals(
            [2, 2, 3, '*', '-'],
            $this->algorithm->apply($tokens)
        );
    }

    /** @test */
    function it_can_transform_a_long_infix_notation_with_parentheses_to_postfix_notation()
    {
        $expression = "3 + 4 * 2 / ( 1 - 5 ) ^ 2 ^ 3";

        $tokens = $this->tokenizer->process($expression);

        $this->assertEquals(
            [3, 4, 2, '*', 1, 5, '-', 2, 3, '^', '^', '/', '+'],
            $this->algorithm->apply($tokens)
        );
    }

    /** @test */
    function it_can_transform_an_infix_notation_with_multiple_parentheses_to_postfix_notation()
    {
        $expression = "1 + ( ( 2 + 3 ) * 4 + 5 ) * 6";

        $tokens = $this->tokenizer->process($expression);

        $this->assertEquals(
            [1, 2, 3, '+', 4, '*', 5, '+', 6, '*', '+'],
            $this->algorithm->apply($tokens)
        );
    }

    /** @test */
    function it_can_transform_an_expression_with_two_parentheses()
    {
        $expression = "( 1 + 2 ) * ( 1 + 3 )";

        $tokens = $this->tokenizer->process($expression);

        $this->assertEquals(
            [1, 2, '+', 1, 3, '+', '*'],
            $this->algorithm->apply($tokens)
        );
    }
}
