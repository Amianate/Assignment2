<?php

namespace framework;

abstract class abstractSecurity{
    abstract public static function generateCsrfToken();

    abstract public static function validateCsrfToken($token);

    
}