<?php

class ClearDivTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $clear = new FormKit\Element\ClearDiv;
        is( '<div style="clear:both;"></div>' , $clear->render() );
    }
}


