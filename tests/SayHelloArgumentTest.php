<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase 
{
    public function testPositiveBool()  
    {
        $this->assertEquals('Hello true', sayHelloArgument("true"));    
    }

    public function testNegativeBool()  
    {
        $this->assertEquals('Hello true', sayHelloArgument(true));    
    }
}

?>