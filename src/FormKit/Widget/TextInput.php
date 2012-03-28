<?php
namespace FormKit\Widget;

class TextInput extends BaseWidget
{

    public function init()
    {
        $this->type = 'text';
    }

    public function render()
    {
        return '<input' 
            . $this->_renderAttributes(array(
                'class','id','type',
                'name','value','size','maxlength','minlength'))
            . '/>';
    }
}


