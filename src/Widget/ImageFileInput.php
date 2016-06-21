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
class ImageFileInput extends TextInput
{
    public $js = array( 'js/jsimagefile/jsimagefile.js' );
    public $type = 'file';
    public $class = array('formkit-widget','formkit-widget-imagefile');

    /**
     * @var string prefix path for image source path.
     */
    public $prefix = '';

    public function init()
    {
        $this->dataUrl = $this->prefix . $this->value;
    }
}

