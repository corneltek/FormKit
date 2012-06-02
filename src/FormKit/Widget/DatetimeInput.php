<?php
namespace FormKit\Widget;

// For the syntax of 'dateFormat', please refer to http://docs.jquery.com/UI/Datepicker/formatDate
// For the syntax of 'timeFormat', please refer to http://trentrichardson.com/examples/timepicker/

class DatetimeInput extends TextInput
{
    public $type = 'text';
    public $js = array( 'js/jsdatetime/jquery-ui-timepicker-addon.js', 'js/jsdatetime/jsdatetime.js' );
    public $class = array('formkit-widget','formkit-datetime');

    public function render( $attributes = array() )
    {
        $this->setAttributes($attributes);
        if( $this->dateFormat )
            $this->dataFormat = $this->dateFormat;
        else
            $this->dataFormat = 'yy.m.d';
            
        if( $this->timeFormat )
            $this->dataTimeFormat = $this->timeFormat;
        else
            $this->dataTimeFormat = 'hh:mm:ss';
        return parent::render();
    }
}

