<?php

namespace app\controller;
use framework\templateEngine;
use framework\FormGenerator;

require_once __DIR__ . "/../../autoloader.php";


$index = new \indexcontroller();
$response = $index->getResponse();

$data = [
    'name' => 'John',
    'age' => 25
];

$form = FormGenerator::openForm('/submit-form', 'post'); 
$form .= FormGenerator::generateInput("username", "Username", 'text',"", "Input username here");
$form .= "<br>";
$form .= FormGenerator::generateInput("pw", "Password", 'password',"", "");

$form .= FormGenerator::closeForm();

echo $form;

$engine = new templateEngine($response->send());
echo $engine->render($data); 

