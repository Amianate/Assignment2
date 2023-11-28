<?php

namespace framework;

abstract class abstractErrorHandler {
    
    public static function handleException(\Exception $e) {
        // Log the exception
        echo "Error: " . $e->getMessage(); 

        // Set an appropriate HTTP response code
        http_response_code(500);
    }

    abstract public static function loginException(\Exception $e);

    abstract public static function handle404();
}
