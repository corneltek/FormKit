<?php

class FieldsetLayoutTest extends PHPUnit_Framework_TestCase
{
    public function testFieldsetLayoutWithTextInput()
    {
        $text = new FormKit\Widget\TextInput('name');
        $layout = new FormKit\Layout\FieldsetLayout( 'Information' );
        $layout->addWidget($text);
        $html = $layout->render();
        // select_ok( 'fieldset legend' ,1 , $html);
        // select_ok( 'fieldset label' ,1 , $html);
    }
}

