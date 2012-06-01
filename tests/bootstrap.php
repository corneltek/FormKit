<?php
define('LIBROOT', dirname(__DIR__) );
require 'PHPUnit/TestMore.php';
require LIBROOT . '/vendor/pear/Universal/ClassLoader/BasePathClassLoader.php';
$loader = new \Universal\ClassLoader\BasePathClassLoader( array(
    LIBROOT . '/src',
    LIBROOT . '/vendor/pear'
));
$loader->register();
