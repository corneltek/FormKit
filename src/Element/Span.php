<?php
namespace FormKit\Element;
use FormKit\Element;

class Span extends Element
{
    public $tagName = 'span';
    public $closeEmpty = true;

    public function __construct($attributes = array() ) {
        parent::__construct($this->tagName, $attributes);
    }
}



