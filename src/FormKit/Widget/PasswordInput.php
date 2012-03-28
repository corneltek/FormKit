<?php

namespace FormKit\Widget;

class PasswordInput extends TextInput
{
    public $class = array('formkit-password');

    public function init()
    {
        $this->type = 'password';
    }

}


