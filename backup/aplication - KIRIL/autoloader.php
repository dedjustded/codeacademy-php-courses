<?php

function my_autoloader( $class ) {
    require_once('./src/class_' . $class . '.php');
    // echo "load class : ".$class."\n";
}

spl_autoload_register( 'my_autoloader' );