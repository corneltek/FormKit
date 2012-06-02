<?php
namespace FormKit\Element;
use FormKit\Element;
use DOMText;

class Legend extends Element
{
    public $customAttribute = array('align');

    function __construct($text = null) {
        if( $text && is_string($text) ) {
            $textNode = new DOMText($text);
            $this->addChild($textNode);
        }
        parent::__construct('legend');
    }
}


