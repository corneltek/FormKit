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
    public $tagName = 'form';
    public $class = array('formkit-form');
    public $enctype = 'multipart/form-data';
    public $closeEmpty = true;
    public $customAttributes = array('method','enctype','target','action','name');

    public function __construct($attributes = array() ) { 
        parent::__construct($this->tagName, $attributes);
    }
}

