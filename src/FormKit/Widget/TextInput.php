<?php
namespace FormKit\Widget;

class TextInput extends BaseWidget
{
    public $tag;
    public $class = array('formkit-widget','formkit-text');
    public $type = 'text';
    public $value;
    public $size;
    public $alt;
    public $readonly;
    public $style;


    /**
     * Render Widget with attributes
     *
     * @param array $attributes
     * @param string HTML string
     */
    public function render( $attributes = array() )
    {
        $this->setAttributes( $attributes );
        return '<input' 
            . $this->_renderAttributes(array(
                'class','id','type',
                'name','value','size','maxlength',
                'minlength','align','src','alt','accept',
                'readonly','style',
                'disabled',

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
            ))
            . '/>' 
            . $this->renderHint();
    }

}


