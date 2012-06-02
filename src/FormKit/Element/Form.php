<?php
namespace FormKit\Element;
use FormKit\Element;

class Form extends Element
{
    /**
     * application/x-www-form-urlencoded
     * multipart/form-data
     * text/plain
     *
     *     $form->enctype('multipart/form-data');
     *     $form->enctype('application/x-www-form-urlencoded');
     *     $form->enctype('text/plain');
     */
    public $class = array('formkit-form');
    public $enctype = 'multipart/form-data';

    public function render( $attributes = array() ) 
    {
        $this->setAttributes( $attributes );
        return '<form' . $this->_renderAttributes(
                    array('id','class','action','name','method','enctype','target')) . '>'
            . $this->_renderChildren()
            . '</form>';
    }
}

