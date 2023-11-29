<?php

namespace app\view;

use app\controller\templateEngine;
use app\controller\Response;
use app\controller\sessionController;
use app\controller\formGenerator;

require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';


    // Generate header
    $header = file_get_contents(__DIR__ . "/../../tpl/registrationHead.html");
    $footer = file_get_contents(__DIR__ . "/../../tpl/registrationFoot.html");
    
    // Generate form
    $form = "";
    $form .= formGenerator::openForm("{{action}}");
    
    $form .= formGenerator::openTag("div", ["class" => "regisForm"]); // Opening div

    $form .= formGenerator::openTag("h1", ["class" => "title"]); // Opening h1
    $form .= "User Registration";
    $form .= formGenerator::closeTag("h1"); // closing h1

    // Error message
    $form .= formGenerator::openTag("p", ["class" => "errMessages", "id" => "loginErr"]); // Opening p
    $form .= "{{entryErrors}}"; // entry error
    $form .= formGenerator::closeTag("p"); // closing p

    // Input and Label
    $form .= formGenerator::generateTag("label", "Username:", ["for" => "usernameField", "class" => "labels"]); // Username label
    $form .= formGenerator::generateTag("input", "", ["type" => "text", "id" => 'username', "name" => "usernameField","class" => "inputs", "required"]);  // Username input \

    // Error message
    $form .= formGenerator::openTag("p", ["class" => "errMessages", "id" => "nameErr"]); // Opening p
    $form .= "{{nameErrors}}"; // name error
    $form .= formGenerator::closeTag("p"); // closing p

    // Input and Label
    $form .= formGenerator::generateTag("label", "Email:", ["for" => "emailField", "class" => "labels"]); // Email label
    $form .= formGenerator::generateTag("input", "", ["type" => "text", "id" => 'email', "name" => "emailField", "class" => "inputs", "required"]);  // Email input

    // Error message
    $form .= formGenerator::openTag("p", ["class" => "errMessages", "id" => "emailErr"]); // Opening p
    $form .= "{{emailErrors}}"; // email error
    $form .= formGenerator::closeTag("p"); // closing p

    // Input and Label
    $form .= formGenerator::generateTag("label", "Password:", ["for" => "pwField", "class" => "labels"]); // Password label
    $form .= formGenerator::generateTag("input", "", ["class" => "inputs", "name" => "pwField", "type" => "password", "id" => "pw"], "required");  // Password input

    // Error message
    $form .= formGenerator::openTag("p", ["class" => "errMessages", "id" => "pwErr"]); // Opening p
    $form .= "{{pwErrors}}"; // email error
    $form .= formGenerator::closeTag("p"); // closing p

    // $form .= formGenerator::generateTag("label", "Role:", ["for" => "roleField", "class" => "labels"]); // Password label
    // Select box
    $form .= formGenerator::generateDropdown(
        "roleField", 
        "Role", 
        [
            "Researcher" => "Researcher", 
            "Research Group Manager" => "Research Group Manager", 
            "Research Study Manager" => "Research Study Manager"
        ], 
        "Researcher", 
        [
             "name" => "roleField"
        ]
    );

    // Register Button
    $form .= formGenerator::generateTag("input", "", [ "type" => "submit","value" => "Register", "id" => "regisButton"]);  // Login button


    $form .= formGenerator::openTag("div", []); // Opening div
    $form .= formGenerator::closeTag("div"); // closing div
    $form .= formGenerator::openTag("div", []); // Opening div
    $form .= formGenerator::closeTag("div"); // closing div

    // Link under form
    $form .= formGenerator::openTag("p", ["id" => "regisLink"]); // Opening p
    $form .= formGenerator::openTag("a", ["href" => "login.php"]); // Opening a
    $form .= "Log in";
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

    // Preparing the response object   
    $response = new Response();
    $response->setStatusCode(200);
    $response->addHeader("content-type", "text/html");


    // Putting the error on the page if in session variables, and an empty space if not
    $sess = new sessionController();
    $sess->sessionStart();

    $error = $sess->getSessionValue('errors');

    if( null != $error ){
        $entry = (null != sessionController::getSessionMultiValue("errors", "entry")) ? sessionController::getSessionMultiValue("errors", "entry") : '';
        $name = (null != sessionController::getSessionMultiValue("errors", "name")) ? sessionController::getSessionMultiValue("errors", "name") : '';
        $email = (null != sessionController::getSessionMultiValue("errors", "email")) ? sessionController::getSessionMultiValue("errors", "email") : '';
        $pw = (null != sessionController::getSessionMultiValue("errors", "password")) ? sessionController::getSessionMultiValue("errors", "password") : '';

        $name = sessionController::getSessionMultiValue("errors", "name");

        $data = [
            'css' => '/Assignment2/400003165/css/style.css',
            'action' => '/Assignment2/400003165/app/controller/registrationController.php',
            'entryErrors' => $entry,
            'nameErrors' => $name,
            'emailErrors' => $email,
            'pwErrors' => $pw
        ];
        $sess->sessionDelete("errors"); // Delete the error after it is displayed
    }
    else{
        $data = [
            'css' => '/Assignment2/400003165/css/style.css',
            'action' => '/Assignment2/400003165/app/controller/registrationController.php',
            'entryErrors' => '',
            'nameErrors' => '',
            'emailErrors' => '',
            'pwErrors' => ''
        ];
    }
    // Use the template engine to print it out
    $response->setBody($engine->render($data));   

$response->send();

