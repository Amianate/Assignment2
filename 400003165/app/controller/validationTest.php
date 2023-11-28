<?php


namespace app\controller;
use framework\formValidator;

require_once "./autoloader.php";

$validator = new formValidator();
$sess = new sessionController();

$sess->sessionStart();
// Storing information in the session variables

// Storing the password variable in the session array
if( isset($_REQUEST['username']) ){
    $sess->sessionStore('name', $_REQUEST['username']);
}
else{
    echo "The name variable is not set";
}


// Storing the password variable in the session array
if( isset($_REQUEST['pw']) ){
    $sess->sessionStore('pw', $_REQUEST['pw']);
}
else{
    echo "The password variable is not set";
}


// Arrays of data to be validated and rules to validate
$dataToValidate = [
    'username' => $_SESSION['name'],
    'pw' => $_SESSION['pw'],
];

$validationRules = [
    'username' => ['required'],
    'pw' => ['required', 'min_length'],
];

$sess->sessionEnd();
$validator->validate($dataToValidate, $validationRules);