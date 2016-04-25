<?php
namespace FormKit\Widget;

class RadioInput extends BaseWidget
{
    public $class = array('formkit-widget','formkit-widget-radio');

    public $options = array();

    public $tagName = 'div';

    /* render format option */
    public $render_format = '{radio} {label}';

    public function renderOptions($options)
    {
        // is it start from index 0 ?
        $size = count($options);
        $isPair = isset($options[0]) 
                        && isset($options[$size-1]); 

        $html = '';
        foreach( $options as $k => $option ) {
            if( $isPair ) {
                $value = $label = $option;
            } else {
                $label = $k;
                $value = $option;
            }

            $id = $this->getSerialId();
            $radio = sprintf('<input type="radio" name="%s" value="%s" id="%s"', 
                    $this->name,
                    $value,
                    $id ) . ( $this->value == $value ? 'checked' : '' ) . '/>';
            $label = sprintf('<label for="%s">%s</label>', $id , $label);
            $format = $this->render_format;
            $format = str_replace( '{radio}' , $radio , $format );
            $format = str_replace( '{label}' , $label , $format );
            $html .= $format . PHP_EOL;
        }
        return $html;
    }

    public function render( $attributes = array() )
    {
        $this->setAttributes( $attributes );
        return $this->renderOptions( $this->options );
    }


}




