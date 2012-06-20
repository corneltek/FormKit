<?php

class TableTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $table = new FormKit\Element\Table;
        $table->addRow('column1', 'column2');

        $html = $table->render();

        select_ok( 'table td' , 2 , $html );
        select_ok( 'table tr' , 1 , $html );
    }
}

