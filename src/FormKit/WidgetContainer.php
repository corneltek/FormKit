<?php
namespace FormKit;
use ArrayAccess;

class WidgetContainer
    implements ArrayAccess
{
    public $widgets = array();
    public $widgetsByName = array();

    public function add( $widget )
    {
        $this->widgets[ $widget->name ] = $widget;
        $this->widgetsByName[] = $widget;
    }

    public function remove($widget)
    {
        $widgetName = is_string($widget) ? $widget : $widget->name;
        if( false !== ($idx = array_search( $widgetName , $this->widgetsByName ) )) {
            unset( $this->widgetsByName[ $idx ] );
        }
        unset( $this->widgets[ $widgetName ] );
    }

    public function get($name)
    {
        if( isset($this->widgets[ $name ]) )
            return $this->widgets[ $name ];
    }


    public function __get($name)
    {
        return $this->get( $name );
    }



    
    public function offsetSet($name,$value)
    {
        $this->widgets[ $name ] = $value;
        $this->widgetsByName[] = $name;
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
        if( false !== ($idx = array_search( $name , $this->widgetsByName ) )) {
            unset( $this->widgetsByName[ $idx ] );
        }
    }

}

