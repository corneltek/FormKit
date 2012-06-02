<?php
namespace FormKit\Element;
use FormKit\Element;

class TableRow extends Element
{
    public $tagName = 'tr';

    public $customAttributes = array('width','height');

    public function addCell( $element )
    {
        $cell = new TableCell;
        $cell->addChild($element);
        $this->addChild($cell);
        return $this;
    }


}
