<?php
use FormKit\Element;

class ElementTest extends \PHPUnit\Framework\TestCase
{
    function test()
    {
        $element = new Element('div');
        ok($element);
        is( '<div/>' , $element->render() );

        $element->addChild( new DOMText('Text') );
        is( '<div>Text</div>' , $element->render() );
    }
}


