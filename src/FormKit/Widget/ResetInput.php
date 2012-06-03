<?php
namespace FormKit\Widget;
use FormKit\Widget\TextInput;

class ResetInput extends TextInput
{

    public $class = array('formkit-widget','formkit-widget-reset');
    public $type = 'reset';

    /**
     * A reset button usually does not have a name
     *
     * @param string $name
     * @param array $attributes
     */
    public function __construct( $name = null , $attributes = array() )
    {
        parent::__construct($name, $attributes );
    }

}


