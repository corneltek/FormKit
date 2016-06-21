<?php
namespace FormKit\Widget;

class DateTimeInput extends TextInput
{
    public $type = 'text';
    public $js = array( 'js/jsdatetime/jquery-ui-timepicker-addon.js', 'js/jsdatetime/jsdatetime.js' );
    public $class = array('formkit-widget','formkit-widget-datetime');

    public function render( $attributes = array() )
    {
        $this->setAttributes($attributes);

        $dateFormat = '';
        $timeFormat = '';
        $cursor = &$dateFormat;

        $format = $this->format ?: 'Y-m-d H:i:s';
        $this->dataAmpm = false;
        for($i=0; $i<strlen($format); ++$i)
            switch($format[$i]) {
                case 'd':
                    $cursor = &$dateFormat;
                    $cursor .= 'dd';
                    break;
                case 'j':
                    $cursor = &$dateFormat;
                    $cursor .= 'd';
                    break;
                case 'D':
                    $cursor = &$dateFormat;
                    $cursor .= 'D';
                    break;
                case 'l':
                    $cursor = &$dateFormat;
                    $cursor .= 'DD';
                    break;
                case 'z':
                    $cursor = &$dateFormat;
                    $cursor .= 'o';
                    break;
                case 'F':
                    $cursor = &$dateFormat;
                    $cursor .= 'MM';
                    break;
                case 'M':
                    $cursor = &$dateFormat;
                    $cursor .= 'M';
                    break;
                case 'm':
                    $cursor = &$dateFormat;
                    $cursor .= 'mm';
                    break;
                case 'n':
                    $cursor = &$dateFormat;
                    $cursor .= 'm';
                    break;
                case 'Y':
                    $cursor = &$dateFormat;
                    $cursor .= 'yy';
                    break;
                case 'y':
                    $cursor = &$dateFormat;
                    $cursor .= 'y';
                    break;

                case 'a':
                    $cursor = &$timeFormat;
                    $cursor .= 'tt';
                    break;
                case 'A':
                    $cursor = &$timeFormat;
                    $cursor .= 'TT';
                    break;
                case 'g':
                    $cursor = &$timeFormat;
                    $cursor .= 'h';
                    $this->dataAmpm = true;
                    break;
                case 'h':
                    $cursor = &$timeFormat;
                    $cursor .= 'hh';
                    $this->dataAmpm = true;
                    break;
                case 'G':
                    $cursor = &$timeFormat;
                    $cursor .= 'h';
                    break;
                case 'H':
                    $cursor = &$timeFormat;
                    $cursor .= 'hh';
                    break;
                case 'i':
                    $cursor = &$timeFormat;
                    $cursor .= 'mm';
                    break;
                case 's':
                    $cursor = &$timeFormat;
                    $cursor .= 'ss';
                    break;
                default:
                    $cursor .= $format[$i];
            }

        $this->dataDateFormat = $dateFormat;
        $this->dataTimeFormat = $timeFormat;

        if( $this->value instanceof \DateTime )
            $this->value = $this->value->format($format);
        return parent::render();
    }
}

