<?php
namespace FormKit\Element;
use FormKit\Element;

class Table extends Element
{
    public $tagName = 'table';
    public $class = array('formkit-table','formkit-generic-table');
    public $customAttributes = array(
        'width', 
        'height', 
        'cellpading', 
        'cellspacing',
        'border',
        'summary'
    );

    public function __construct($attributes = array() ) { 
        parent::__construct($this->tagName, $attributes);
    }

    /**
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



