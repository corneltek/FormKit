<?php
namespace FormKit\Element;
use FormKit\Element;

class TableRow extends Element
{
    public $tagName = 'tr';

    public function addCell( $element )
    {
        $cell = new TableCell;
        $cell->addChild($element);
        $this->addChild($cell);
        return $this;
    }

    public function render( $attributes = array() ) 
    {
        $this->setAttributes( $attributes );
        $html = '<' . $this->tagName
                . $this->_renderStandardAttributes()
                . $this->_renderAttributes(array('width','height'));

        if( $this->hasChildren() ) {
            $html .= '>';
            $html .= $this->_renderChildren();

            // close tag
            $html .= '</' . $this->tagName . '>';
        } else {
            $html .= '/>';
        }
        return $html;
    }

}
