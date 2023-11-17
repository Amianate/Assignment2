<?php


require_once __DIR__ . "/config.php";
require_once __DIR__ . "/../../autoloader.php";

use framework\Response;

class indexcontroller{

    private function authorizeUser(){
        // Bla bla bla 
        return true;
    }

    public function redirect(){
        header("location: " . ROOT . "/app/controller/load.php");
    }

    public function getResponse(){
        if($this->authorizeUser()){

            $response = new Response();
            $response->setStatusCode(200);
            $response->addHeader('Content-Type', 'text/html');
            $response->setBody("Hello, {{name}}! You are {{age}} years old.");

            return $response;
        }
    }
}
