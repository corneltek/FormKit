<?php
namespace FormKit\Element;
use FormKit\Element;

class Fieldset extends Element
{
    public $tagName = 'fieldset';

    function render($attributes = array() ) {
        $this->setAttributes( $attributes );
        return '<fieldset' . $this->_renderAttributes(array('id','class','style','title')) . '>'
            . $this->_renderChildren()
            . '</fieldset>';
    }
}
