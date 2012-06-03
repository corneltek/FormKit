<?php

class FieldsetLayoutTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $text = new FormKit\Widget\TextInput('name');

        $layout = new FormKit\Layout\FieldsetLayout( 'Information' );
        $layout->addWidget($text);
        ok($text);
        ok($layout);

        $html = $layout->render();
        ok($html);

        select_ok( 'fieldset legend' ,1 , $html);
        select_ok( 'fieldset label' ,1 , $html);
    }
}

