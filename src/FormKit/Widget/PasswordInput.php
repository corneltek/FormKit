<?php

namespace FormKit\Widget;

class PasswordInput extends TextInput
{
    public function init()
    {
        $this->type = 'password';
    }

    public function render()
    {
        $html = '<input' . $this->_renderAttributes(array('class','id','type','name','value'));
        $html .= '/>';
        return $html;
    }

}


