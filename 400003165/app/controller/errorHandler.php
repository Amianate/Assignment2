<?php

namespace app\controller;
use framework\abstractErrorHandler;
use app\controller\sessionController;

class errorHandler extends abstractErrorHandler{
    
    public static function handleException(\Exception $e) {
        // Log the exception
        echo "Error: " . $e->getMessage(); 

        // Set an appropriate HTTP response code
        http_response_code(500);
    }

    public static function loginException(\Exception $e){
        sessionController::sessionStart();
        sessionController::sessionStore("error", $e->getMessage());
    }

    public static function registrationException($field, $e){
        sessionController::sessionStart();
        sessionController::sessionMultiStore("errors", $field, $e->getMessage());
    }

    public static function handle404(){

    }
}
