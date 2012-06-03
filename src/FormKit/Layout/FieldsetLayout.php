<?php
namespace FormKit\Layout;
use FormKit\Element\Fieldset;

class FieldsetLayout extends BaseLayout
{
    public $fieldset;

    function __construct() {
        $this->fieldset = new Fieldset;
        parent::__construct();
    }

    function __toString() {
        return $this->fieldset->render();
    }
}




