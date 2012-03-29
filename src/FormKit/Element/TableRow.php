<?php
namespace FormKit\Element;
use FormKit\Element;

class TableRow extends Element
{

    public function addCell( $element )
    {
        $cell = new TableCell;
        $cell->addChild($element);

        $this->addChild($cell);
        return $this;
    }

    public function render( $attributes = array() ) 
    {
        $this->loadAttributes( $attributes );
        return '<tr' . $this->_renderAttributes(array('id','class','width','height')) . '>'
            . $this->_renderChildren()
            . '</tr>';
    }
}
