<?php
namespace FormKit\Element;
use FormKit\Element;

class TableRow extends Element
{
    public $tagName = 'tr';

    public function __construct($attributes = array() ) { 
        parent::__construct($this->tagName, $attributes);
    }

    public function addCell( $element )
    {
        $cell = new TableCell;
        $cell->addChild($element);
        $this->addChild($cell);
        return $this;
    }


}
