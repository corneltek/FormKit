<?php
namespace FormKit\Widget;
use FormKit\Element;
use DOMText;

class Hint extends Element
{
    public $tagName = 'span';
    public $class = array('formkit-widget','formkit-hint','formkit-widget-hint');

    public function __construct($text)
    {
        $this->append( new DOMText($text) );
        parent::__construct();
    }
}

