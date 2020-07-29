<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase 
{
    /**
     * @dataProvider compoundsProvider
     */
    public function testNegativeArgCompounds($arg) {

        $this->expectException(InvalidArgumentException::class);
        sayHelloArgumentWrapper($arg);
    }

    public function compoundsProvider() {
        return [
            [ 
                [1, 2, 3]
            ],
            [
                [ ]
            ],
            [
                new stdClass()
            ]
        ];
    }
}

?>