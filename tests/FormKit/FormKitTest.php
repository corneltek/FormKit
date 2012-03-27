<?php

class FormKitTest extends PHPUnit_Framework_TestCase
{
    function testTextInput()
    {
        $widget = FormKit\FormKit::text('name');
        $widget->label( 'Name' );
        $html = $widget->render();
        is( '<input type="text" name="name" value="" />', $html );
    }

    function testCheckbox()
    {
        $widget = FormKit\FormKit::checkbox('confirmed');
        $widget->label('Confirmed');
        $html = $widget->render();
        // is( '<input type="checkbox" name="name" value="" />', $html );
    }


    function testOutput()
    {
		$html = '';

		// generate forms
		$widget = FormKit\FormKit::text( 'username' );
		$html .= $widget->render();

		$widget = FormKit\FormKit::checkbox( 'confirmed' );
		$html .= $widget->render();




		file_put_contents( 'tests/index.html', $html );
    }

}


