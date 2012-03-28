FormKit
=======

## Requirement

Components:

* Widget
* Layout
* LayoutBuilder
* ActionFormBuilder

Widgets: classes for rendering form elements (input, select, chooser, password input, price input ... etc)

Layout: a layout builder can collect form widgets in a grid layout or something.

Builder: a builder can render layout with form widgets to a form table.
- a builder can render one widget one time (separate form widget rendering).
- others can inherit the form builder, to change the layout.

Should have a helper in Twig template engine, to help render form widgets directly.

An action can use form builder to build action form table.

## Layouts

- A general table layout
  - has 2 columns
  - the first column is widget label, or can be empty.
  - the second column is a widget
  - the last row is submit button.

<?php
    $layout = new GenericTableLayout;
                 // new Column( 'size' => 123 )
                 // new Column( 'size' )

    // this adds a new row and two columns (label and widget)
    // a widget without label, makes the first column empty.
    $layout->addWidget( $widget );  

        // this actually does
        $row = new Row;
        $row->addCell( new Label );
        $row->addCell( $widget );

    $layout->addRow( $row );
    $layout->addRow(array( 'label' , 'text' ));
    $layout->addRow(array( 'some text' )); // this implies colspan=2

    $layout->addRow(array( 'label' , $layoutB ));

    $builder = new LayoutBuilder;  // implements style rendering
    $html = $builder->build();
?>

## Synopsis 

<?php

    use FormKit\FormKit;

    $widget = FormKit::input( 'username' , array( 
        'size' => 12, 
        'value' => 'default'
    ));
    $widget->hint( 'widget hint' );


    $widget = FormKit::select( 'usertype', array( 
        'label' => 'User Type',
        'options' => array( 
                'a' => 'label A',
                'b' => 'label B',
        )));
    $widget->options( array( 
        'a' => 'label A',
        'b' => 'label B',
    ) );
    $widget->hint( 'widget hint' );
?>

