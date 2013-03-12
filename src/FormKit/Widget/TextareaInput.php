<?php
namespace FormKit\Widget;

class TextareaInput extends BaseWidget
{
    public $tag;
    public $tagName = 'textarea';
    public $class = array('formkit-widget','formkit-widget-textarea');

    /**
     * Render Widget with attributes
     *
     * @param array $attributes
     * @param string HTML string
     */
    public function render($attributes = null)
    {
        if($attributes)
            $this->setAttributes( $attributes );

        return '<textarea'
            . $this->renderAttributes()
            . '>'
            . htmlspecialchars($this->value, ENT_NOQUOTES, 'UTF-8')
            . '</textarea>';
    }

}


