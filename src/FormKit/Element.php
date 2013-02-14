<?php
namespace FormKit;
use Exception;
use DOMDocument;
use DOMNode;
use DOMText;
use ArrayAccess;

class Element
    implements ArrayAccess
{
    // extracted from CascadingAttribute
    const  ATTR_ANY = 0;
    const  ATTR_ARRAY = 1;
    const  ATTR_STRING = 2;
    const  ATTR_INTEGER = 3;
    const  ATTR_FLOAT = 4;
    const  ATTR_CALLABLE = 5;
    const  ATTR_FLAG = 6;


    /**
     * @var bool should we allow users to set undefined 
     * attributes?
     */
    public $allowUndefinedAttribute = true;

    /**
     * @var array $supportedAttributes
     */
    protected $_supportedAttributes = array();

    protected $_attributes = array();

    /**
     * Register new attribute with type,
     * This creates accessors for objects.
     *
     * @param string $name  attribute name
     * @param integer $type  attribute type
     */
    public function setAttributeType( $name , $type ) 
    {
        $this->_supportedAttributes[ $name ] = $type;
    }


    /**
     * Remove attribute
     *
     * @param string $name
     */
    public function removeAttributeType($name)
    {
        unset( $this->_supportedAttributes[ $name ] );
    }


    /**
     * Get attribute value
     *
     * @param string $name
     * @return mixed value
     */
    public function __get($name)
    {
        if( isset( $this->_attributes[ $name ] ) )
            return $this->_attributes[ $name ];
    }

    /**
     * Set attribute value
     */
    public function __set($name,$value)
    {
        $this->_attributes[ $name ] = $value;
    }



    /**
     * Check property and set attribute value without type 
     * checking.
     *
     * This is for internal use.
     *
     * @param string $name
     * @param mixed $arg
     */
    public function setAttributeValue($name,$arg)
    {
        if( property_exists($this,$name) ) {
            $this->$name = $arg;
        } else {
            $this->_attributes[ $name ] = $arg;
        }
    }



    /**
     * Check if the attribute is registered 
     * if it's registered, the type registered will 
     * change the behavior of setting values.
     *
     *
     * @param string $name
     * @param array $args
     */
    public function setAttribute($name,$args)
    {
        if( isset($this->_supportedAttributes[ $name ]) ) 
        {
            $c = count($args);
            $t = $this->_supportedAttributes[ $name ];

            if( $t != self::ATTR_FLAG && $c == 0 ) {
                throw new Exception( 'Attribute value is required.' );
            }

            switch( $t ) 
            {
                case self::ATTR_ANY:
                    $this->setAttributeValue( $name, $args[0] );
                    break;

                case self::ATTR_ARRAY:
                    if( $c > 1 ) {
                        $this->setAttributeValue( $name,  $args );
                    }
                    elseif( is_array($args[0]) ) 
                    {
                        $this->setAttributeValue( $name , $args[0] );
                    } 
                    else
                    {
                        $this->setAttributeValue( $name , (array) $args[0] );
                    }
                    break;

                case self::ATTR_STRING:
                    if( is_string($args[0]) ) {
                        $this->setAttributeValue($name,$args[0]);
                    }
                    else {
                        throw new Exception("attribute value of $name is not a string.");
                    }
                    break;

                case self::ATTR_INTEGER:
                    if( is_integer($args[0])) {
                        $this->setAttributeValue( $name , $args[0] );
                    }
                    else {
                        throw new Exception("attribute value of $name is not a integer.");
                    }
                    break;

                case self::ATTR_CALLABLE:

                    /**
                     * handle for __invoke, array($obj,$name), 'function_name 
                     */
                    if( is_callable($args[0]) ) {
                        $this->setAttributeValue( $name, $args[0] );
                    } else {
                        throw new Exception("attribute value of $name is not callable type.");
                    }
                    break;

                case self::ATTR_FLAG:
                    $this->setAttributeValue($name,true);
                    break;

                default:
                    throw new Exception("Unsupported attribute type: $name");
            }
            return $this;
        }
        // save unknown attribute by default
        else if( $this->allowUndefinedAttribute ) 
        {
            $this->setAttributeValue( $name, $args[0] );
        }
        else {
            throw new Exception("Undefined attribute $name, Do you want to use allowUndefinedAttribute option?");
        }
    }


    public function __call($method,$args)
    {
        $this->setAttribute($method,$args);
        return $this;
    }



    /**
     * ==========================================
     * Magic methods for convinence.
     * ==========================================
     */


    public function offsetSet($name,$value)
    {
        $this->setAttribute( $name, array($value) );
    }
    
    public function offsetExists($name)
    {
        return isset($this->_attributes[ $name ]);
    }
    
    public function offsetGet($name)
    {
        if( ! isset( $this->_attributes[ $name ] ) ) {
            // detect type for setting up default value.
            $type = @$this->_supportedAttributes[ $name ];
            if( $type == self::ATTR_ARRAY ) {
                $this->_attributes[ $name ] = array();
            }
        }
        $val =& $this->_attributes[ $name ];
        return $val;
    }
    
    public function offsetUnset($name)
    {
        unset($this->_attributes[$name]);
    }



    // -------------------------- end of cascading attributes


    // =================================
    // Element methods and members
    // =================================


    /**
     * element tag name
     */
    public $tagName;

    /**
     * @var array class name
     */
    public $class = array();


    /**
     * @var Use close tag with empty children, when this option is on, 
     *      A tag with no children is rendered as "<foo> </foo>".
     */
    public $closeEmpty = false;

    /**
     * Children elements
     *
     * @var array
     */
    protected $children = array();


    /**
     * @var array id field
     */
    public $id;


    /**
     * @var array Standard attribute from element class member.
     */
    protected $_standardAttributes = array( 
        /* core attributes */
        'class','id' 
    );

    /**
     * @var array Custom attributes (append your attribute name to render class 
     *            member as attribute)
     */
    protected $_customAttributes = array();





    /**
     *
     * @param string $tagName Tag name
     */
    public function __construct($tagName = null, $attributes = array() )
    {
        if( $tagName )
            $this->tagName = $tagName;
        $this->setAttributeType( 'class', self::ATTR_ARRAY );
        $this->setAttributeType( 'id', self::ATTR_ARRAY );
        $this->setAttributes( $attributes );
        $this->init();
    }

    public function init() 
    {

    }


    /**
     * Add custom attribute name (will be rendered)
     *
     * @param string $attribute Attribute name
     */
    public function registerCustomAttribute($attribute)
    {
        $this->_customAttributes[] = $attribute;
        return $this;
    }


    /**
     * Add attribute to customAttribute list
     *
     * @param string|array $attributes
     *
     *    $this->addAttributes('id class for');
     */
    public function registerCustomAttributes($attributes) 
    {
        if( is_string($attributes) ) {
            $attributes = explode(' ',$attributes);
        }
        $this->_customAttributes = array_merge( $this->_customAttributes , (array) $attributes );
        return $this;
    }


    /**
     *
     * @param string $class class name
     */
    public function addClass($class)
    {
        if( is_array($class) ) {
            $this->class = array_merge( $this->class , $class );
        } else {
            $this->class[] = $class;
        }
        return $this;
    }

    /**
     * @param string $class
     * @return bool 
     */
    public function hasClass($class) 
    {
        return array_search($class,$this->class) !== false;
    }


    /**
     * @param string $class class name
     */
    public function removeClass($class)
    {
        $index = array_search( $class, $this->class );
        array_splice( $this->class, $index , 1 );
        return $this;
    }


    /**
     * Set element id
     *
     * @param string $id add identifier attribute
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function prepend($child)
    {
        array_splice($this->children,0,0,$child);
        return $this;
    }

    public function insertChild($child)
    {
        array_splice($this->children,0,0,$child);
        return $this;
    }

    public function append($child)
    {
        $this->children[] = $child;
        return $this;
    }

    public function addChild($child)
    {
        $this->children[] = $child;
        return $this;
    }



    /**
     * Check if this node contains children.
     *
     * @return bool
     */
    public function hasChildren()
    {
        return ! empty($this->children);
    }

    /**
     * Return children elements
     *
     * @return array FormKit\Element[]
     */
    public function getChildren()
    {
        return $this->children;
    }


    protected function _renderNodes($nodes)
    {
        $html = '';
        foreach( $nodes as $node ) {
            if( $node instanceof DOMText || $node instanceof DOMNode ) {
                // to use C14N(), the DOMNode must be belongs to an instance of DOMDocument.
                $dom = new DOMDocument;
                $dom->appendChild($node);
                $html .= $node->C14N();
            } elseif( is_string($node) ) {
                $html .= $node;
            } elseif( is_object($node) 
                && ( $node instanceof \FormKit\Element
                    || $node instanceof \FormKit\Layout\BaseLayout 
                    || method_exists($node,'render')
                ) )
            {
                $html .= $node->render();
            } else {
                throw new Exception('Unknown node type.');
            }
        }
        return $html;
    }

    public function renderChildren()
    {
        return $this->_renderNodes($this->children);
    }

    /**
     * Set attributes from array
     *
     * @param array $attributes
     */
    public function setAttributes($attributes = array())
    {
        foreach( $attributes as $k => $val ) {
            // this is for adding new classes
            if( is_string($val) && strpos($val ,'+=') !== false ) {
                $origValue = $this->getAttributeValue($k);
                if( is_string($origValue) ) {
                    $origValue .= ' ' . substr($val,2);
                } elseif ( is_array($origValue) ) {
                    $origValue[] = substr($val,2);
                } else {
                    throw new Exception('Unknown attribute value type');
                }
                $this->setAttributeValue($k,$origValue);
            } else {
                $this->setAttributeValue($k, $val);
            }
        }
    }

    /**
     * Render attributes string
     *
     * @return string Standard Attribute string
     */
    public function renderAttributes() 
    {
        return $this->_renderAttributes($this->_standardAttributes)
            . $this->_renderAttributes($this->_customAttributes)
            . $this->_renderAttributes(array_keys($this->_attributes));
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
                //
                // for dataUrl attributes, render these attributes like data-url
                // ( use dash separator)
                $html .= sprintf(' %s="%s"', 
                        strtolower(preg_replace('/[A-Z]/', '-$0', $key)),
                        htmlspecialchars( $val )
                );
            }
        }
        return $html;
    }


    /**
     * Render open tag
     *
     *
     * $form->open();
     *
     * $form->renderChildren();
     *
     * $form->close();
     */
    public function open( $attributes = array() ) {
        $this->setAttributes( $attributes );
        $html = '<' . $this->tagName
                    . $this->renderAttributes()
                    ;
        // should we close it ?
        if( $this->closeEmpty || $this->hasChildren() ) {
            $html .= '>';
        } else {
            $html .= '/>';
        }
        return $html;
    }


    /**
     * Render close tag
     */
    public function close() {
        $html = '';
        if( $this->closeEmpty || $this->hasChildren() ) {
            $html .= '</' . $this->tagName . '>';
        }
        return $html;
    }

    public function render( $attributes = array() ) 
    {
        if( ! $this->tagName ) {
            throw new Exception('tagName is not defined.');
        }

        $html = $this->open( $attributes );

        // render close tag
        if( $this->hasChildren() ) {
            $html .= $this->renderChildren();
        }

        $html .= $this->close();
        return $html;
    }

    public function __toString()
    {
        return $this->render();
    }
}

