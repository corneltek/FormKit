<?php
namespace FormKit\Layout;
use FormKit\Element;
use FormKit\Widget\Label;

class TableCell extends Element
{
    public function render()
    {
        return '<td' . $this->_renderAttributes(array('id','class','width','height')) . '>'
            . $this->_renderChildren()
            . '</td>';
    }
}

class TableRow extends Element
{

    public function addCell( $element )
    {
        $cell = new TableCell;
        $cell->addChild($element);
        $this->addChild($cell);
        return $this;
    }

    public function render()
    {
        return '<tr' . $this->_renderAttributes(array('id','class','width','height')) . '>'
            . $this->_renderChildren()
            . '</tr>';
    }
}

class GenericTable extends Element
{
    public function __construct()
    {

    }

    public function addWidget($widget)
    {
        $row = new TableRow;
        $row->addCell( new Label($widget->label) );
        $row->addCell( $widget );
        $this->addChild( $row );
        return $this;
    }

    public function render() 
    {
        return '<table' . $this->_renderAttributes(array('id','class')) . '>'
            . $this->_renderChildren()
            . '</table>';
    }

    public function __toString()
    {
        return $this->render();
    }
}


