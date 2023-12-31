<?php

namespace app\controller;

// require_once __DIR__ . "/Router.php";
require_once "../../config/config.php";
require_once "../../config/autoloader.php";

use app\controller\Router;
// use framework\ErrorHandler;
use framework\templateEngine;
use framework\formGenerator;
use framework\ORM\orm;

// $errorHandler = new ErrorHandler();
$router = new Router();

// Get the current URL 
$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($currentUrl);
// echo __DIR__ . "<br>";


// $index = new \indexcontroller();
// $response = $index->getResponse();

// $data = [
//     'name' => 'John',
//     'age' => 25
// ];

// $form = formGenerator::openForm('validationTest.php', 'post'); 
// $form .= formGenerator::generateInput("username", "Username", 'text',"", "Input username here");
// $form .= "<br>";
// $form .= formGenerator::generateInput("pw", "Password", 'password',"", "");
// $form .= formGenerator::generateInput("submit", "", "submit", "SUBMIT");
// $form .= formGenerator::closeForm();

// echo $form;

// $engine = new templateEngine($response->send());
// echo $engine->render($data); 

