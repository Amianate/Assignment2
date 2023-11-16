<?php

require_once __DIR__ . "/../../autoloader.php";

use framework\Response;

class indexcontroller{

    private function authorizeUser(){
        // Bla bla bla 
        return true;
    }

    public function redirect(){
        header("location: /Assignment2/400003165/app/controller/load.php");
    }

    public function response(){
        if($this->authorizeUser()){

            $response = new Response();
            $response->setStatusCode(200);
            $response->addHeader('Content-Type', 'text/html');
            $response->setBody("Hello, {{name}}! You are {{age}} years old.");

            return $response;
        }
    }
}
