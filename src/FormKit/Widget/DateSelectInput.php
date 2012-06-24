<?php
namespace FormKit\Widget;
use FormKit\Widget\SelectInput;

class DateInput extends TextInput
{
    public $type = 'hidden';
    public $class = array('formkit-widget','formkit-widget-date');

    public function render( $attributes = array() )
    {
        $yearS = new SelectInput();
        $monthS = new SelectInput();
        $dayS = new SelectInput();
        return parent::render( $attributes );
    }
}






