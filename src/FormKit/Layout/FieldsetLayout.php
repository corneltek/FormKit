<?php
namespace FormKit\Layout;
use FormKit\Element\Fieldset;
use FormKit\Element\Legend;
use FormKit\Widget\Label;
use DOMText;

class FieldsetLayout extends BaseLayout
{
    public $fieldset;

    function __construct( $legendText = null ) {
        $this->fieldset = new Fieldset;
        $this->fieldset->addClass('formkit-layout-fieldset');
        if( $legendText ) {
            $legend   = new Legend( $legendText );
            $this->fieldset->addChild( $legend );
        }
        parent::__construct();
    }

    function __call($method,$arguments)
    {
        return call_user_func_array(array($this->fieldset,$method),$arguments);
    }

    function layoutWidget($widget)
    {
        $label = new \FormKit\Widget\Label( $widget->label );
        $clear = new \FormKit\Element\ClearDiv;
        $newLine = new DOMText("\n");
        $this->fieldset->addChild( $label );
        $this->fieldset->addChild( $widget );
        $this->fieldset->addChild( $clear );
    }

    function __toString() {
        return $this->fieldset->render();
    }
}




