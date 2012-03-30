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

}

