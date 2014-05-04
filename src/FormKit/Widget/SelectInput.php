<?php
namespace FormKit\Widget;

function render_value($val) {
    if ( $val !== null ) {
        if ( is_bool($val) ) {
            if ( false === $val ) {
                return 0;
            } else if ( true === $val ) {
                return 1;
            }
        }
    }
    return $val;
}

class SelectInput extends BaseWidget
{
    public $class = array('formkit-widget','formkit-widget-select');
    public $options = array();
    public $multiple;
    public $allow_empty;

    public $tagName = 'select';

    /**
     * @var mixed sort flag
     */
    public $sort_by_label = true;

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
        $indexed = isset($options[0]) && ( isset($options[ $size - 1 ]) );
        $html = '';

        if( $this->allow_empty !== null ) {
            if ( is_bool($this->allow_empty) ) {
                $html .= '<option></option>';
            } elseif ( is_string($this->allow_empty) ) {
                $html .= "<option>" . $this->allow_empty . "</option>";
            } elseif ( is_array($this->allow_empty) ) {
                $html .= "<option value=\"". $this->allow_empty[0] ."\">" . $this->allow_empty[1] . "</option>";
            } else {
                $html .= "<option value=\"{$this->allow_empty}\"></option>";
            }
        }

        $list = array();
        if( $indexed ) {
            foreach( $options as $i => $option ) {
                $list[] = array(
                    'label' => (is_array($option) ? $i : $option),
                    'value' => render_value($option),
                );
            }
        } else {
            foreach( $options as $label => $option ) {
                $list[] = array(
                    'label' => $label,
                    'value' => render_value($option),
                );
            }
        }

        if( ! $indexed && $this->sort_by_label ) {
            usort($list, function($a,$b) {
                return strcmp($a["label"], $b["label"]);
            });
        }

        $found = false;
        foreach( $list as $option ) {
            if( is_array($option['value']) ) {
                $html .= $this->renderGroup($option['label'],$option['value']);
            } else {
                $value = $option['value'];
                $label = $option['label'];
                $html .= '<option value="' . render_value($value) . '"';
                if ( $this->value == $value ) {
                    $html .=' selected';
                    $found = true;
                }
                $html .= '>' . $label . '</option>';
            }
        }

        // for plain value, we should just render it.
        if ( ! $found && $this->value ) {
            $html .= '<option value="' . render_value($this->value) . '" selected';
            $html .= '>' . $this->value . '</option>';
        }
        return $html;
    }

    public function render( $attributes = array() )
    {
        $this->setAttributes( $attributes );
        if( $this->readonly )
            $this->disabled = true;

        $optionsHtml = $this->renderOptions($this->options);
        ob_start();
        ?><select <?php
            echo $this->renderAttributes();
            echo $this->_renderAttributes(array('multiple')); 
            ?>><?=$optionsHtml?>
        </select><?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

}



