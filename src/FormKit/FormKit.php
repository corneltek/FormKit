<?php
namespace FormKit;

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
