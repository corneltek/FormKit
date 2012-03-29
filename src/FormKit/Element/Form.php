<?php
namespace FormKit\Element;
use FormKit\Element;

class Form extends Element
{
	/**
	 * application/x-www-form-urlencoded
     * multipart/form-data
     * text/plain
	 */
	public $class = array('formkit-form');
	public $enctype = 'multipart/form-data';

    public function render( $attributes = array() ) 
    {
        $this->loadAttributes( $attributes );
        return '<form' . $this->_renderAttributes(
                    array('id','class','action','name','method','enctype','target')) . '>'
            . $this->_renderChildren()
            . '</form>';
    }
}

