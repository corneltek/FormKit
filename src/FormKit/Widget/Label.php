<?php
namespace FormKit\Widget;
use FormKit\Element;
use DOMText;

class Label extends Element
{
    public $tagName = 'label';
    public $class = array('formkit-widget','formkit-label');
    public $customAttributes = array('for');

    public function __construct($text)
    {
        $this->addChild( new DOMText($text) );
        parent::__construct();
    }
}

