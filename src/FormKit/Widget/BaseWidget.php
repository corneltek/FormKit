<?php
namespace FormKit\Widget;
use FormKit\FormKit;
use FormKit\Element;
use Exception;
use InvalidArgumentException;



/**
 * BaseWidget defines the basic features of a widget,
 *
 *
 * Synopsis
 *
 *     // create a widget with 'name'
 *     $widget = new FooInput('name');
 *
 *     // create a widget with 'name' and attributes or options
 *     $widget = new FooInput('name',array( ...attributes ... ));
 *
 * Below is the widget construction flow:
 *
 * BaseWidget::__construct
 *  (parent) Element::__construct
 * BaseWidget::init
 *  (parent) Element::init
 *
 */
abstract class BaseWidget extends Element
{


    /**
     * @var string field name
     */
    public $name;


    public $useSerialId = false;


    /**
     * @var array Style sheet paths
     */
    protected $stylesheets = array();


    /**
     * @var array js files
     */
    protected $js = array();


    /**
     * Widget options, widgets may declare its option names
     * so that when setting attributes, these options won't be set into the 
     * attributes.
     */
    protected $options = array();


    protected $customAttributes = array('name');


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
    public function __construct()
    {
        $args = func_get_args();

        //  new FooInput('name',array( ...attributes ... ));
        if( 2 === count($args) ) {
            $this->name = $args[0];
            if( $args[1] && is_array($args[1]) ) {
                $this->setAttributes($args[1]);
            }
        }
        elseif( 1 === count($args) ) {
            $arg = $args[0];
            if ( is_string($arg) ) {
                $this->name = $arg;
            } elseif ( is_array($arg) ) {
                $this->setAttributes( $arg );
            } else {
                throw new InvalidArgumentException('Unsupported argument type');
            }
        }
        parent::__construct(); // create element
    }

    protected function init()
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

        if( $this->useSerialId ) {
            $this->setId( $this->getSerialId() );
        }
        parent::init();
    }


    /**
     * Set attributes
     *
     */
    public function setAttributes($as)
    {
        // filter out options
        $intersects = array_intersect(array_keys($as),array_keys($this->options));
        foreach( $intersects as $k ) {
            unset($as[$k]);
        }
        parent::setAttributes($as);
    }

    public function getStylesheets()
    {
        $path = FormKit::$assetPath;
        return array_map(function($file) use($path) { 
                return $path ? $path . '/' . $file : $file;
            }, (array) $this->stylesheets );
    }

    public function addStylesheet($css) {
        $this->stylesheets[] = $css;
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

    public function getSerialId()
    {
        if( function_exists('uniqid') )
            return $this->name . '-' . uniqid( $this->name );
        return $this->name . '-' . microtime(true);
    }

    public function getName()
    {
        return $this->name;
    }

}

