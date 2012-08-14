<?php
namespace FormKit\Widget;


/**
 * Checkbox Widget
 *
 * $checkbox = new CheckboxInput('confirmed');
 * $checkbox->value(10);
 * $checkbox->checked();
 */
class CheckboxInput extends BaseWidget
{
    public $class = array('formkit-widget','formkit-widget-checkbox');
    public $type = 'checkbox';

    public function init() 
    { 
        if( $this->value )
            $this->checked = $this->value;
    }

    public function check( $value = null ) 
    {
        if( $value !== null ) {
            $this->checked = $value;
        } else {
            $this->checked = true;
        }
        return $this;
    }

    public function uncheck()
    {
        $this->checked = false;
        return $this;
    }

    public function toggleCheck()
    {
        $this->checked = ! $this->checked;
        return $this;
    }

    public function render( $attributes = array() )
    {
        $this->setAttributes( $attributes );
        ob_start();
        $fieldId = $this->getSerialId();
        ?><input id="<?= $fieldId ?>" type="hidden" 
            name="<?=$this->name?>" 
            value="<?= ($this->value) ? $this->value : ''; ?>"/>
        <input <?=$this->_renderAttributes(array('type','class','id')); ?> 
            <?php if( $this->checked ): ?>checked<?php endif ?> onclick=" 
                var el = document.getElementById('<?= $fieldId ?>');
                    el.value = (el.value == '<?= $this->value ?>') ? '' : '<?= $this->value ?>';
            "/>
        <?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}

