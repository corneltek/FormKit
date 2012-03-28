<?php
namespace FormKit\Element;
use FormKit\Element;

class TableCell extends Element
{
    public function render()
    {
        return '<td' . $this->_renderAttributes(
                    array('id','class','width','height','align','colspan','valign')) . '>'
            . $this->_renderChildren()
            . '</td>';
    }
}

