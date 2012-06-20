<?php
namespace FormKit;
use InvalidArgumentException;
use Exception;

/**
 * Form Widget Factory class
 */
class FormKit
{

    /**
     * @var bool flag to enable/disable stylesheets.
     */
    static $useStylesheet    = true;


    /**
     * @var bool flag to enable/disable javascripts.
     */
    static $useJavascript     = true;

    /**
     * @var string asset path
     *
     * @see setAssetPath method
     */
    static $assetPath;

    static function text( $name, $attributes = array() )
    {
        return new Widget\TextInput( $name , $attributes );
    }

    static function checkbox( $name, $attributes = array() )
    {
        return new Widget\CheckboxInput( $name , $attributes );
    }

    static function select($name, $attributes = array() )
    {
        return new Widget\SelectInput( $name, $attributes );
    }

    /**
     * So that we can create widgets dynamically:
     *
     *      $select = FormKit::select( 'role', array( 'options' => ... ) );
     *      $canvas = FormKit::canvas( 'canvas', array( 'options' => ... ) );
     *      $label = FormKit::label( null , array( 'options' => ... ) );
     *
     */
    static function __callStatic($name,$arguments) {
        $class = 'FormKit\Widget\\' . ucfirst($name);
        if( class_exists($class,true) ) {
            return new $class($arguments[0],$arguments[1]);
        } 
        $class2 = $class . 'Input';
        if( class_exists($class2, true) ) {
            return new $class2(@$arguments[0],@$arguments[1]);
        }
        throw new InvalidArgumentException( "both $class or $class2 class not found." );
    }

    /**
     * Configure global asset path
     *
     * FormKit\Widget\BaseWidget::setAssetPath('/public/assets');
     *
     * @param string $path
     */
    static function setAssetPath($path) 
    {
        static::$assetPath = $path;
    }


    static function useStylesheet($bool = true) {
        static::$useStylesheet = $bool;
    }

    static function useJavascript($bool = true) {
        static::$useJavascript = $bool;
    }

}
