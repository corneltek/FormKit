<?php
namespace FormKit\Element;
use FormKit\Element;

class ClearDiv extends Element
{
    public $tagName = 'div';

    public $closeEmpty = true;

    public function init() 
    {
        $this->style = array('clear' => 'both');
    }
}



