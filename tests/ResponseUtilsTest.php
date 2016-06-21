<?php
use FormKit\ResponseUtils;

class ResponseUtilsTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        spl_autoload_call('FormKit\ResponseUtils');

        block_start('level-1');
        ?>Block 1<?php
        $content = block_end();
        is('Block 1', $content );

        $content = FormKit\Block::getContent('level-1');
        is('Block 1', $content );
    }
}

