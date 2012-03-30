<?php
namespace FormKit\Widget;

class ColorInput extends TextInput
{
    public $js = array( 'js/jscolor/jscolor.js' );
    public $class = array( 'formkit-widget', 'formkit-color' , 'color' );

    public function render( $attributes = array() )
    {
        $html = parent::render( $attributes );
        return $html;
    }
}

