<?php
namespace FormKit\Widget;

class TextInput extends BaseWidget
{
    public $tagName = 'input';
    public $class = array('formkit-widget','formkit-text');
    public $type = 'text';
    public $value;
    public $size;
    public $alt;
    public $readonly;
    public $style;

    public $customAttributes = array(
        'type','name','value','size','maxlength',
        'minlength','align','src','alt','accept',
        'readonly',
        'placeholder',
        'disabled',
        'dataFormat',

        /* Event Attributes */
        'onblur',
        'onchange',
        'onclick',
        'ondblclick',
        'onfocus',
        'onmousedown',
        'onmousemove',
        'onmouseout',
        'onmouseover',
        'onmouseup',
        'onkeydown',
        'onkeypress',
        'onkeyup',
        'onselect',
    );


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


