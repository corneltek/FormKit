<?php
namespace FormKit\Widget;

class TextInput extends BaseWidget
{

    public function init()
    {
        $this->type = 'text';
    }

    public function _renderBasicAttributes()
    {
        $html = '';
        if( $this->class ) {
            $html .= ' class="' . join(' ',$this->class) . '"';
        }
        if( $this->id ) {
            $html .= ' id="' . join(' ',$this->id) . '"';
        }
        return $html;
    }

    public function render()
    {
        $html = sprintf( '<input type="%s" name="%s" value="%s" ', 
            $this->type,
            $this->name,
            $this->value );

        $html .= $this->_renderBasicAttributes();

        $html .= '/>';
        return $html;
    }
}





