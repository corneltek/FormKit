<?php
namespace FormKit\Widget;


/**
 * Checkbox Widget
 *
 * $checkbox = new CheckboxInput('confirmed');
 * $checkbox->value(10);
 * $checkbox->checked();
 */
class CheckboxInput extends TextInput
{
    public $class = array('formkit-widget','formkit-widget-checkbox');
    public $type = 'checkbox';
    public $tagName = 'input';

    /**
     * @var boolean
     *
     * When boolean_value option is enabled, the value will be converted to 1 and 0
     * And the field value can be toggled by inline javascript.
     */
    public $boolean_value = true;

    public function init($a)
    {
        /*
        if ( $this->boolean_value && $this->value ) {
            $this->checked = $this->value;
        }
        */
        parent::init($a);
    }

    public function check()
    {
        $this->checked = true;
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
        if (! $this->boolean_value) {
            return parent::render($attributes);
        }

        // Here we use a javascript to switch the hidden value.
        $this->setAttributes( $attributes );
        ob_start();
        $fieldId = $this->generateSerialId();
        ?><input id="<?= $fieldId ?>" type="hidden" 
            name="<?= $this->name ?>" 
            value="<?= $this->value || $this->checked ? '1' : '0'; ?>"/>

        <input <?php echo $this->_renderAttributes(array('class','type')); echo $this->value || $this->checked ? 'checked' : ''; ?>
        onclick=" 
            var el = document.getElementById('<?= $fieldId ?>');
                el.value = el.value != '1' ? '1' : '0';
        "/><?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}

