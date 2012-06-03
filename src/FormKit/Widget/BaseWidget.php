<?php
namespace FormKit\Widget;
use CascadingAttribute;
use FormKit\FormKit;

abstract class BaseWidget extends \FormKit\Element
{


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
     *
     *    valid attributes:
     *      - name
     *      - type
     *      - value
     *      - hint
     *      - tooltip
     *      - disabled
     *      - readonly
     *      - placeholder
     */
    public function __construct($name, $attributes = null )
    {
        $this->name = $name;
        if( $attributes ) {
            $this->setAttributes( $attributes );
        }
        parent::__construct();
        $this->init();
    }

    public function init()
    {
        $this->setAttributeType( 'name', self::ATTR_STRING );
        $this->setAttributeType( 'type', self::ATTR_STRING );
        $this->setAttributeType( 'value', self::ATTR_STRING );

        // virtual attribute (not for rendering widget elements )
        $this->setAttributeType( 'label'       , self::ATTR_STRING );
        $this->setAttributeType( 'hint'        , self::ATTR_STRING );
        $this->setAttributeType( 'tooltip'     , self::ATTR_STRING );
        $this->setAttributeType( 'disabled'    , self::ATTR_FLAG );
        $this->setAttributeType( 'readonly'    , self::ATTR_FLAG );
        $this->setAttributeType( 'placeholder' , self::ATTR_STRING );
    }

    public function getStylesheets()
    {
        $path = FormKit::$assetPath;
        return array_map(function($file) use($path) { 
                return $path ? $path . '/' . $file : $file;
            }, (array) $this->css );
    }

    public function addStylesheet($css) {
        $this->css[] = $css;
        return $this;
    }

    public function getJavascripts()
    {
        $path = FormKit::$assetPath;
        return array_map(function($file) use($path) { 
                return $path ? $path . '/' . $file : $file;
            }, (array) $this->js );
    }

    public function addJavascript($js) {
        $this->js[] = $js;
        return $this;
    }

    public function renderHint()
    {
        if( $this->hint )
            return '<div class="formkit-hint">' . $this->hint . '</div>';
    }

    public function getSerial()
    {
        if( function_exists('uniqid') )
            return $this->name . '-' . uniqid( $this->name );
        return $this->name . '-' . microtime(true);
    }

}

