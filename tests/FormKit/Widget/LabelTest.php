<?php

class LabelTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $label = new FormKit\Widget\Label( 'MyLabel' );
        ok( $label );

        $label->addClass('class1');

        ok( $label->hasClass('class1') );

        $label->removeClass('class1');

        ok( ! $label->hasClass('class1') );

    }
}

