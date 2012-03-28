<?php
namespace FormKit\Layout;
use FormKit\Widget\Label;
use FormKit\Element;
use FormKit\Element\TableCell;
use FormKit\Element\TableRow;

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
        return '<table' . $this->_renderAttributes(array('id','class','width','height','border')) . '>'
            . $this->_renderChildren()
            . '</table>';
    }

    public function __toString()
    {
        return $this->render();
    }
}


