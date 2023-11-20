<?php

namespace app\controller;
use framework\templateEngine;
use framework\formGenerator;

require_once __DIR__ . "/../../autoloader.php";


// $index = new \indexcontroller();
// $response = $index->getResponse();

// $data = [
//     'name' => 'John',
//     'age' => 25
// ];

$form = formGenerator::openForm('validationTest.php', 'post'); 
$form .= formGenerator::generateInput("username", "Username", 'text',"", "Input username here");
$form .= "<br>";
$form .= formGenerator::generateInput("pw", "Password", 'password',"", "");
$form .= formGenerator::generateInput("submit", "", "submit", "SUBMIT");
$form .= formGenerator::closeForm();

echo $form;

// $engine = new templateEngine($response->send());
// echo $engine->render($data); 

