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
        select_ok('select.formkit-select > option',1,$html);
        select_ok('select.formkit-select option',6,$html);
        select_ok('select.formkit-select optgroup',1,$html);
        select_ok('select.formkit-select > optgroup > option',5,$html);
    }
}

