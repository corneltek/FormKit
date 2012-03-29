<?php
namespace FormKit;
use CascadingAttribute;

abstract class Element extends CascadingAttribute
{

    /**
     * @var array class name
     */
    public $class = array();



    /**
     * Children elements
     */
    public $children = array();


    /**
     * @var array id field
     */
    public $id = array();


    public function addClass($class)
    {
        $this->class[] = $class;
        return $this;
    }

    public function addId($id)
    {
        $this->id[] = $id;
        return $this;
    }

    public function addChild($child)
    {
        $this->children[] = $child;
        return $this;
    }

    protected function _renderChildren()
    {
        return join("\n",array_map(function($item) { 
            return $item->render() . PHP_EOL;
        }, $this->children ));
    }

    protected function _renderAttributes($keys) 
    {
        $html = '';
        foreach( $keys as $key ) {
            $val = $this->$key;
            if( $val ) {
                $html .= sprintf(' %s="%s"', 
                        $key, 
                        htmlspecialchars( is_array($val) ? join(' ',$val) : $val ) 
                    );
            }
        }
        return $html;
    }

    abstract public function render( $attributes = array() );

    public function __toString()
    {

        return $this->render();
    }
}

