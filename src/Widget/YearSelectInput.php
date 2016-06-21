<?php
namespace FormKit\Widget;

class YearSelectInput extends DateSelectInput 
{
    public $format = 'Y';

    public function loadValue() { 
        // do nothing
    }
}

