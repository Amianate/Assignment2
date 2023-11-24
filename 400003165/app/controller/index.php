<?php

namespace app\controller;

require_once __DIR__ . "/Router.php";
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/../../autoloader.php";

use app\controller\Router;
use framework\ErrorHandler;
use framework\templateEngine;
use framework\formGenerator;
use framework\ORM\orm;

$errorHandler = new ErrorHandler();
$router = new Router();


// Get the current URL 
$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($currentUrl);
// echo __DIR__ . "<br>";

// $router->route($currentUrl);

// $orm = new orm();


// $orm->startConnection();
// // $user = $orm->addUser("nate", "nathan@live.com", "0123countonme");


// $field = "role";
// $data = "Researcher";

// try{
//     $searchRes = $orm->searchDb($field, $data);
// }
// catch(\Exception $e){
//     $errorHandler->handleException($e);
// }

// if(count($searchRes) > 1){
//     foreach($searchRes as $row){
//         echo "name: " . $row["username"] . "<br> ID:" . $row["id"] . "<br> <br>";
//     }
// }

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

