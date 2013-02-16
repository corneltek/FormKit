<?php
namespace FormKit\Widget;
use FormKit\Element;
use DOMText;
use BadMethodCallException;

class Label extends Element
{
    public $tagName = 'label';
    public $class = array('formkit-widget','formkit-label','formkit-widget-label');

    public function __construct($text)
    {
        $this->addChild( new DOMText($text) );
        parent::__construct();
    }

    public function __call($m,$a) 
    {
        if($m == "for") {
            $this->setAttributeValue($m,$a[0]);
        }
        return parent::__call($m,$a);
    }
}

