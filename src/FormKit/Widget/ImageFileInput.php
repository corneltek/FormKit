<?php
namespace FormKit\Widget;
use FormKit\Element;


/**
 *
 * $input = new ImageFileInput('image');
 * $input->image->align = 'right';
 * $input->image->src = '.....';
 * $input->imageWrapper->setAttributeValues(....);
 * $input->render();
 *
 */

class ImageFileInput extends FileInput
{
    public $type = 'file';
    public $class = array('formkit-widget','formkit-widget-imagefile');
    public $image;
    public $imageWrapper;

    function init() {
        parent::init();
        if( $this->value ) {
            $this->imageWrapper = new Element('div',array('class' => 'formkit-image-cover'));
            $this->image = new Element('img',array(
                'src' => $this->value,
            ));
            $cutDiv = new Element('div',array('class' => 'cut') );
            $cutDiv->append($this->image);
            $this->imageWrapper->append($cutDiv);
        }
    }

    function render($attributes = array() ) 
    {
        if( $this->image ) {
            return $this->imageWrapper->render() . parent::render($attributes);
        }
        return parent::render($attributes);
    }

}

