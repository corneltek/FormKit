<?php

class DateTimeInputTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $datetime = new FormKit\Widget\DateTimeInput('best_time', array(
            'label' => 'Best Time',
            'format' => 'Y.n.j g:i:s a',
            'value' => new DateTime('now', new DateTimeZone('Asia/Taipei')),
        ));
        ok($datetime);
    }
}


