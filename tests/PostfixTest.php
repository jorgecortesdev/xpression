<?php

namespace App\Tests;

use App\Evaluators\Postfix;
use PHPUnit\Framework\TestCase;

class PostfixTest extends TestCase
{

    /** @test */
    function it_can_evaluate_a_simple_postfix_notation()
    {
        $tokens = [3,4,'+'];

        $evaluator = new Postfix($tokens);

        $this->assertEquals(7, $evaluator->evaluate());
    }

    /** @test */
    function it_can_evaluate_a_long_postfix_notation()
    {
        $tokens = [5,9,3,'+',4,'*',2,'*',7,'+','*'];

        $evaluator = new Postfix($tokens);

        $this->assertEquals(515, $evaluator->evaluate());
    }
}
