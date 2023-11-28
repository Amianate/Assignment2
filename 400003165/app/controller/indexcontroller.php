<?php

namespace app\controller;

// use framework\ErrorHandler;
use app\controller\templateEngine;
// use controller\security;
use app\controller\Response;
use app\controller\sessionController;
use app\controller\formGenerator;

require_once "Router.php";
require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';


$sess = new sessionController();
$sess->sessionStart();


if(isset($_SESSION["username"])){ 
    // If the user is logged in
    $response = new Response();
    $response->setStatusCode(200);
    $response->addHeader("content-type", "text/html");
    $response->setBody($page);
    $role = $_SESSION['role'];

    switch ($role) {
        case 'Research Group Manager':
            
            break;
        case 'Research Study Manager':
            # code...
            break;        
        default:
            # code...
            break;
    }

}
else{ // Reload the login page if user is not logged in / Login is unsuccessful
    require_once __DIR__ . "/../../app/view/login.php";
}
