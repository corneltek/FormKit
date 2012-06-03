<?php
namespace FormKit\Widget;

class CanvasInput extends BaseWidget
{
    public $js = array( 'js/jscanvas/jscanvas.js' );

    public function render( $attributes = array() )
    {
        $this->setAttributes( $attributes );
        $this->setAttributeValue('data-value', $this->value);
        $this->setAttributeValue('data-name', $this->name);
        return '<span class="formkit-canvas"'
            . $this->_renderStandardAttributes()
            . '><input type="hidden"'
            . $this->_renderAttributes(array('id','name','value'))
            . '/><input class="color" value="ff0000"/><canvas style="background:url('.htmlspecialchars($this->background).') no-repeat"'
            . $this->_renderAttributes(array('width','height'))
            . '/></span>'
            . $this->renderHint();
    }
}

