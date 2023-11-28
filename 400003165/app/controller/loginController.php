<?php

namespace app\controller;

require_once "Router.php";
require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';

use framework\formValidator;
use app\controller\errorHandler;
use app\controller\Response;
use framework\user;
use app\controller\sessionController;

$validator = new formValidator();
$handler = new errorHandler();
$user;

// VALIDATION
try{
    // email check
                                                                                                                                                                                                                                                                                                                                                                                                                                        
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


    // Password check 
    if( $_REQUEST['pwField'] == "" || $_REQUEST['pwField'] == null){  
        throw new \Exception("No password provided.");
    }        

    // Create new user object when the email and password are validated.
    $user = new user("", $_REQUEST['emailField'], $_REQUEST['pwField'], "");
    
}
catch(\Exception $e){
    errorHandler::loginException($e);  

    // Creating response object to return the error
    $response = new Response();

    $response->redirect("../view/login.php", 301);
    exit();
}

// AUTHENTICATION

$auth =  new authentication($user);

try {     
    $auth->loginUser();

    // Carrying the user to the dashboard after successful login
    sessionController::sessionStart();

    switch (sessionController::getSessionValue("role")) {
        case 'researcher':
            $response = new Response();
            $response->redirect("../view/resDash.php", 301);
            exit();

            break;
        case 'Research Group Manager': 
            $response = new Response();
            $response->redirect("../view/gmDash.php", 301);
            exit();

            break;
        case 'Research Study Manager':
            $response = new Response();
            $response->redirect("../view/gmDash.php", 301);
            exit();

            break;        
        default:
            # code...
            break;
    }
    $response = new Response();
    $page = file_get_contents(__DIR__ . "../../tpl/login.html");
    $response->setStatusCode(200);
    $response->addHeader("content-type", "text/html");
    $response->setBody($page);

} catch (\Exception $e) {    
    errorHandler::loginException($e);

    // Creating response object to return the error    
    $response = new Response();
    $response->redirect("../view/login.php", 301);
    exit();
}