<?php

namespace app\controller;

use framework\ErrorHandler;
use app\controller\templateEngine;
use app\controller\security;
use app\controller\Response;
use framework\sessionController;

require_once __DIR__ . "/Router.php";
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/../../autoloader.php";

$sess = new sessionController();
$sess->sessionStart();

if(isset($_SESSION["username"])){ 
    // If the user is logged in
    $response = new Response();
    $page = file_get_contents("../../tpl/login.html");
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

    $response = new Response();
    $page = file_get_contents("../../tpl/login.html");
    $response->setStatusCode(200);
    $response->addHeader("content-type", "text/html");
    $response->setBody($page);
}
else{
    // To be done if the user is not signed in
    $response = new Response();
    $page = file_get_contents("../../tpl/login.html");
    $response->setStatusCode(200);
    $response->addHeader("content-type", "text/html");
    $response->setBody($page);
    }



// Use the template engine to print it out

$response->send();
