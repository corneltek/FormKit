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
 * @class Generic table layout is a 2 column table layout.
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


    /* tbody */
    public $body;

    /* thead */
    public $header;

    /* footer */
    public $footer;

    public function __construct() { 
        $this->table = new \FormKit\Element\Table;
        $this->table->addClass('formkit-layout-generic');
        $this->body = new Element('tbody');

        $this->table->addChild($this->body);
        parent::__construct();
    }

    public function getHeader() {
        if( ! $this->header ) {
            $this->header = new Element('thead');
            $this->table->insert($this->header);
        }
        return $this->header;
    }

    public function getFooter() {
        if( ! $this->footer ) {
            $this->footer = new Element('tfoot');
            $this->table->addChild( $this->footer );
        }
        return $this->footer;
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
        if( $widget->label ) {
            $cell->addChild( new Label($widget->label) );
        }

        $cell2 = new TableCell;
        $cell2->align( $this->widgetColumnAlign );
        $cell2->width( $this->widgetColumnWidth );
        $cell2->addClass( 'formkit-column-widget' );
        $cell2->addChild( $widget );

        $row = new TableRow;
        $row->addChild($cell);
        $row->addChild($cell2);

        $this->body->addChild( $row );
        return $this;
    }

    public function render()
    {
        return $this->table->render();
    }

    public function __call($method,$arguments) { 
        // mix-in
        return call_user_func_array( array($this->table,$method), $arguments );
    }
}


