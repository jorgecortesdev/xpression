<?php

namespace App\Test;

use App\Calculator;

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /** @test */
    function it_transform_a_two_operands_expression_to_postfix_notation()
    {
        $expression = "3 + 4";

        $calculator = new Calculator($expression);

        $this->assertEquals([3,4,'+'], $calculator->getRawOutput());
    }

    /** @test */
    function it_transform_a_three_operands_expression_to_postfix_notation()
    {
        $expression = "3 + 4 + 5";

        $calculator = new Calculator($expression);

        $this->assertEquals([3,4,'+',5,'+'], $calculator->getRawOutput());
    }

    /** @test */
    function it_transform_an_expression_with_multiple_operators_to_postfix_notation()
    {
        $expression = "2 - 2 * 3";

        $calculator = new Calculator($expression);

        $this->assertEquals([2,2,3,'*','-'], $calculator->getRawOutput());
    }

    /** @test */
    function it_transform_an_expression_with_multiple_operators_and_parenthesis()
    {
        $expression = "3 + 4 * 2 / ( 1 - 5 ) ^ 2 ^ 3";

        $calculator = new Calculator($expression);

        $this->assertEquals(
            [3,4,2,'*',1,5,'-',2,3,'^','^','/','+'],
            $calculator->getRawOutput()
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
