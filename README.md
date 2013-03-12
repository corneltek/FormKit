FormKit
========

With FormKit library, you can integrate form widgets with your own frameworks,

And of course, you can define your own form widgets for your applications easily.

Tired with HTML forms ? There are some widget layout engines that
can render widget into HTML with HTML table or fieldsets/legends. Of course you can
define your own layout engine too!







For example, to use a text input widget:

```php
$text = new FormKit\Widget\TextInput('username', array( 
    'label' => 'Username',
    'placeholder' => 'Your name please',
    'hint'  => 'Please enter 6 characters for your username',
));
$text->value( 'default' )
    ->size(20);

echo $text; // render 
```

Which outputs:

```html
<input type="text" name="username" value="default" placeholder="Your name please" size="20"/>
<div class="formkit-hint">Please enter 6 characters for your username</div>
```

SelectInput:

```php
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
```


Element API
------------------

```php
use FormKit\Element;
$ul = new Element('ul');
$li = new Element('li');

$li->append( new Element('a') );
$li->appendText( "DOMText Node here" );

$li->addClass('item');
$li->setId('MyID');

$li->appendTo($ul);

echo $li->render();
```

Layout
------
To use generic layout:

```php
$layout = new FormKit\Layout\GenericLayout;
$layout->width(400);
$layout->addWidget( $text )
    ->addWidget( $password )
    ->addWidget( $remember )
    ->addWidget( $birthday )
    ->addWidget( $best_time )
    ->addWidget( $role )
    ->addWidget( $size )
    ->addWidget( $countries )
    ->cellpadding(6)
    ->cellspacing(6)
    ->border(0);
echo $layout;
```


Widget Factory
--------------

Form Widget Factory:

```php
use FormKit\FormKit;
$username = FormKit::text('username');
$password = FormKit::password('password',array( 
    'class' => 'your-element-class-name',
    'id' =>  'your-element-id',
    'value' => 'default password',
));

echo $username->render();
echo $password->render();
```


Open Tag & Close Tag
--------------------

```php
$form = new FormKit\Element\Form(array(
    'class' => 'blah blah'
));

// render elements manully
echo $form->open();
echo $form->renderChildren();
echo $form->close();

// which is equal to
echo $form->render();
```

Availabel Form Widgets
----------------------
* TextareaInput
* TextInput
* ButtonInput
* CheckboxInput
* ColorInput
* DateInput
* DatetimeInput
* FileInput
* HiddenInput
* Label
* PasswordInput
* RadioInput
* ResetInput
* SelectInput
* SubmitInput
* AjaxCompleteInput
* CanvasInput


Requirement
-----------

* AssetKit
* Onion

Installation
------------
In our system, we use `onion` installer tool to install dependencies:

    $ onion install

Or install through:

    $ pear install -f package.xml

Install assets for demo:

    $ assetkit install

License
-------

MIT License

