<?php

class FormTest extends PHPUnit_Framework_TestCase
{
    function testFormOpenTagAndCloseTag()
    {
        $form = new FormKit\Element\Form(array( 'id' => 'my-id' ));
        is('<form class="formkit-form" id="my-id" enctype="multipart/form-data">',$form->open());
        is('</form>',$form->close());
    }
}

