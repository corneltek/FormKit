<?php
namespace FormKit\Layout;
use FormKit\Widget\Label;
use FormKit\Element;
use FormKit\Element\Table;
use FormKit\Element\TableCell;
use FormKit\Element\TableRow;
use FormKit\WidgetCollection;
use ArrayAccess;

/**
 * @class Generic table layout, 2 columns
 */
class GenericLayout extends Table
    implements ArrayAccess
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


    public function __construct()
    {
        parent::__construct();
        $this->widgets = new WidgetCollection;
    }

    /**
     * @param array $widget
     */
    public function addWidgets(array $widgets)
    {
        foreach( $widgets as $widget )
            $this->addWidget( $widget );
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

        $this->widgets[ $widget->name ] = $widget;

        $this->addChild( $row );
        return $this;
    }

    public function renderLabel($name, $attributes = array() )
    {
        if( isset($this->widgets[ $name ]) ) {
            $label = new Label($widget->label);
            return $label->render( $attributes );
        }
    }

    public function renderWidget($name, $attributes = array() )
    {
        if( isset($this->widgets[ $name ]) )
            return $this->widgets[ $name ]->render( $attributes );
    }

    public function offsetSet($name,$value)
    {
        $this->widgets[ $name ] = $value;
    }
    
    public function offsetExists($name)
    {
        return isset($this->widgets[ $name ]);
    }
    
    public function offsetGet($name)
    {
        return $this->widgets[ $name ];
    }
    
    public function offsetUnset($name)
    {
        unset($this->widgets[$name]);
    }
}


