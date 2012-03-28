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
        $html = sprintf( '<input type="%s" name="%s" value="%s" ', 
            $this->type,
            $this->name,
            $this->value );

        $html .= $this->_renderAttributes(array('class','id'));
        $html .= '/>';
        return $html;
    }
}


