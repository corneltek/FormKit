<?php
namespace FormKit\Layout;
use FormKit\WidgetCollection;
use ArrayAccess;
use Exception;
use FormKit\FormKit;

abstract class BaseLayout
    implements ArrayAccess
{

    /**
     * @var WidgetCollection
     */
    public $widgets;

    function __construct() { 
        $this->widgets = new WidgetCollection;
    }

    /**
     * @param array $widget
     */
    public function addWidgets(array $widgets)
    {
        foreach( $widgets as $widget ) {
            $this->addWidget( $widget );
        }
        return $this;
    }

    /**
     * Add Widget into a new row , two cells
     */
    public function addWidget($widget)
    {
        $this->widgets->add($widget); 
        $this->layoutWidget($widget);
        return $this;
    }

    abstract public function layoutWidget($widget);

    public function getWidget($name) {
        return $this->widgets->get($name);
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



    public function offsetSet($name,$value) {
        $this->widgets[ $name ] = $value;
    }
    
    public function offsetExists($name) {
        return isset($this->widgets[ $name ]);
    }
    
    public function offsetGet($name) {
        return $this->widgets[ $name ];
    }
    
    public function offsetUnset($name) {
        unset($this->widgets[$name]);
    }

}




