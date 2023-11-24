<?php

class Security{
    public static function generateCsrfToken() {
        $token = bin2hex(random_bytes(32)); // Generate a random token
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function validateCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    
}