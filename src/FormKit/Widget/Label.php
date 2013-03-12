<?php
namespace FormKit\Widget;
use FormKit\Element;
use DOMText;
use BadMethodCallException;

class Label extends Element
{
    public $class = array('formkit-widget','formkit-label','formkit-widget-label');

    public function __construct($text = null)
    {
        parent::__construct('label');
        if ($text) {
            $this->addChild( new DOMText($text) );
        }
    }


    /**
     * Here is a hack for supportting for $label->for( $elementId );
     *
     * Due to the PHP yacc parser issue, we can't define a method named "for".
     */
    public function __call($m,$a) 
    {
        if($m === "for") {
            $this->setAttributeValue($m,$a[0]);
        }
        return parent::__call($m,$a);
    }
}

