<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase 
{
    /**
     * @dataProvider nonStringProvider
     */
    public function testNegativeNonStringArg() {

        $this->expectException(InvalidArgumentException::class);
        countArgumentsWrapper(...func_get_args());
    }

    public function nonStringProvider() {
        return [
            ['test', 1],
            ['test', 'test', 'test', true],
            [
                ['test'],
                'test',
                'test'
            ]
        ];
    }
}

?>