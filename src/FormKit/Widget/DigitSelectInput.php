<?php
namespace FormKit\Widget;

class DigitSelectInput extends SelectInput
{
    public $class = array('formkit-widget','formkit-widget-digitselect');
    public $from = 0;
    public $to = 10;
    public $interval = 1;

    public function init()
    {
        $this->options = range($this->from, $this->to, $this->interval);
        parent::init();
    }
}

