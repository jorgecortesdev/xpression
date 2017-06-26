<?php

namespace Tests\Unit;

use Xorth\Xpression\Evaluators\Postfix;
use PHPUnit\Framework\TestCase;

class PostfixTest extends TestCase
{

    /** @test */
    function it_can_evaluate_a_simple_postfix_notation()
    {
        $tokens = [3,4,'+'];

        $evaluator = new Postfix();

        $this->assertEquals(7, $evaluator->tokens($tokens)->evaluate());
    }

    /** @test */
    function it_can_evaluate_a_long_postfix_notation()
    {
        $tokens = [5,9,3,'+',4,'*',2,'*',7,'+','*'];

        $evaluator = new Postfix();

        $this->assertEquals(515, $evaluator->tokens($tokens)->evaluate());
    }

    /** @test */
    function it_can_evaluate_a_postfix_notation_with_multiple_operators()
    {
        $tokens = [3,4,2,'*',1,5,'-',2,5,'^','^','/','+'];

        $evaluator = new Postfix();

        $this->assertEquals(3, $evaluator->tokens($tokens)->evaluate());
    }

    /** @test */
    function it_can_evaluate_a_square_operation()
    {
        $tokens = [3,2,'^'];

        $evaluator = new Postfix();

        $this->assertEquals(9, $evaluator->tokens($tokens)->evaluate());
    }

}
