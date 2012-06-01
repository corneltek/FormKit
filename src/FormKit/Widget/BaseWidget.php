<?php
namespace FormKit\Widget;
use CascadingAttribute;

abstract class BaseWidget extends \FormKit\Element
{
    static $assetPath;

    /**
     * @var string field name
     */
    public $name;



    /**
     * @var array css style sheets
     */
    public $css = array();


    /**
     * @var array js files
     */
    public $js = array();


    /**
     *
     * @param string $name
     * @param array $attributes
     */
    public function __construct($name, $attributes = null )
    {
        $this->name = $name;
        if( $attributes ) {
            $this->setAttributes( $attributes );
        }
        $this->init();
    }


    /**
     * Set attributes from array
     *
     * @param array $attributes
     */
    public function setAttributes($attributes = array())
    {
        foreach( $attributes as $k => $val ) {
            $this->_setAttribute($k,$val);
        }
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

    public function getStylesheets()
    {
        $path = static::$assetPath;
        $files = (array) $this->css;
        return array_map(function($file) use($path) {
            if( $path )
                return $path . '/' . $file;
            return $file;
        }, $files);
    }

    public function getJavascripts()
    {
        $path = static::$assetPath;
        $files = (array) $this->js;
        return array_map(function($file) use($path) {
            if( $path )
                return $path . '/' . $file;
            return $file;
        }, $files);
    }

    public function init()
    {
        $this->setAttributeType( 'class', self::ATTR_ARRAY );
        $this->setAttributeType( 'id', self::ATTR_ARRAY );
        $this->setAttributeType( 'name', self::ATTR_STRING );
        $this->setAttributeType( 'type', self::ATTR_STRING );
        $this->setAttributeType( 'value', self::ATTR_STRING );

        // virtual attribute (not for rendering widget elements )
        $this->setAttributeType( 'label', self::ATTR_STRING );
        $this->setAttributeType( 'hint', self::ATTR_STRING );
        $this->setAttributeType( 'tooltip', self::ATTR_STRING );
        $this->setAttributeType( 'disabled', self::ATTR_FLAG );
        $this->setAttributeType( 'readonly', self::ATTR_FLAG );
        $this->setAttributeType( 'placeholder', self::ATTR_STRING );
    }

    public function renderHint()
    {
        if( $this->hint )
            return '<div class="formkit-hint">' . $this->hint . '</div>';
    }

    public function getSerial()
    {
        if( function_exists('uniqid') )
            return uniqid( $this->name );
        return $this->name . '-' . microtime(true);
    }

}

