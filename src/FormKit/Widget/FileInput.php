<?php
namespace FormKit\Widget;

class FileInput extends TextInput
{
    public $type = 'file';
    public $class = array('formkit-widget','formkit-widget-file');

    // we need to ignore it, because browsers might change the value to 
    // something like 'C:\fakepath'
    public $_ignoredAttributes = array('value');
}

