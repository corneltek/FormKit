<?php
namespace FormKit\Widget;
use FormKit\Element;
use FormKit\Element\Div;

/**
 *
 * Supported options:
 *
 *  dropupload (boolean)
 *  droppreview (boolean)
 *  autoresize (boolean)
 *  autoresize_input
 *
 *
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
    public $image;
    public $imageCover;
    public $inputWrapper;
    public $fileInput;
    public $prefix = '';

    protected $_ignoredAttributes = array( 'value' => true );

    /**
     * @var boolean Option to enable auto resize checkbox
     *
     * $widget = new FormKit\ThumbImageFileInput('image',array( 'autoresize' => true ))
     */
    public $autoresize = false;


    public $autoresize_input = false;

    /**
     * @var boolean Option to disable/enable exif.
     */
    public $exif = false;

    /**
     * TODO:
     *
     * @var boolean Option to enable file drop to preview.
     */
    public $droppreview = true;


    /**
     * TODO:
     *
     * @var boolean Option to enable file drop to upload.
     */
    public $dropupload = true;

    /**
     * HTML structure
     *
     * <div class="formkit-widget formkit-widget-thumbimagefile formkit-image-wrapper">
     *    <div class="formkit-image-cover">
     *      <img src="...."/>
     *    </div>
     *    <input type="file"...>
     * </div>
     *
     */

    public function init($attributes) 
    {
        parent::init($attributes);
        $this->fileInput = new FileInput( $this->name, $attributes );

        $this->imageCover = new Div(array('class' => 'formkit-image-cover'));
        $this->imageCover->setAttributeValue('data-width', $this->dataWidth);
        $this->imageCover->setAttributeValue('data-height', $this->dataHeight);

        $this->inputWrapper = new Div;
        $this->inputWrapper
            ->addClass('formkit-widget-thumbimagefile')
            ->addClass('formkit-image-wrapper');

        // if it has a value, generate img
        if ( $this->value ) {
            $this->image = new Element('img',array(
                'src' => $this->prefix . $this->value,
            ));
            $this->imageCover->append($this->image);
        }

        if ($this->exif) {
            $this->fileInput->setAttributeValue('data-exif', 'true');
        }
        if ($this->autoresize) {
            $this->fileInput->setAttributeValue('data-autoresize','true');
        }
        if ( $this->droppreview ) {
            $this->fileInput->setAttributeValue('data-droppreview','true');
        }
        if ( $this->dropupload ) {
            $this->fileInput->setAttributeValue('data-dropupload','true');
        }


        $this->inputWrapper->append($this->imageCover);
        $this->inputWrapper->append($this->fileInput);

        if ($this->autoresize && $this->autoresize_input) {
            $this->fileInput->setAttributeValue('data-autoresize-input','true');
            $checkbox = new CheckboxInput($this->name . '_autoresize');
            $checkboxId = $checkbox->getSerialId();

            $label    = new Label(_("Auto-Resize"));
            $label->for($checkboxId);
            $resizeWrapper = new Div;
            $resizeWrapper->append( $checkbox );
            $resizeWrapper->append( $label );
            $resizeWrapper->addClass("autoresize-chk");
            $this->inputWrapper->append($resizeWrapper);
        }
    }

    public function render($attributes = array() ) 
    {
        return $this->inputWrapper->render();
        // parent::render($attributes);
    }
}
