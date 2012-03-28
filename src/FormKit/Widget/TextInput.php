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
                'name','value','size','maxlength','minlength'))
                . '/>' 
                . $this->renderHint();
    }
}


