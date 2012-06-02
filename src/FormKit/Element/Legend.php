<?php
namespace FormKit\Element;
use FormKit\Element;

class Legend extends Element
{
    function render($attributes = array() ) {
        $this->setAttributes( $attributes );
        return '<legend' . $this->_renderAttributes(array('id','class','style','align','title')) . '>'
                . $this->_renderChildren()
                . '</legend>';
    }
}


