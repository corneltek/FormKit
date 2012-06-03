<?php

class SelectInputTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $widget = new FormKit\Widget\SelectInput('countries', array(  
            'label' => 'Country',
            'options' => array(
                'Test' => 'Test',
                'Asia' => array( 
                    'Taiwan',
                    'Taipei',
                    'Tainan',
                    'Tokyo',
                    'Korea',
                )
            )
        ));
        ok($widget);
        $html = $widget->render();
        select_ok('select.formkit-widget-select > option',1,$html);
        select_ok('select.formkit-widget-select option',6,$html);
        select_ok('select.formkit-widget-select optgroup',1,$html);
        select_ok('select.formkit-widget-select > optgroup > option',5,$html);
    }
}

