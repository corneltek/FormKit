<?php
namespace FormKit\Widget;
use FormKit\Element;

class Label extends Element
{
    public $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function render() 
    {
        return '<div ' . $this->_renderAttributes(array('id','class')) . '>'
            . $this->text
            . '</div>';
    }
}

