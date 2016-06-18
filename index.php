<?php
//Autoload Function
function __autoload ($classname) {
    if (strpos($classname, 'Entity')) {
        require (__DIR__.'/common/models/entities/'.$classname.'.php');
    } elseif (strpos($classname, 'Controller')) {
        require (__DIR__ . '/common/controllers/frontend/' .$classname.'.php');
    } elseif (strpos($classname, 'Collection')) {
        require (__DIR__ . '/common/models/collections/' .$classname.'.php');
    } else {
        require (__DIR__.'/common/system/'.$classname.'.php');
    }
}

//Get controller parameter
$controller = (isset($_GET['c']))? $_GET['c'] : 'dashboard';
//Construct controller name
$controller = ucfirst($controller).'Controller';


//Get method name
$method = (isset($_GET['m']))? $_GET['m'] : 'index';

$inst = new $controller();

$inst->$method();


//Get controller instance
//Method


?>