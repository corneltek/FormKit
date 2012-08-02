<?php
namespace FormKit\Element;
use FormKit\Element;

class TableCell extends Element
{
    public $tagName = 'td';

    public function __construct($attributes = array() ) {
        parent::__construct($this->tagName, $attributes);
    }
}

