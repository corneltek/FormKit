<?php
namespace FormKit;
use CascadingAttribute;
use Exception;
use DOMDocument;
use DOMNode;
use DOMText;

class Element extends CascadingAttribute
{
    public $tagName;

    /**
     * @var array class name
     */
    public $class = array();

    public $closeEmpty = false;

    /**
     * Children elements
     */
    public $children = array();


    /**
     * @var array id field
     */
    public $id = array();

    public $standardAttributes = array( 
        /* core attributes */
        'class','id','style','title',

        /* language attributes */
        'dir', 'lang', 'xml:lang',

        /* keyboard attributes */
        'accesskey', 'tabindex',
    );

    public $customAttributes = array();



    public function __construct($tagName = null)
    {
        if( $tagName )
            $this->tagName = $tagName;

        $this->setAttributeType( 'class', self::ATTR_ARRAY );
        $this->setAttributeType( 'id', self::ATTR_ARRAY );
        $this->init();
    }

    public function init() {

    }

    public function addAttribute($attribute)
    {
        $this->customAttributes[] = $attribute;
        return $this;
    }


    /**
     * Add attribute to customAttribute list
     *
     * @param string|array $attributes
     *
     *    $this->addAttributes('id class for');
     */
    public function addAttributes($attributes) {
        if( is_string($attributes) ) {
            $attributes = explode(' ',$attributes);
        }
        $this->customAttributes = array_merge( $this->customAttributes , (array) $attributes );
        return $this;
    }


    public function addClass($class)
    {
        if( is_array($class) ) {
            foreach( $class as $c ) {
                $this->class[] = $c;
            }
        } else {
            $this->class[] = $class;
        }
        return $this;
    }

    public function hasClass($class) 
    {
        return array_search($class,$this->class) !== false;
    }

    public function removeClass($class)
    {
        $index = array_search( $class, $this->class );
        array_splice( $this->class, $index , 1 );
        return $this;
    }

    public function addId($id)
    {
        $this->id[] = $id;
        return $this;
    }

    public function insertChild($child)
    {
        array_splice($this->children,0,0,$child);
        return $this;
    }

    public function addChild($child)
    {
        $this->children[] = $child;
        return $this;
    }

    public function hasChildren()
    {
        return ! empty($this->children);
    }

    protected function renderChildren()
    {
        return join('',array_map(function($child) { 

            if( $child instanceof DOMText || $child instanceof DOMNode ) {
                // to use C14N(), the DOMNode must be belongs to an instance of DOMDocument.
                $dom = new DOMDocument;
                $dom->appendChild($child);
                return $child->C14N();
            } else {
                return $child->render();
            }
        }, $this->children ));
    }

    /**
     * Set attributes from array
     *
     * @param array $attributes
     */
    public function setAttributes($attributes = array())
    {
        foreach( $attributes as $k => $val ) {
            $this->setAttributeValue($k, $val);
        }
    }


    /**
     * Render standard attributes
     *
     * @return string Standard Attribute string
     */
    public function _renderStandardAttributes()
    {
        return $this->_renderAttributes($this->standardAttributes);
    }

    public function _renderCustomAttributes()
    {
        return $this->_renderAttributes($this->customAttributes);
    }


    public function renderAttributes() {
        return    $this->_renderStandardAttributes()
                . $this->_renderCustomAttributes();
    }

    /**
     * Render attributes
     *
     * @param array $keys
     * @return string 
     */
    protected function _renderAttributes($keys) 
    {
        $html = '';
        foreach( $keys as $key ) {
            if( $val = $this->$key ) {
                if( is_array($val) ) {

                    // check if array is a indexed array, check keys of array[0..cnt] 
                    //
                    // if it's an indexed array
                    // for attributes like "class", which the parameter can be array('class1','class2')
                    // this render the attribute as "class1 class2"
                    //
                    // if it's an associative array
                    // for attribute "style", which the parameter can be array( 'border' => '1px solid #ccc' )
                    // this render the attribute as "border: 1px solid #ccc;"
                    if( array_keys($val) === range(0, count($val)-1) ) {
                        $val = join(' ', $val);
                    } else {
                        $val0 = $val;
                        $val = '';
                        foreach( $val0 as $name => $data ) {
                            $val .= "$name:$data;";
                        }
                    }
                }
                elseif ( is_bool($val) ) {
                    $val = $key;
                }

                // for boolean values like readonly attribute, 
                // we render it as readonly="readonly".
                $html .= sprintf(' %s="%s"', 
                        strtolower(preg_replace('/[A-Z]/', '-$0', $key)),
                        htmlspecialchars( $val )
                );
            }
        }
        return $html;
    }

    public function render( $attributes = array() ) 
    {
        if( ! $this->tagName ) {
            throw new Exception('tagName is not defined.');
        }

        $this->setAttributes( $attributes );
        $html = '<' . $this->tagName
                    . $this->_renderStandardAttributes()
                    . $this->_renderCustomAttributes()
                ;

        if( $this->closeEmpty || $this->hasChildren() ) {
            $html .= '>';
            $html .= $this->renderChildren();

            // close tag
            $html .= '</' . $this->tagName . '>';
        } else {
            $html .= '/>';
        }
        return $html;
    }

    public function __toString()
    {
        return $this->render();
    }
}

