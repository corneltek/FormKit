<?php

class TextareaInputTest extends \PHPUnit\Framework\TestCase
{
    function test()
    {
        $textarea = new FormKit\Widget\TextareaInput('address');
        $html = $textarea->render(array( 
            'rows' => 30,
            'cols' => 45,
        ));

        $dom = new DOMDocument;
        $dom->loadXml($html);
        is('formkit-widget formkit-widget-textarea',$dom->documentElement->getAttribute('class'));
        is('address',$dom->documentElement->getAttribute('name'));
        is('45',$dom->documentElement->getAttribute('cols'));
        is('30',$dom->documentElement->getAttribute('rows'));
    }
}

