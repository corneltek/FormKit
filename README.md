FormKit
========

With FormKit library, you can integrate form widgets with your own frameworks,

And of course, you can define your own form widgets for your applications easily.

Tired with HTML forms ? There are some widget layout engines that
can render widget into HTML with HTML table or fieldsets/legends. Of course you can
define your own layout engine too!


For example:

```php
<?php

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

License
-------

MIT License

