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
        parent::__construct();
    }

    /**
     * Add Widget into a new row , two cells
     */
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
        parent::addWidget($widget);
        return $this;
    }

    public function renderLabel($name, $attributes = array() )
    {
        if( $widget = $this->widgets->get($name) ) {
            $label = new Label($widget->label);
            return $label->render( $attributes );
        }
    }

    public function renderWidget($name, $attributes = array() )
    {
        if( $widget = $this->widgets->get($name) ) {
            return $widget->render( $attributes );
        }
    }

    public function __call($method,$arguments) { 
        if( method_exists($this->table,$method) ) {
            return call_user_func_array( array($this->table,$method), $arguments );
        }
        elseif( method_exists($this->widgets,$method) ) {
            return call_user_func_array( array($this->widgets,$method), $arguments ); 
        }
        else {
            throw new RuntimeException("method $method not found.");
        }
    }
}


