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
class ThumbImageFileInput extends TextInput
{
    public $type = 'file';
    public $class = array('formkit-widget','formkit-widget-thumbimagefile');

    public $image;
    public $imageWrapper;
    public $prefix = '';

    function init() {
        parent::init();

        $this->imageWrapper = new Element('div',array('class' => 'formkit-image-cover'));
        $this->imageWrapper->setAttributeValue('data-width', $this->dataWidth);
        $this->imageWrapper->setAttributeValue('data-height', $this->dataHeight);

        $cutDiv = new Element('div',array('class' => 'cut formkit-dropzone') );
        $cutDiv->setAttributeValue('data-width', $this->dataWidth);
        $cutDiv->setAttributeValue('data-height', $this->dataHeight);

        // if with value, then generate img
        if ( $this->value ) {

            $this->image = new Element('img',array(
                'src' => $this->prefix . $this->value,
            ));

            $cutDiv->append($this->image);
        }

        $this->imageWrapper->append($cutDiv);
    }

    function render($attributes = array() ) 
    {
        return $this->imageWrapper->render() . parent::render($attributes);
    }
}
