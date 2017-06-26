<?php

class ClearDivTest extends \PHPUnit\Framework\TestCase
{
    function test()
    {
        $clear = new FormKit\Element\ClearDiv;
        is( '<div style="clear:both;"></div>' , $clear->render() );
    }
}


