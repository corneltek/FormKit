<?php

class TimeInputTest extends PHPUnit_Framework_TestCase
{


    public function testDateTimeObject() 
    {
        $time = new FormKit\Widget\TimeInput('time',array(
            'value' => new DateTime('2011-01-01 12:13'),
        ));
        $html = $time->render();
        is($html,'<input class="formkit-widget formkit-widget-time" name="time" type="time" value="12:13"/>');
    }


    public function test()
    {
        $time = new FormKit\Widget\TimeInput('time',array(
            'value' => '10:11'
        ));
        $html = $time->render();
        is($html,'<input class="formkit-widget formkit-widget-time" name="time" type="time" value="10:11"/>');
    }
}

