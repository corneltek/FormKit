<?php

class LabelTest extends \PHPUnit\Framework\TestCase
{
    function test()
    {
        $label = new FormKit\Widget\Label("label");
        ok($label);
        ok( $label->render() );
    }

    function testNoLabelText()
    {
        $label = new FormKit\Widget\Label;
        ok($label);
        ok($label->render());
    }
}

