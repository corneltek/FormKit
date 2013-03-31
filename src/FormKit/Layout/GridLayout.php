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
 * @class Grid table layout is a simple table layout.
 *
 * $gridLayout = new GridLayout;
 * $gridLayout->setHeaderLabels( $widget1->label, $widget2, $widget3 )
 * $gridLayout->insertWidgetsByRow( $widget1 , $widget2 , $widget3 );
 */
class GridLayout
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

    public $widgets;

    /* tbody */
    public $body;

    /* thead */
    public $header;

    /* footer */
    public $footer;

    public function __construct() { 
        $this->widgets = new WidgetCollection;
        $this->table = new \FormKit\Element\Table;
        $this->table->addClass('formkit-layout-generic');
        $this->body = new Element('tbody');
        $this->table->addChild($this->body);
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


    public function setHeaderLabels($labels)
    {
        $labels = array_map(function($a) {
            if ( $a instanceof \FormKit\BaseWidget ) {
                return $a->label;
            }
            return $a;
        }, $labels);

        $thead = $this->getHeader();
        $tr = new Element('tr');
        $tr->appendTo($thead);

        foreach( $labels as $label ) {
            $cell = new Element('th');
            $cell->append( $label );
            $tr->addChild($cell);
        }
    }

    public function insertWidgetsByRow($widgets)
    {
        $tr = new Element('tr');
        $tr->appendTo($this->body);
        foreach( $widgets as $widget ) {
            $cell = new TableCell;
            $cell->append($widget);
            $cell->appendTo($tr);
        }
    }

    public function render()
    {
        return $this->table->render();
    }

    public function __toString()
    {
        return $this->render();
    }

    public function __call($method,$arguments) { 
        // mix-in
        return call_user_func_array( array($this->table,$method), $arguments );
    }
}


