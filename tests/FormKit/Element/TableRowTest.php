<?php
use FormKit\Element\TableRow;
use FormKit\Element\TableCell;

class TableRowTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $tableRow = new TableRow;
        ok($tableRow);

        $cell = new TableCell;
        $tableRow->addChild($cell);
        ok($cell);

        $html = $tableRow->render();
        select_ok('tr td',1,$html);
    }
}

