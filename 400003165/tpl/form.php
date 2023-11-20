<?php
use framework\formGenerator;

$form = formGenerator::openForm('validationTest.php', 'post'); 
$form .= formGenerator::generateInput("username", "Username", 'text',"", "Input username here");
$form .= "<br>";
$form .= formGenerator::generateInput("pw", "Password", 'password',"", "");
$form .= formGenerator::generateInput("submit", "", "submit", "SUBMIT");
$form .= formGenerator::closeForm();

echo $form;