FormKit
========

With FormKit library, you can integrate form widgets with your own frameworks,

And of course, you can define your own form widgets for your applications easily.

Found hard to render form widgets ? There are some widget layout engines that
can render widget into HTML with HTML table or fieldsets/legends. Of course you can
define your own layout engine too!


For example:

```php
<?php

    $text = new FormKit\Widget\TextInput('username', array( 
        'label' => 'Username',
        'hint'  => 'Please enter 6 characters for your username',
    ));
    $text->value( 'default' )
        ->maxlength(10)
        ->minlength(3)
        ->size(20);

    echo $text; // render 
```

License
-------

MIT License

