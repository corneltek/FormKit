<?php
namespace FormKit\Element;
use FormKit\Element;

class TableCell extends Element
{
    public function render( $attributes = array() ) 
    {
        $this->loadAttributes( $attributes );
        return '<td' . $this->_renderAttributes(
                    array('id','class','width','height','align','colspan','valign')) . '>'
            . $this->_renderChildren()
            . '</td>';
    }
}

