<?php
namespace FormKit\Element;
use FormKit\Element;
use DOMText;

class Legend extends Element
{
    function __construct($text = null, $attributes = array() ) 
    {
        if( $text && is_string($text) ) {
            $textNode = new DOMText($text);
            $this->addChild($textNode);
        }
        parent::__construct('legend', $attributes );
    }
}


