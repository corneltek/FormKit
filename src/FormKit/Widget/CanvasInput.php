<?php
namespace FormKit\Widget;

class CanvasInput extends BaseWidget
{
    public $js = array( 'js/jscanvas/jscanvas.js' );
    public function render( $attributes = array() )
    {
        $this->setAttributes( $attributes );
        $this->_setAttribute('data-value', $this->value);
        $this->_setAttribute('data-name', $this->name);
        return '<span class="formkit-canvas"'
            . $this->_renderAttributes(array(
                'class', 'style'
            ))
            . '><input type="hidden"'
            . $this->_renderAttributes(array(
                'id','name','value'
            ))
            . '/><input class="color" value="ff0000"/><canvas style="background:url('.htmlspecialchars($this->background).') no-repeat"'
            . $this->_renderAttributes(array(
                'width','height'
            ))
            . '/></span>'
            . $this->renderHint();
    }
}

