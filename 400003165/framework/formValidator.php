<?php

namespace framework;

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
        }
    }

    // **** VALIDATION FUNCTIONS **** //

    private function validateRequired($fieldName, $value) {
        if (empty($value)) {
            $this->errormsg = $fieldName . " is required.";
            echo "<br>  Errormsg:" . $this->errormsg;
            return false;
        }
        else{
            return true;
        }
    }

    private function validateEmail($value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errormsg = "Invalid email format.";
            echo "<br>  Errormsg:" . $this->errormsg;

            return false;
        }
        else{
            echo "Validate email successful <br>";
            return true;
        }
        
    }

    private function validateMinLength($value){
        if( strlen($value) < 8){
            $this->errormsg = "ERROR: The password is not long enough.";
            echo "<br> Errormsg:" . $this->errormsg;
            return false;
        }
        else{
            echo "Validate minlength successful <br>";
            return true;
        }
    }
}