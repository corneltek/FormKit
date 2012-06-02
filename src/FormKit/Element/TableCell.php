<?php
namespace FormKit\Element;
use FormKit\Element;

class TableCell extends Element
{
    public $tagName = 'td';
    public $customAttributes = array('width','height','align','colspan','valign');
}

