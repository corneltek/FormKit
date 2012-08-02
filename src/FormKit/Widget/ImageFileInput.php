<?php
namespace FormKit\Widget;

class ImageFileInput extends FileInput
{
    public $type = 'file';
    public $class = array('formkit-widget','formkit-widget-imagefile');

    function render() 
    {
        if( $this->value ) {
            $img = new \FormKit\Element('img',array( 
                'src' => 'new-google-chrome-logo.jpg'
            ));
            // var_dump( $img->render() );
        }
        return parent::render();
    }

}

