<?php

class FormKitTest extends \PHPUnit\Framework\TestCase
{
    function testTextInput()
    {
        $widget = FormKit\FormKit::text('name');
        ok($widget);
        $widget->label( 'Name' );
        $html = $widget->render();

        // is( '<input class="formkit-widget formkit-widget-text" type="text" name="name"/>', $html );

        $dom = new DOMDocument;
        $dom->loadXml($html);
        is('formkit-widget formkit-widget-text',$dom->documentElement->getAttribute('class'));
        is('name',$dom->documentElement->getAttribute('name'));
        is('text',$dom->documentElement->getAttribute('type'));
    }

    function testCheckbox()
    {
        $widget = FormKit\FormKit::checkbox('confirmed');
        $widget->label('Confirmed');
        $html = $widget->render();
        ok($html);
        // is( '<input type="checkbox" name="name" value="" />', $html );
    }

    function testDynamicLoader()
    {
        $canvas = FormKit\FormKit::canvas('test');
        ok($canvas);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testLoadFail()
    {
        $blah = FormKit\FormKit::blah('blah');
    }


    function testOutput()
    {
        $html = '';

        // generate forms
        $widget = FormKit\FormKit::text( 'username' );
        $html .= $widget->render();

        $widget = FormKit\FormKit::checkbox( 'confirmed' );
        $html .= $widget->render();

        $widget = FormKit\FormKit::select( 'country' );
        // $widget->choices(array(  ));
        $html .= $widget->render();

        // FIXME:
        // select_ok('select',true,$html);
        // select_ok('input[type="checkbox"]',true,$html);
        # file_put_contents( 'tests/index.html', $html );
    }

}


