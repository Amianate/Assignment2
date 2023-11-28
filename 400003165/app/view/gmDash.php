<?php

namespace app\view;

use app\controller\templateEngine;
use app\controller\Response;
use app\controller\sessionController;

require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';

sessionController::sessionStart();

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
