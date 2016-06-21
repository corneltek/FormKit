<?php
namespace FormKit {
class ResponseUtils {  }

class Block {

    static $blocks = array();
    static $blockContents = array();

    static function push($block = null) { 
        if( ! $block )
            $block = uniqid();
        self::$blocks[] = $block;
        return $block;
    }

    static function pop() {
        return array_pop(self::$blocks);
    }

    static function getContent($name) {
        if( isset(self::$blockContents[$name]) ) {
            return self::$blockContents[$name];
        }
    }

    static function setContent($name, $content) {
        self::$blockContents[ $name ] = $content;
    }
}

}
namespace {
    use FormKit\Block;

    function block_start($blockName = null) {
        ob_start();
        return Block::push($blockName);
    }

    function block_end() {
        $content = ob_get_contents();
        ob_end_clean();
        $n = Block::pop();
        Block::setContent( $n , $content );
        return $content;
    }
}
