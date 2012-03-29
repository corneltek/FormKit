<?php
namespace FormKit\Layout;
use FormKit\Widget\Label;
use FormKit\Element;
use FormKit\Element\TableCell;
use FormKit\Element\TableRow;

/**
 * @class Generic table layout, 2 columns
 */
class GenericLayout extends Element
{

    public $class = array('formkit-table','formkit-generic-table');


    public $labelColumnAlign = 'right';

    public $widgetColumnAlign = 'left';


    /**
     * configure label column width
     */
    public $labelColumnWidth;

    /**
     * configure widget column width
     */
    public $widgetColumnWidth;

    public function __construct()
    {

    }

    public function addRow()
    {
        $row = new TableRow;
        $this->addChild( $row );
        return $row;
    }

    public function addWidget($widget)
    {
        $cell = new TableCell;
        $cell->align( $this->labelColumnAlign );
        $cell->width( $this->labelColumnWidth );
        $cell->addClass( 'formkit-column-label' );
        $cell->addChild( new Label($widget->label) );

        $cell2 = new TableCell;
        $cell2->align( $this->widgetColumnAlign );
        $cell2->width( $this->widgetColumnWidth );
        $cell2->addClass( 'formkit-column-widget' );
        $cell2->addChild( $widget );

        $row = new TableRow;
        $row->addChild($cell);
        $row->addChild($cell2);

        $this->addChild( $row );
        return $this;
    }

    public function render( $attributes = array() ) 
    {
        $this->loadAttributes( $attributes );
        return '<table' . $this->_renderAttributes(array(
                    'id','class','width','summary',
                    'cellpadding','cellspacing','height','border'
                )) . '>'
            . $this->_renderChildren()
            . '</table>';
    }

    public function __toString()
    {
        return $this->render();
    }
}


