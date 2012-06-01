<?php
namespace FormKit;

/**
 * Form Widget Factory class
 */
class FormKit
{
    static $useCss    = true;
    static $useJs     = true;

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
     * @var string asset path
     *
     * @see setAssetPath method
     */
    static $assetPath;

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


}
