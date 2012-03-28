<?php
namespace FormKit\Widget;


/**
 * $checkbox = new CheckboxInput('confirmed');
 * $checkbox->value(10);
 * $checkbox->checked();
 */
class CheckboxInput extends BaseWidget
{
	public function init() 
	{ 
		$this->type = 'checkbox';
		$this->value = 1;
   	}

	public function check( $value = null ) 
	{
        if( $value !== null )
            $this->checked = $value;
        else
            $this->checked = true;
	}

	public function uncheck()
	{
		$this->uncheck = false;
	}

    public function render()
    {
		ob_start();
		$fieldId = $this->name . '-' . time();
		?>
		<input id="<?= $fieldId ?>" type="hidden" 
			name="<?=$this->name?>" 
			value="<?= ($this->value) ? $this->value : ''; ?>"/>

		<input type="<?= $this->type ?>" <?=$this->_renderBasicAttributes(); ?> 
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




