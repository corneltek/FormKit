<?php
namespace FormKit\Widget;
use FormKit\Element;

class Label extends Element
{
    public $class = array('formkit-widget','formkit-label');
    public $for;
    public $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function render() 
    {
        return '<label' . $this->_renderAttributes(array('id','class','for')) . '>'
            . $this->text
            . '</label>';
    }
}

