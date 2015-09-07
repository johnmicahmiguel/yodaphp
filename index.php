<?php
session_start();
date_default_timezone_set ("UTC");

require 'config.php';
//namespaces not loading on __autoload function. temporarily forced require password.php for bcrypt hashing
//needs research
require LIBS . 'password.php';
//require LIBS . 'OAuth2/src/OAuth2/Autoloader.php';
require LIBS . 'PayPalSDK/vendor/autoload.php';


// __autoload default function
function my_class($class_name) 
{
    $include_file = LIBS . $class_name . ".php";
    
    if(is_file($include_file)){
        require $include_file;
    }
    else{
    	$include_model = MODELS . $class_name . ".php";

    	if(is_file($include_model)){
    		require $include_model;
    	}
    	else{
    		header('Content-Type: application/json');
        	die(json_encode(array("Message" => "Class[{$include_file}] file not found!", "Status" => CLASS_FILE_NOTFOUND)));
    	}
    }
}


spl_autoload_register('my_class');


$app = new Bootstrap();