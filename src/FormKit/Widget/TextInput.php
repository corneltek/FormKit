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
        $html = sprintf( '<input type="%s" name="%s" value="%s" ', 
            $this->type,
            $this->name,
            $this->value );

        $html .= $this->_renderAttributes(array('class','id'));

        $html .= '/>';
        return $html;
    }
}


