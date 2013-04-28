<?php
namespace FormKit\Widget;
use DateTime;

class TimeInput extends TextInput
{
    public $type = 'time';
    public $class = array('formkit-widget','formkit-widget-time');

    public $origValue;
    public $format = 'H:i';

    public function render( $attributes = array() )
    {
        $this->setAttributes($attributes);
        if( $this->value instanceof DateTime ) {
            $this->origValue = $this->value;
            $this->value = $this->value->format($this->format);
        } else {
            // reformat time
            $date = new DateTime("2012-01-01 " . $this->value );
            $this->value = $date->format($this->format);
        }
        return parent::render();
    }

}
