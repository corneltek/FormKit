<?php

class FieldsetLayoutTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $text = new FormKit\Widget\TextInput('name');
        $layout = new FormKit\Layout\FieldsetLayout;
        $layout->addWidget($text);
        ok($text);
        ok($layout);
    }
}

