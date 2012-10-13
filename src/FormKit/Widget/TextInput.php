<?php
namespace FormKit\Widget;

class TextInput extends BaseWidget
{

    /**
     * @var string $tagName tag name for widget.
     */
    public $tagName = 'input';

    /**
     * @var array class names.
     */
    public $class = array('formkit-widget','formkit-widget-text');

    /**
     * @var string widget type
     */
    public $type = 'text';


    /**
     * @var array This attributes is for defined class members.
     */
    public $customAttributes = array(
        'name',
        'type',
        // 'dataDateFormat', 'dataTimeFormat', 'dataAmpm',
        'dataUrl', 'dataMaxWidth', 'dataMaxHeight'
    );

    /**
     * Render Widget with attributes
     *
     * @param array $attributes
     * @param string HTML string
     */
    public function render( $attributes = array() )
    {
        return parent::render( $attributes );
    }

}


