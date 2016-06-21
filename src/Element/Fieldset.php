<?php
namespace FormKit\Element;
use FormKit\Element;

class Fieldset extends Element
{
    public $tagName = 'fieldset';
    public $closeEmpty = true;

    public function __construct($attributes = array() ) { 
        parent::__construct($this->tagName, $attributes);
    }
}
