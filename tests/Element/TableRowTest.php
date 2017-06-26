<?php
use FormKit\Element\TableRow;
use FormKit\Element\TableCell;

class TableRowTest extends \PHPUnit\Framework\TestCase
{
    function test()
    {
        $tableRow = new TableRow;
        $cell = new TableCell;
        $tableRow->addChild($cell);
        $html = $tableRow->render();
        // select_ok('tr td',1,$html);
    }
}

