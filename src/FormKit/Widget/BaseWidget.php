<?php
namespace FormKit\Widget;
use CascadingAttribute;

abstract class BaseWidget extends CascadingAttribute
{

    public function __construct()
    {
        $this->setAttributeType( 'class', self::ATTR_ARRAY );
        $this->setAttributeType( 'id', self::ATTR_ARRAY );
        $this->setAttributeType( 'name', self::ATTR_STRING );
        $this->setAttributeType( 'type', self::ATTR_STRING );
        $this->setAttributeType( 'value', self::ATTR_STRING );
    }

    abstract public function render();

    public function __toString()
    {
        return $this->render();
    }
}

