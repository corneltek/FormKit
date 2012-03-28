<?php
namespace FormKit\Widget;
use CascadingAttribute;

abstract class BaseWidget extends \FormKit\Element
{

    /**
     * @var string field name
     */
    public $name;



    /**
     * @var array css style sheets
     */
    public $css = array();


    /**
     * @var array js files
     */
    public $js = array();


    public function __construct($name, $attributes = array() )
    {
        $this->name = $name;
        $this->attributes += $attributes;
        $this->init();
    }


    public function getStylesheets()
    {
        return $this->css;
    }

    public function getJavascripts()
    {
        return $this->js;
    }


    public function init()
    {
        $this->setAttributeType( 'class', self::ATTR_ARRAY );
        $this->setAttributeType( 'id', self::ATTR_ARRAY );
        $this->setAttributeType( 'name', self::ATTR_STRING );
        $this->setAttributeType( 'type', self::ATTR_STRING );
        $this->setAttributeType( 'value', self::ATTR_STRING );

        // virtual attribute (not for rendering widget elements )
        $this->setAttributeType( 'label', self::ATTR_STRING );
        $this->setAttributeType( 'hint', self::ATTR_STRING );
        $this->setAttributeType( 'tooltip', self::ATTR_STRING );
    }

    protected function _renderBasicAttributes()
    {
        return $this->_renderAttributes(array('class id'));
    }

}

