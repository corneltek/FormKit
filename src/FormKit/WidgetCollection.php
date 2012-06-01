<?php
namespace FormKit;
use ArrayAccess;
use Exception;
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

    /* save widgets by name */
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
        $this->widgets[] = $widget;
        $this->widgetsByName[ $widget->name ] = $widget;
        return $this;
    }

    public function remove($widget)
    {
        // get widget name
        $widgetName = is_string($widget) ? $widget : $widget->name;
        if( isset($this->widgetsByName[$widgetName ] ) ) {
            unset($this->widgetsByName[$widgetName]);
            foreach( $this->widgets as $index => $w ) {
                if( $w->name === $widgetName ) {
                    array_splice( $this->widgets , $index , 1 );
                    break;
                }
            }
        }
        return $this;
    }

    public function get($name)
    {
        if( isset($this->widgetsByName[ $name ]) )
            return $this->widgetsByName[ $name ];
    }

    public function render($name , $attributes = array() )
    {
        if( $widget = $this->get($name) )
            return $widget->render( $attributes );
    }

    public function __get($name)
    {
        if( isset($this->widgetsByName[ $name ]) ) {
            return $this->widgetsByName[ $name ];
        } else {
            throw new Exception("Undefined widget $name");
        }
    }
    
    public function offsetSet($name,$widget)
    {
        $this->widgets[] = $widget;
        $this->widgetsByName[$name] = $widget;
    }
    
    public function offsetExists($name)
    {
        return isset($this->widgetsByName[ $name ]);
    }
    
    public function offsetGet($name)
    {
        return $this->widgetsByName[ $name ];
    }
    
    public function offsetUnset($name)
    {
        $this->remove($name);
    }

    public function size()
    {
        return count($this->widgets);
    }

}

