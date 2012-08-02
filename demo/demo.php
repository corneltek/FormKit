<?php
define('LIBROOT', dirname(__DIR__) );
require LIBROOT . '/vendor/pear/Universal/ClassLoader/BasePathClassLoader.php';
$loader = new \Universal\ClassLoader\BasePathClassLoader( array(
    # '../../AssetKit/src',
    LIBROOT . '/src',
    LIBROOT . '/vendor/pear'
));
$loader->register();

?>
<!Doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"> </script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/black-tie/jquery-ui.css" type="text/css" />

    <link rel="stylesheet" href="css/default.css" type="text/css" />

    <?php
    {
        $assetConfig = new AssetKit\Config( '../.assetkit');
        $assetLoader = new AssetKit\AssetLoader( $assetConfig );
        $asset = $assetLoader->load('formkit');

        // initialize a cache (if you need one)
        // $cache = new CacheKit\ApcCache( array('namespace' => 'demo') );
        $writer   = new AssetKit\AssetWriter($assetConfig);
        $manifest = $writer
                ->name('formkit')
                // ->cache($cache)
                // ->production()          // generate for production code, (the alternative is `development`)
                ->write( array($asset) );
        $includer = new AssetKit\IncludeRender;
        $html = $includer->render( $manifest );

        # echo "<!--\n";
        # print_r( $manifest ); 
        # echo "-->\n";

        echo $html;
    }
    ?>
<?php 
/*
    <?php foreach( $layout->widgets->getJavascripts() as $url ) : ?>
        <script src="<?= $url ?>"> </script>
    <?php endforeach ?>

    <?php foreach( $layout->widgets->getStylesheets() as $url ) : ?>
        <link rel="stylesheet" href="<?= $url ?>" type="text/css"/>
    <?php endforeach ?>
 */
?>

    <!--
    $_POST = <? print_r($_POST) ?>
    $_FILES = <? print_r($_FILES) ?>
    -->
    <script>
    // initialize formkit js
    FormKit.install();
    $(document.body).ready(function() {
        FormKit.initialize(document.body);
    });
    </script>

</head>
<body>
<?php

/**
 * Initialize form widgets for demo
 */

$text = new FormKit\Widget\TextInput('username', array( 
    'label' => 'Username',
    'hint'  => 'Please enter 6 characters for your username',
));
$text->value( 'default' )
    ->maxlength(10)
    ->minlength(3)
    ->size(20);

$dateSelect = new FormKit\Widget\DateSelectInput('my_date', array( 'label' => _('My Date') ));

$textarea = new FormKit\Widget\TextareaInput('description', array( 'label' => _('Description') ));
$textarea->value( '說明文字' )
    ->cols(50)
    ->rows(5);

$password = new FormKit\Widget\PasswordInput('password', array( 'label' => 'Password' ));

$remember = new FormKit\Widget\CheckboxInput('remember', array( 'label' => 'Remember me' ));
$remember->value(12);
$remember->check();

$birthday = new FormKit\Widget\DateInput('birthday', array(
    'label' => 'Birthday',
    'format' => 'Y.n.j',
    'value' => new DateTime('now', new DateTimeZone('Asia/Taipei'))
));

$imageInput = new FormKit\Widget\ImageFileInput('image', array( 
    'label' => 'Image',
    'value' => 'new-google-chrome-logo.jpg',
));

$bestTime = new FormKit\Widget\DatetimeInput('best_time', array(
    'label' => 'Best Time',
    'format' => 'Y.n.j g:i:s a',
    'value' => new DateTime('now', new DateTimeZone('Asia/Taipei')),
));

$ajaxComplete = new FormKit\Widget\AjaxCompleteInput('names', array( 
    'label' => 'names',
    'source' => 'tests/ajax_complete.php',
));

$file = new FormKit\Widget\FileInput('file', array( 'label' => _('File'), 'style' => array( 'background-color' => '#ccc' ) ));

$canvas = new FormKit\Widget\CanvasInput('canvas', array(
    'id' => 'canvas',
    'label' => _('Canvas'),
    'width' => 385,
    'height' => 480,
    'background' => 'face.jpg',
    'value' => 'draw.png'
));

$role = new FormKit\Widget\SelectInput('role' , array( 
    'label' => 'Role',
    'options' => array(
        _('Admin')     => 'admin',
        _('User')      => 'user',
        _('Anonymous') => 'anonymous',
    )
));

/* selector with group options */
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

$color = new FormKit\Widget\ColorInput('color', array(
    'label' => _('Color')
));

$radio = new FormKit\Widget\RadioInput('type' , array( 
    'label' => 'Size',
    'value' => 'Two',
    'options' => array( 'One', 'Two' , 'Three' ),
));


$size = new FormKit\Widget\SelectInput( 'size' , array( 
    'label' => 'Size',
    'options' => array(
        '1' => 'foo',
        '2' => 'bar',
        '3' => 'zxx',

        // test integer index
        4 => 'zzz',
    )
));

$submit = new FormKit\Widget\SubmitInput;

$layout = new FormKit\Layout\GenericLayout;
$layout->width(400);
$layout->addWidget( $text )
    ->addWidget( $password )
    ->addWidget( $remember )
    ->addWidget( $birthday )
    ->addWidget( $bestTime )
    ->addWidget( $role )
    ->addWidget( $size )
    ->addWidget( $imageInput )
    ->addWidget( $countries )
    ->addWidget( $dateSelect )
    ->cellpadding(6)
    ->cellspacing(6)
    ->border(0);

$layout->addWidget( $color );
$layout->addWidget( $ajaxComplete );
$layout->addWidget( $radio );
$layout->addWidget( $file );
$layout->addWidget( $canvas );
$layout->addWidget( $textarea );
$layout->addWidget( $submit );




/*
echo $layout->renderWidget( 'size' );
echo $layout->widgets->render( 'size' );
*/

$form = new FormKit\Element\Form;
$form->method('post')->action('?');
$form->addChild( $layout );

// $form->addChild( $submit );

echo $form;

#  echo $text;
#  echo $password;
#  echo $remember;
#  $layout->renderRow( 'username' );
#  $layout->renderRow( 'password' );
?>


<h2>FieldsetLayout Demo</h2>
<?php
$layout = new FormKit\Layout\FieldsetLayout('Legend text');
$layout->addWidget($text);
$layout->addWidget($textarea);
$layout->addChild( $submit );
echo $layout->render();
?>
</body>
</html>
