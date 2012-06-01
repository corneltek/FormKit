<?php
namespace FormKit;
use ArrayAccess;
use FormKit\FormKit;

/**
 * WidgetCollection class is a simple container,
 * contains widgets and their sequence.
 *
 * WidgetContains provides a better way to retrieve widget by names or by 
 * sequence.
 */
class WidgetCollection
    implements ArrayAccess
{
    public $widgets = array();
    public $widgetsByName = array();

    public function getJavascripts()
    {
        if( false === FormKit::$useJs )
            return array();

        $urls = array();
        $path = FormKit::$assetPath;
        foreach( $this->widgets as $widget ) {
            foreach( $widget->getJavascripts() as $url ) {
                $urls[] = $url;
            }
        }
        return $urls;
    }

    public function getStylesheets()
    {
        if( false === FormKit::$useCss )
            return array();

        $path = FormKit::$assetPath;
        $urls = array();
        foreach( $this->widgets as $widget ) {
            foreach( $widget->getStylesheets() as $url ) {
                $urls[] = $url;
            }
        }
        return $urls;
    }

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

    public function render($name , $attributes = array() )
    {
        if( $widget = $this->get($name) )
            return $widget->render( $attributes );
    }

    public function __get($name)
    {
        if( isset($this->widgets[ $name ]) )
            return $this->widgets[ $name ];
        else
            throw new Exception("Undefined widget $name");
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

