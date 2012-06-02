<?php
use FormKit\Element\Fieldset;
use FormKit\Element\Legend;

class FieldsetTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $legend = new Legend('MyLegend');

        $fieldset = new Fieldset();
        ok( $fieldset );

        $fieldset->addChild( $legend );
        $html = $fieldset->render();
        select_ok('fieldset legend',1 , $html);
    }
}

