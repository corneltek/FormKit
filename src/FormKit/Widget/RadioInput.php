<?php
namespace FormKit\Widget;

class RadioInput extends BaseWidget
{
    public $class = array('formkit-widget','formkit-radio');

	public $options = array();

    /* render format option */
    public $render_format = '{radio} {label}';

    public function renderOptions($options)
    {
        // is it start from index 0 ?
        $size = count($options);
        $pair = isset($options[0]) && (
            isset($options[$size-1]) ); 

        $html = '';
        foreach( $options as $k => $option ) {
            if( $pair ) {
                $value = $label = $option;
            } else {
                $label = $k;
                $value = $option;
            }

            $id = $this->getSerial();

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
        return $this->renderOptions( $this->options )
            . $this->renderHint();
    }


}




