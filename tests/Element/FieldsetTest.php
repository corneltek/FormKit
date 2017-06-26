<?php
use FormKit\Element\Fieldset;
use FormKit\Element\Legend;

class FieldsetTest extends \PHPUnit\Framework\TestCase
{
    public function test()
    {
        $legend = new Legend('MyLegend');
        $fieldset = new Fieldset();
        $fieldset->addChild( $legend );
        $html = $fieldset->render();
        $this->assertXmlStringEqualsXmlFile('tests/fixture/legend-fieldset.xml', $html);
    }

    public function testDOMChild()
    {
        $legend = new Legend;
        $legend->addChild( new DOMText('DOMText Test') );
        $html = $legend->render();
        $this->assertXmlStringEqualsXmlFile('tests/fixture/legend_dom_child.xml', $html);
    }
}

