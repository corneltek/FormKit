<?php
namespace FormKit\Widget;

// For the syntax of 'format', please refer to http://docs.jquery.com/UI/Datepicker/formatDate

class DateInput extends TextInput
{
    public $type = 'text';
    public $js = array( 'js/jsdate/jsdate.js' );
    public $class = array('formkit-widget','formkit-date');

    public function render( $attributes = array() )
    {
        $this->setAttributes($attributes);
        if( $this->format )
            $this->dataFormat = $this->format;
        else
            $this->dataFormat = 'yy.m.d';
        return parent::render();
    }
}

