<?php

class TextareaInputTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $textarea = new FormKit\Widget\TextareaInput('address');
        $html = $textarea->render(array( 
            'rows' => 30,
            'cols' => 45,
        ));
        is('<textarea class="formkit-widget formkit-widget-textarea" name="address" cols="45" rows="30"></textarea>', $html );
    }
}

