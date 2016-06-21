<?php
namespace FormKit\Widget;
use FormKit\Widget\TextInput;

class ButtonInput extends TextInput
{
    public $class = array('formkit-widget','formkit-widget-button');
    public $type = 'button';

    /**
     * A button usually does not have a name
     *
     * @param string $name
     * @param array $attributes
     */
    public function __construct( $name = null , $attributes = array() )
    {
        parent::__construct($name, $attributes );
    }
}


