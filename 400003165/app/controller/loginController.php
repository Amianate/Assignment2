<?php

namespace app\controller;

require_once "Router.php";
require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';

use framework\formValidator;
use framework\ErrorHandler;
use app\controller\user;

$validator = new formValidator();
$handler = new ErrorHandler();
$user;

// VALIDATION
try{
    // email check
    if( isset($_REQUEST['emailField'] )){  

        $email = $_REQUEST['emailField'];

        $rules = [ 'email' => ['required', 'email'] ];
        $data = [ 'email' => $email ];

        $testResult = $validator->validate($data, $rules);
        echo "Test result: ". $testResult;

        if( isset($testresult) && $testResult != true){
            throw new \Exception($testResult);
        }    
    }
    else{
        throw new \Exception("No email provided.");
    }

    // Password check ********MAY NOT BE NEEDED> RECHECK
    if( isset($_REQUEST['pwField'] )){  

        $pw = $_REQUEST['pwField'];

        $rules = [ 'pw' => ['required'] ];
        $data = [ 'pw' => $pw ];

        $testResult = $validator->validate($data, $rules);
        
        if( isset($testresult) && $testResult != true ){
            throw new \Exception($testResult);
        }
    
    }
    else{
        throw new \Exception("No password provided.");
    }

    // Create new user object when the email and password are validated.
    $user = new user("", $_REQUEST['emailField'], $_REQUEST['pwField'], "");
    
    $validationFlag = true;
}
catch(\Exception $e){
    $handler->handleException($e);
}

// AUTHENTICATION

$auth =  new authentication($user);

try {     
    $auth->loginUser();

} catch (\Exception $e) {
    
    $handler->handleException($e);
}