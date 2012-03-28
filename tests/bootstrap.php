<?php
define('LIBROOT', dirname(__DIR__) );
require LIBROOT . '/tests/helpers.php';
require LIBROOT . '/vendor/pear/Universal/ClassLoader/BasePathClassLoader.php';
$loader = new \Universal\ClassLoader\BasePathClassLoader( array(
    LIBROOT . '/src',
    LIBROOT . '/vendor/pear'
));
$loader->register();
