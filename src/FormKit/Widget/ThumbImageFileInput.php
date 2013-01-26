<?php
namespace FormKit\Widget;
use FormKit\Element;

/**
 *
 * $input = new ImageFileInput('image');
 * $input->image->align = 'right';
 * $input->image->src = '.....';
 * $input->imageCover->setAttributeValues(....);
 * $input->render();
 *
 */
class ThumbImageFileInput extends TextInput
{
    public $type = 'file';
    public $class = array('formkit-widget','formkit-widget-thumbimagefile');

    public $image;
    public $imageCover;
    public $inputWrapper;
    public $fileInput;
    public $prefix = '';


    /**
     * HTML structure
     *
     * <div class="formkit-image-wrapper">
     *    <div class="formkit-image-cover">
     *      <img src="...."/>
     *    </div>
     *    <input type="file"...>
     * </div>
     *
     */

    public function init() 
    {
        parent::init();

        $this->fileInput = new FileInput( $this->name, $this->attributes );

        $this->imageCover = new Element('div',array('class' => 'formkit-image-cover'));
        $this->imageCover->setAttributeValue('data-width', $this->dataWidth);
        $this->imageCover->setAttributeValue('data-height', $this->dataHeight);

        $this->inputWrapper = new Element('div', array('class' => 'formkit-image-wrapper'));

        // if with value, then generate img
        if ( $this->value ) {

            $this->image = new Element('img',array(
                'src' => $this->prefix . $this->value,
            ));
            $this->imageCover->append($this->image);
        }

        // TODO: c9, you can make exif button as a config, by EJ
        if ( true ) {
            $this->fileInput->setAttributeValue('data-exif', 'true');
        }
        $this->inputWrapper->append($this->imageCover);
        $this->inputWrapper->append($this->fileInput);
    }

    function render($attributes = array() ) 
    {
        return $this->inputWrapper->render();
        // parent::render($attributes);
    }
}
