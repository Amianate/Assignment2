<?php

namespace app\controller;

require_once __DIR__ . "/../../config/config.php";

class formValidator {
    private $errormsg;

    public function validate($data, $rules) { // Accepts an array of rules, and one of the data to be validated
        foreach ($rules as $fieldName => $fieldRules) { // Looks at each rule key value pair as field name and rules respectively

            $value = isset($data[$fieldName]) ? $data[$fieldName] : null; // Sets the value as the data for the fieldname in question, if it is set

            foreach ($fieldRules as $rule) {
                if ($this->validateRule($fieldName, $value, $rule) == false){
                    return $this->errormsg;
                };
            }
            return true;
        }
    }

    private function validateRule($fieldName, $value, $rule) {
        switch ($rule) { // Calls different functions based on the validation rule
            case 'required':
                return $this->validateRequired($fieldName, $value);
                break;
            case 'email':
                return $this->validateEmail($value);
                break;
            case 'min_length':
                return $this->validateMinLength($value);
                break;
            case 'upper':
                return $this->validateUpperCase($value);
                break;
            case 'digit':
                return $this->validateDigit($value);
        }
    }

    // **** VALIDATION FUNCTIONS **** //

    public function validateRequired($fieldName, $value) {
        if (empty($value)) {
            $this->errormsg = $fieldName . " is required.";
            return false;
        }
        else{
            return true;
        }
    }

    public function validateEmail($value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errormsg = "Invalid email format.";
            return false;
        }
        else{
            return true;
        }
        
    }

    public function validateMinLength($value){
        if( strlen($value) < MIN_LENGTH){
            $this->errormsg = "The password is not long enough.";
            return false;
        }
        else{
            return true;
        }
    }

    public function validateUpperCase($value){
        for($x = 0; $x < strlen($value); $x++){
            if( ctype_upper($value[$x]) ){
                return true;
            }
        } 

        $this->errormsg = "The password must contain at least one capital letter.";
        return false; // Returning false if no characters are uppercase
    }

    public function validateDigit($value){
        for($x = 0; $x < strlen($value); $x++){
            if( ctype_digit($value[$x]) ){
                return true;
            }
        } 
        $this->errormsg = "The password must contain at least one digit.";
        return false;
    }
}