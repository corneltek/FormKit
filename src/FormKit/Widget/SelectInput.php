<?php
namespace FormKit\Widget;

class SelectInput extends BaseWidget
{
    public $class = array('formkit-widget','formkit-select');
    public $options = array();
    public $multiple;

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
        $this->loadAttributes( $attributes );
        ob_start();
        ?><select <?=$this->_renderAttributes(array('multiple','name')); ?>>
            <? echo $this->renderOptions($this->options); ?>
        </select>
        <?php
        $html = ob_get_contents();
        ob_end_clean();
        $html .= $this->renderHint();
        return $html;
    }

}



