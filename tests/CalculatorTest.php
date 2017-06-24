<?php

namespace App\Test;

use App\Calculator;
use App\ShuntingYard;
use App\SimpleTokenizer;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    protected $calculator;

    public function setUp()
    {
        parent::setUp();

        $this->calculator = new Calculator(
            new SimpleTokenizer(),
            new ShuntingYard()
        );
    }

    // /** @test */
    // function it_can_sum_two_numbers()
    // {
    //     $expression = "1 + 2";
    //     $calculator = new Calculator($expression);
    //     $this->assertEquals(3, $calculator->evaluate());
    // }

    // /** @test */
    // function it_can_multiply_two_numbers()
    // {
    //     $expression = "1 * 2";
    //     $calculator = new Calculator($expression);
    //     $this->assertEquals(2, $calculator->evaluate());
    // }

    // /** @test */
    // function it_can_parse_and_evaluate_a_string()
    // {
    //     $expression = "1 + 2 * 3";

    //     $calculator = new Calculator($expression);

    //     $this->assertEquals(7, $calculator->evaluate());
    // }

    // /** @test */
    // function it_can_print_the_expression_with_pharentesis()
    // {
    //     $expresion = "1 + 2 * 3";

    //     $calculator = new Calculator($expresion);

    //     $this->assertEquals("1 + (2 * 3)", $calculator);
    // }
}
