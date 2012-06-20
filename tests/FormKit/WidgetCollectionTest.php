<?php

class WidgetCollectionTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $username = new FormKit\Widget\TextInput('username', array( 'label' => 'Username' ));
        $username->value( 'default' )
            ->maxlength(10)
            ->minlength(3)
            ->size(20);

        $password = new FormKit\Widget\PasswordInput('password', array( 'label' => 'Password' ));

        $remember = new FormKit\Widget\CheckboxInput('remember', array( 'label' => 'Remember me' ));
        $remember->value(12);
        $remember->check();

        $widgets = new FormKit\WidgetCollection;
        ok($widgets);

        $widgets->add($username);
        $widgets->add($password);
        $widgets->add($remember);

        // get __get method
        is( $username , $widgets->username );
        is( $password , $widgets->password );

        is( $username , $widgets->get('username') );
        ok( $widgets->render('username') );

        ok( is_array($widgets->getJavascripts()) );
        ok( is_array($widgets->getStylesheets()) );

        is(3,$widgets->size());


        $widgets->remove($username);
        is(2,$widgets->size());


        unset($widgets['password']);
        is(1,$widgets->size());

        
    }
}

