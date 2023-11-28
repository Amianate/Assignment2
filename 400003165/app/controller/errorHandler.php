<?php

namespace app\controller;
use framework\abstractErrorHandler;

class errorHandler extends abstractErrorHandler{
    
    public static function handleException(\Exception $e) {
        // Log the exception
        echo "Error: " . $e->getMessage(); 

        // Set an appropriate HTTP response code
        http_response_code(500);
    }

    public static function loginException(\Exception $e){
        $sess = new sessionController();
        $sess->sessionStart();

        $sess->sessionStore("error", $e->getMessage());
    }

    public static function handle404(){

    }
}
