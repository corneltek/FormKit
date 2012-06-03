<?php
namespace FormKit\Layout;
use FormKit\Widget\Label;
use FormKit\Element;
use FormKit\Element\Table;
use FormKit\Element\TableCell;
use FormKit\Element\TableRow;
use FormKit\WidgetCollection;
use ArrayAccess;
use RuntimeException;

/**
 * @class Generic table layout, 2 columns
 */
class GenericLayout extends BaseLayout
{
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

    public $table;

    public function __construct() { 
        $this->table = new \FormKit\Element\Table;
        $this->table->addClass('formkit-layout-generic');
        parent::__construct();
    }

    /**
     * Add Widget into a new row , two cells
     */
    public function layoutWidget($widget)
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

    public function __call($method,$arguments) { 
        // mix-in
        return call_user_func_array( array($this->table,$method), $arguments );
    }
}


