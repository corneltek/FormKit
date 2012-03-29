<?php
namespace FormKit\Widget;

class TextInput extends BaseWidget
{
    public $class = array('formkit-widget','formkit-text');
    public $type = 'text';

    public function render()
    {
        return '<input' 
            . $this->_renderAttributes(array(
                'class','id','type',
                'name','value','size','maxlength',
                'minlength','align','src','alt','accept',
                'readonly','style',

                /* event attributes */
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


