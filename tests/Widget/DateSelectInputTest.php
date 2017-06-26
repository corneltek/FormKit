<?php

class DateSelectInputTest extends \PHPUnit\Framework\TestCase
{
    public function testDateSelectWithNormalFormat()
    {
        $input = new FormKit\Widget\DateSelectInput('created_on',array(
            'format' => 'Y/m/d',
            'start_year' => '2000',
            'end_year'   => '2012',
            'value' => '2010-09-03',
        ));
        ok($input);
        # echo $input;
    }
}

