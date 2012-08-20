<?php
namespace FormKit\Widget;

class TextInput extends BaseWidget
{
    public $tagName = 'input';
    public $class = array('formkit-widget','formkit-widget-text');
    public $type = 'text';

    /**
     * Render Widget with attributes
     *
     * @param array $attributes
     * @param string HTML string
     */
    public function render( $attributes = array() )
    {
        return parent::render( $attributes )
            . $this->renderHint()
            ;
    }

}


