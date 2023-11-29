<?php

namespace app\controller;

require_once "Router.php";
require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';

use app\controller\formValidator;
use app\controller\errorHandler;
use app\controller\Response;
use framework\user;
use framework\orm;
use app\controller\sessionController;
use Exception;

$validator = new formValidator();
$handler = new errorHandler();
$user;

// VALIDATION

try{ // Email check                                                                                                                                                                                                                                                                                                                                                                                                                                        
    if( $_REQUEST['emailField'] != ""){  

        $email = $_REQUEST['emailField'];

        $rules = [ 'email' => ['required', 'email'] ];
        $data = [ 'email' => $email ];

        $testResult = $validator->validate($data, $rules);

        if( is_string($testResult)){
            throw new \Exception($testResult);
            exit;
        }    
    }
    else{
        throw new \Exception("No email provided.");
    }
}
catch(\Exception $e){
    errorHandler::registrationException("email", $e);
    $response = new Response();
    $response->redirect("../view/registration.php", 301);
    exit();
}


try{ // Password check
    if( $_REQUEST['pwField'] != ""){  

        $pw = $_REQUEST['pwField'];

        $rules = [ 'password' => ['required', 'min_length', 'upper', 'digit'] ];
        $data = [ 'password' => $pw ];

        $testResult = $validator->validate($data, $rules);

        if( is_string($testResult)){
            throw new \Exception($testResult);
            exit;
        }    
    }
    else{
        throw new \Exception("No password provided.");
    }

    // Create new user object when the email and password are validated.
    $user = new user("", $_REQUEST['emailField'], $_REQUEST['pwField'], "");
    
}
catch(\Exception $e){    
    errorHandler::registrationException("password", $e);
    $response = new Response();
    $response->redirect("../view/registration.php", 301);
    exit();
}


try { // Username check (Checking the database to see if the name is unique)
    if( $_REQUEST['usernameField'] != ""){
        $connection = new orm();
        $connection->startConnection();

        $result = $connection->isInDb("username", $_REQUEST['usernameField']);

        if($result == true){
            throw new \Exception("Username is not unique.");
        }
    }
    else{
        throw new \Exception("No username provided.");
    }
} catch (\Exception $e) {
    errorHandler::registrationException("username", $e);
    $response = new Response();
    $response->redirect("../view/registration.php", 301);
    exit();
}


// Adding the user after successful registration checks
try {     
    $connection = new orm();
    $connection->startConnection();

    $connection->addUser($_REQUEST['usernameField'], $_REQUEST['emailField'], $_REQUEST['pwField'], $_REQUEST['roleField']);
    echo "user added successfully.";
    exit();
    
    $response = new Response();
    $page = file_get_contents(__DIR__ . "../../tpl/login.html");
    $response->setStatusCode(200);
    $response->addHeader("content-type", "text/html");
    $response->setBody($page);    
}
catch(\Exception $e){
    errorHandler::registrationException("entry", $e);
}
