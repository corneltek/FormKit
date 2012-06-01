<?php
$term = $_REQUEST['term'];
$classes = array_filter( get_declared_classes() , function($item) use ($term) { 
    return preg_match( "#$term#i" , $item );
});
echo json_encode( array_values($classes) );
