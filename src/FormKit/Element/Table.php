<?php
namespace FormKit\Element;
use FormKit\Element;

class Table extends Element
{
    public $tagName = 'table';
    public $class = array('formkit-table','formkit-generic-table');

    public function __construct($attributes = array() ) { 
        parent::__construct($this->tagName, $attributes);
    }

    /**
     * Add elements to a new row
     *
     *      $table->addRow( $element1, $element2 , $element3 );
     *      $table->addRow( array( $element1, $element2 , $element3 ) );
     *
     * @return TableRow
     */
    public function addRow($rows = null) {
        if( ! is_array($rows) ) {
            $rows = func_get_args();
        }
        $row = new TableRow;
        foreach( $rows as $arg ) {
            $cell = new TableCell;
            $cell->addChild( $arg );
            $row->addChild( $cell );
        }
        $this->addChild($row);
        return $row;
    }

}



