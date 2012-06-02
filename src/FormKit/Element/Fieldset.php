<?php
namespace FormKit\Element;
use FormKit\Element;

class Fieldset extends Element
{
    function render($attributes = array() ) {
        $this->setAttributes( $attributes );
        return '<fieldset' . $this->_renderAttributes(array('id','class','style')) . '>'
            . $this->_renderChildren()
            . '</fieldset>';
    }
}
