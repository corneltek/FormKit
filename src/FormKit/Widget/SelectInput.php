<?php
namespace FormKit\Widget;

class SelectInput extends BaseWidget
{
	public $choices = array();

	public function init()
	{
		$this->setAttributeType('multiple',self::ATTR_BOOLEAN);
	}

	public function render()
	{
		ob_start();
		?><select multiple="<?= $this->multiple ? 'true' : 'false' ?>" name="<?=$this->name?>">
<?php 
foreach( $this->choices as $k => $choice ) {
	if ( is_array($choice) ) {
		$groupLabel = $k;
	}
	else {
		if( is_integer($k) ) {
			$value = $k;
			$label = $choice;
		} else {
			$value = $label = $choice;
		}

		?><option value="<?= $value ?>" 

			<?= ( $this->value == $value )
					? ' selected ' 
					: '' ?>><?= $label ?></option><?php
	}

}
foreach( $this->choices as $key => $choice ) {

} 

?>
</select>
		<?php

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

}



