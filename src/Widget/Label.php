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
        if ( $text ) {
            if ( ! is_string($text) ) {
                throw new Exception("The argument is not a string.");
            }
            $this->addChild( new DOMText($text) );
        }
        parent::__construct('label');
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

