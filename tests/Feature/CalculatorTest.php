<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use JorgeCortesDev\Xpression\Algorithms\ShuntingYard;
use JorgeCortesDev\Xpression\Calculator;
use JorgeCortesDev\Xpression\Evaluators\Postfix;
use JorgeCortesDev\Xpression\Tokenizers\SimpleTokenizer;

class CalculatorTest extends TestCase
{
    protected Calculator $calculator;

    public function setUp(): void
    {
        parent::setUp();

        $this->calculator = new Calculator(
            new SimpleTokenizer(),
            new ShuntingYard(),
            new Postfix()
        );
    }

    /** @test */
    function it_can_sum_two_numbers()
    {
        $expression = "1 + 2";
        $this->assertEquals(3, $this->calculator->read($expression)->evaluate());
    }

    /** @test */
    function it_can_multiply_two_numbers()
    {
        $expression = "1 * 2";
        $this->assertEquals(2, $this->calculator->read($expression)->evaluate());
    }

    /** @test */
    function it_can_evaluate_an_expression_with_multiple_operators()
    {
        $expression = "1 + 2 * 3";

        $this->assertEquals(7, $this->calculator->read($expression)->evaluate());
    }

    /** @test */
    public function it_can_evaluate_a_complex_expression()
    {
        $expression = "8 + ( 4 * 2 ) / ( 4 - 2 ) ^ 2";

        $this->assertEquals(10, $this->calculator->read($expression)->evaluate());
    }
}
