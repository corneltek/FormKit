<?php

class GridLayoutTest extends \PHPUnit\Framework\TestCase
{
    public function test()
    {
        $fooText = new FormKit\Widget\TextInput('foo[]');
        $barText = new FormKit\Widget\TextInput('bar[]');

        $gridLayout = new FormKit\Layout\GridLayout();
        $gridLayout->setHeaderLabels(array( $fooText ));

        $gridLayout->insertWidgetsByRow( array($fooText, $barText) );

        $html = $gridLayout->render();
        $dom = new DOMDocument;
        $dom->loadHTML($html);
        ok($dom);
    }
}

