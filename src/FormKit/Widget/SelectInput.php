<?php
namespace FormKit\Widget;

class SelectInput extends BaseWidget
{
    public $class = array('formkit-widget','formkit-widget-select');
    public $options = array();
    public $multiple;
    public $allow_empty;

    public function renderGroup($label,$options)
    {
        $html = '<optgroup label="'.$label.'">';
        $html .= $this->renderOptions( $options );
        $html .= '</optgroup>';
        return $html;
    }

    public function renderOptions($options)
    {
        // is it start from index 0 ?
        $size = count($options);
        $pair = isset($options[0]) && (
            isset($options[$size-1]) ); 

        $html = '';

        if( $this->allow_empty ) {
            $html .= '<option></option>' . "\n";
        }

        foreach( $options as $k => $option ) {
            if ( is_array($option) ) {
                $html .= $this->renderGroup($k,$option);
            }
            else {
                if( $pair ) {
                    $value = $label = $option;
                } else {
                    $label = $k;
                    $value = $option;
                }

                $html .= '<option value="' . $value . '"';
                if( $this->value == $value )
                    $html .=' selected';
                $html .= '>' . $label . '</option>' . PHP_EOL;
            }
        }
        return $html;
    }

    public function render( $attributes = array() )
    {
        $this->setAttributes( $attributes );
        if( $this->readonly ) {
            $first = null;
            foreach( $this->options as $label => $value ) {
                if( $value == $this->value )
                    return $label;
                $first = $first ?: $label;
            }
            return $first;
        }
        ob_start();
        ?><select 
            <?=$this->renderAttributes(); ?>
            <?=$this->_renderAttributes(array('multiple')); ?>>
            <?=$this->renderOptions($this->options); ?>
        </select>
        <?php
        $html = ob_get_contents();
        ob_end_clean();
        $html .= $this->renderHint();
        return $html;
    }

}



