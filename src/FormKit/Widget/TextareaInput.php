<?php
namespace FormKit\Widget;

class TextareaInput extends BaseWidget
{
    public $tag;
    public $class = array('formkit-widget','formkit-widget-textarea');
    public $type = 'textarea';
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
        return '<textarea' 
            . $this->_renderStandardAttributes()
            . $this->_renderAttributes(array(
                'name','cols','rows',
                'readonly','disabled',

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
            . '>'
            . htmlspecialchars($this->value, ENT_NOQUOTES, 'UTF-8')
            . '</textarea>' 
            . $this->renderHint();
    }

}


