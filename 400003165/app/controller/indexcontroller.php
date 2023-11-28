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
    $page = file_get_contents(__DIR__ . "../../tpl/login.html");
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
    $page = file_get_contents(__DIR__ . "../../tpl/login.html");
    $response->setStatusCode(200);
    $response->addHeader("content-type", "text/html");
    $response->setBody($page);
}
else{ // Reload the login page if user is not logged in / Login is unsuccessful

    // Generate header
    $header = file_get_contents(__DIR__ . "/../../tpl/loginHead.html");
    $footer = file_get_contents(__DIR__ . "/../../tpl/loginFoot.html");
    
    // Generate form
    $form = "";
    $form .= formGenerator::openForm("{{action}}");
    
    $form .= formGenerator::openTag("div", ["class" => "regisForm"]); // Opening div

    $form .= formGenerator::openTag("h1", ["class" => "title"]); // Opening h1
    $form .= "User Login";
    $form .= formGenerator::closeTag("h1"); // closing h1

    $form .= formGenerator::openTag("p", ["class" => "errMessages", "id" => "topErr"]); // Opening p
    $form .= "{{error}}";
    $form .= formGenerator::closeTag("p"); // closing p

    $form .= formGenerator::generateTag("label", "Email:", ["for" => "emailField", "class" => "labels"]); // Email label
    $form .= formGenerator::generateTag("input", "", [ "name" => "emailField","class" => "inputs"]);  // Email input

    $form .= formGenerator::generateTag("label", "Password:", ["for" => "pwField", "class" => "labels"]); // Password label
    $form .= formGenerator::generateTag("input", "", ["class" => "inputs", "name" => "pwField", "type" => "password", "id" => "pw"]);  // Password input

    // $form .= formGenerator::generateInput("emailField", "Email", "text", ["class => labels"], ["class" => "inputs"]); // Email field
    // $form .= formGenerator::generateInput("pwField", "Password", "password", ); // Password field

    $form .= formGenerator::generateTag("input", "", [ "type" => "submit","value" => "Login", "id" => "loginButton"]);  // Login button


    $form .= formGenerator::openTag("div", []); // Opening div
    $form .= formGenerator::closeTag("div"); // closing div
    $form .= formGenerator::openTag("div", []); // Opening div
    $form .= formGenerator::closeTag("div"); // closing div

    $form .= formGenerator::openTag("p", ["id" => "regisLink"]); // Opening p
    $form .= formGenerator::openTag("a", ["href" => "nothing.php"]); // Opening a
    $form .= "Register";
    $form .= formGenerator::closeTag("a"); // closing a
    $form .= formGenerator::closeTag("p"); // closing p
    $form .= "<br>";

    $form .= formGenerator::closeTag("div"); // closing div
    $form .= formGenerator::closeForm();


    // Generate body
    $body = "";
    $body = formGenerator::openTag("body"); // closing body
    $body .= formGenerator::openTag("div", ["id" => "box"]); // Opening div
    $body .= $form;                            // Adding the from to the body
    $body .= formGenerator::closeTag("div"); // closing div
    $body .= formGenerator::closeTag("body"); // closing body

    $page = $header . $body . $footer;

    $engine = new templateEngine($page);

    // Preparing the response object if the user is not signed  in    
    $response = new Response();
    $response->setStatusCode(200);
    $response->addHeader("content-type", "text/html");


    // Putting the error on the page if in session variables, and an empty space if not
    $error = $sess->getSessionValue('error');

    if( null != ($error ) ){
        $data = [
            'css' => '/Assignment2/400003165/css/style.css',
            'action' => '/Assignment2/400003165/app/controller/loginController.php',
            'error' => $error
        ];
    }
    else{
        $data = [
            'css' => '/Assignment2/400003165/css/style.css',
            'action' => '/Assignment2/400003165/app/controller/loginController.php',
            'error' => ''
        ];
    }
    $response->setBody($engine->render($data));   
}
        
// Use the template engine to print it out
$response->send();
