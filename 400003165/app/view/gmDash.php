<?php

namespace app\view;

use app\controller\templateEngine;
use app\controller\Response;
use app\controller\sessionController;
use app\controller\security;

require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';

sessionController::sessionStart();

if( security::validateCsrfToken($_SESSION['csrf_token']) == false ){
    // Redirect to the login page
    $response = new Response();
    $response->redirect("../view/login.php", 301);
    exit();
};


$role = sessionController::getSessionValue("role");
if(sessionController::getSessionValue("role") != "Research Group Manager"){
    switch ($role) {
        case 'Researcher':
            $response = new Response();
            $response->redirect("../view/resDash.php", 301);
            exit();

            break;
        case 'Research Study Manager':
            $response = new Response();
            $response->redirect("../view/gmDash.php", 301);
            exit();

            break;     
    }
}

security::validateCsrfToken($_SESSION['csrf_token']);

$page = file_get_contents(__DIR__ . "/../../tpl/gmDashboard.html");

$engine = new templateEngine($page);

// Preparing the response object   
$response = new Response();
$response->setStatusCode(200);
$response->addHeader("content-type", "text/html");


$data = [
    'css' => '/Assignment2/400003165/css/style.css',
    'logo' => 'circle.jpg',
    'logout' => '/Assignment2/400003165/app/controller/logout.php',
    'name' => sessionController::getSessionValue('username'),
    'email' => sessionController::getSessionValue('email')
];

// Use the template engine to print it out
$response->setBody($engine->render($data));

$response->send();
