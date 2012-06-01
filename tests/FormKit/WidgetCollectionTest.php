<?php

class WidgetCollectionTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $text = new FormKit\Widget\TextInput('username', array( 'label' => 'Username' ));
        $text->value( 'default' )
            ->maxlength(10)
            ->minlength(3)
            ->size(20);

        $password = new FormKit\Widget\PasswordInput('password', array( 'label' => 'Password' ));

        $remember = new FormKit\Widget\CheckboxInput('remember', array( 'label' => 'Remember me' ));
        $remember->value(12);
        $remember->check();

        $widgets = new FormKit\WidgetCollection;
        ok($widgets);

        $widgets->add($text);
        $widgets->add($password);
        $widgets->add($remember);

        is(3,$widgets->size());

        $widgets->remove($text);
        is(2,$widgets->size());

        $widgets->remove($password);
        is(1,$widgets->size());
        
    }
}

