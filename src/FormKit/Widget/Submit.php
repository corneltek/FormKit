<?php
namespace FormKit\Widget;
use FormKit\Widget\TextInput;

class Submit extends TextInput
{

	public $class = array('formkit-widget','formkit-submit');
	public $type = 'submit';

	public function __construct( $name = null , $attributes = array() )
	{
		parent::__construct($name, $attributes );
	}

}


