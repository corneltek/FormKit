<?php
namespace FormKit\Element;
use FormKit\Element;
use FormKit\Element\Div;

class ClearDiv extends Div
{
    public $tagName = 'div';

    public $closeEmpty = true;

    public function init() {
        $this->style = array('clear' => 'both');
    }
}



