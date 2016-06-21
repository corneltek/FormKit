<?php
class GenericLayoutTest extends PHPUnit_Framework_TestCase
{
    public function testTextInput()
    {
        $text = new FormKit\Widget\TextInput('username', array( 'label' => 'Username' ));
        $text->value( 'default' )
            ->maxlength(10)
            ->minlength(3)
            ->size(20);

        ok( $text );
        is( 'default', $text->value );
        is( 10, $text->maxlength );
        is( 3, $text->minlength );

        $layout = new FormKit\Layout\GenericLayout;
        ok($layout);
        $layout->addWidget( $text );

        $html = $layout->render();
        ok($html);

        /*
        select_ok('input[name="username"]',1,$html);
        select_ok('.formkit-widget',true,$html);
        select_ok('.formkit-widget-text',true,$html);
        select_ok('.formkit-table',true,$html);
        */
    }
}

