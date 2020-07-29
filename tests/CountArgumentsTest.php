<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase 
{
    public function testPositiveNoArguments() {
        $this->assertEquals( [
            'argument_count'  => 0,
            'argument_values' => [],
        ], countArguments());
    }

    public function testPositiveOneString() {
        $this->assertEquals( [
            'argument_count'  => 1,
            'argument_values' => ['uno'],
        ], countArguments('uno'));
    }

    public function testPositiveTwoStrings() {
        $this->assertEquals( [
            'argument_count'  => 2,
            'argument_values' => ['uno','due'],
        ], countArguments('uno','due'));
    }
}

?>