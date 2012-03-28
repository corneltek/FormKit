<?php
namespace FormKit\Widget;

class SelectInput extends BaseWidget
{
	public $options = array();
    public $multiple;

	public function render()
	{
		ob_start();
        ?><select <?=$this->_renderAttributes(array('multiple','name')); ?>>
<?php 
foreach( $this->options as $k => $option ) {
	if ( is_array($option) ) {
		$groupLabel = $k;
	}
	else {
		if( is_integer($k) ) {
			$value = $k;
			$label = $option;
		} else {
			$value = $label = $option;
		}

		?><option value="<?= $value ?>" 

			<?= ( $this->value == $value )
					? ' selected ' 
					: '' ?>><?= $label ?></option><?php
	}

}
?>
</select>
		<?php
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

}



