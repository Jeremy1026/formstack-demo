<?php

require 'vendor/autoload.php';


spl_autoload_register(function ($class) {
	if (stripos($class, "controller")) {
	    include './controllers/' . $class . '.php';
	}
	else if (stripos($class, "model")) {
	    include './models/' . $class . '.php';
	}

});

if (isset($_GET['route']) && isset($_GET['action'])) {
	$controller = $_GET['route'];
	$action     = $_GET['action'];
} else {
	$controller = 'users';
	$action     = '';
}

require_once('views/base.php');