<?php
namespace FormKit\Layout;
use FormKit\WidgetCollection;
use ArrayAccess;
use Exception;
use FormKit\FormKit;

class BaseLayout
    implements ArrayAccess
{
    public $widgets;

    function __construct() { 
        $this->widgets = new WidgetCollection;
    }

    /**
     * @param array $widget
     */
    public function addWidgets(array $widgets)
    {
        foreach( $widgets as $widget )
            $this->addWidget( $widget );
        return $this;
    }

    /**
     * Add Widget into a new row , two cells
     */
    public function addWidget($widget)
    {
        $this->widgets[ $widget->name ] = $widget;
        return $this;
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




