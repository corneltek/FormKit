<?php

class ThumbImageFileInputTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $widget = new FormKit\Widget\ThumbImageFileInput('image',array( 
            'autoresize' => true,
            'autoresize_input' => true,
            'droppreview' => true,
            'dropupload' => true,
            'dataWidth' => 200,
            'dataHeight' => 200,
            'exif' => true,
        ));
        ok($widget);

        $html = $widget->render();
        echo $html;
        select_ok('.formkit-widget-thumbimagefile',1,$html);
        select_ok('.formkit-widget-thumbimagefile img',0,$html);
        select_ok('.formkit-widget-thumbimagefile input[type="file"]',1,$html);
        select_ok('.formkit-widget-thumbimagefile input[data-autoresize="true"]',1,$html);
        select_ok('.formkit-widget-thumbimagefile input[data-exif="true"]',1,$html);
        select_ok('.formkit-widget-thumbimagefile input[data-autoresize-input="true"]',1,$html);

        select_ok('.formkit-widget-thumbimagefile .formkit-label',1,$html);
        select_ok('.formkit-widget-thumbimagefile .autoresize-chk',1,$html);


    }
}

