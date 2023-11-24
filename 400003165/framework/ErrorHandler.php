<?php

namespace framework;

class ErrorHandler {
    public static function handleException(\Exception $e) {
        // Log the exception
        echo "Error: " . $e->getMessage(); 

        // Set an appropriate HTTP response code
        http_response_code(500);
    }

    public static function handle404() {

    }
}
