<?php
namespace FormKit\Layout;
use FormKit\Element\Fieldset;
use FormKit\Element\Legend;
use FormKit\Widget\Label;
use DOMText;

class FieldsetLayout extends BaseLayout
{
    public $fieldset;

    public function __construct( $legendText = null ) {
        $this->fieldset = new Fieldset;
        $this->fieldset->addClass('formkit-layout-fieldset');
        if( $legendText ) {
            $legend   = new Legend( $legendText );
            $this->fieldset->addChild( $legend );
        }
        parent::__construct();
    }

    public function __call($method,$arguments)
    {
        if ( method_exists($this->fieldset, $method) ) {
            return call_user_func_array(array($this->fieldset, $method),$arguments);
        }
        throw new Exception($method . " does not exist.");
    }

    public function layoutWidget($widget)
    {
        $label = new \FormKit\Widget\Label( $widget->label );
        $clear = new \FormKit\Element\ClearDiv;
        $newLine = new DOMText("\n");
        $this->fieldset->addChild( $label );
        $this->fieldset->addChild( $widget );

        if($widget->hint) {
            $hint  = new \FormKit\Widget\Hint( $widget->hint );
            $this->fieldset->addChild( $hint );
        }
        $this->fieldset->addChild( $clear );
    }

    public function __toString()
    {
        return $this->fieldset->render();
    }
}




