<?php
require '../tests/bootstrap.php';
?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"> </script>
</head>
<body>
<?php
$text = new FormKit\Widget\TextInput('username', array( 'label' => 'Username' ));
$text->value( 'default' )
    ->maxlength(10)
    ->minlength(3)
    ->size(20);

$password = new FormKit\Widget\PasswordInput('password', array( 'label' => 'Password' ));

$remember = new FormKit\Widget\CheckboxInput('remember', array( 'label' => 'Remember me' ));
$remember->value(12);
$remember->check();

$ajaxComplete = new FormKit\Widget\AjaxCompleteInput('names', array( 
    'label' => 'names',
    'source' => 'ajax_complete.php',
));

$file = new FormKit\Widget\FileInput('file', array( 'label' => _('File') ));

$role = new FormKit\Widget\SelectInput('role' , array( 
    'label' => 'Role',
    'options' => array(
        _('Admin')     => 'admin',
        _('User')      => 'user',
        _('Anonymous') => 'anonymous',
    )
));

$countries = new FormKit\Widget\SelectInput( 'country' , array(
    'label' => 'Country',
    'options' => array(
        'Test' => 'Test',
        'Asia' => array( 
            'Taiwan',
            'Taipei',
            'Tainan',
            'Tokyo',
            'Korea',
        )
    )
));

$radio = new FormKit\Widget\RadioInput('type' , array( 
    'label' => 'Size',
    'options' => array( "One", "Two" , "Three" )
));

$size = new FormKit\Widget\SelectInput('size' , array( 
    'label' => 'Size',
    'options' => array(
        "1" => "foo",
        "2" => "bar",
        "3" => "zxx",
        4 => 'zzz',
    )
));

$submit = new FormKit\Widget\Submit;

$layout = new FormKit\Layout\GenericLayout;
$layout->width(400);
$layout->addWidget( $text )
    ->addWidget( $password )
    ->addWidget( $remember )
    ->addWidget( $role )
    ->addWidget( $size )
    ->addWidget( $countries )
    ->cellpadding(6)
    ->cellspacing(6)
    ->border(0);

$layout->addWidget( $ajaxComplete );
$layout->addWidget( $radio );
$layout->addWidget( $file );
$layout->addWidget( $submit );

$form = new FormKit\Element\Form;
$form->method('post')->action('/');
$form->addChild( $layout );

// $form->addChild( $submit );

echo $form;

#  echo $text;
#  echo $password;
#  echo $remember;
#  $layout->renderRow( 'username' );
#  $layout->renderRow( 'password' );
?>
</body>
</html>
