<?php

namespace framework;

class formValidator {

    private $errors = [];

    public function validate($data, $rules) { // Accepts an array of rules, and one of the data to be validated
        foreach ($rules as $fieldName => $fieldRules) { // Looks at each rule key value pair as field name and rules respectively

            $value = isset($data[$fieldName]) ? $data[$fieldName] : null; // Sets the value as the data for the fieldname in question, if it is set

            foreach ($fieldRules as $rule) {
                $this->validateRule($fieldName, $value, $rule);
            }
        }

        return empty($this->errors);
    }

    private function validateRule($fieldName, $value, $rule) {
        switch ($rule) { // Calls different functions based on the validation rule
            case 'required':
                $this->validateRequired($fieldName, $value);
                break;
            case 'email':
                $this->validateEmail($fieldName, $value);
                break;
            case 'min_length':
                $this->validateMinLength($value);
            // Add more validation rules as needed
            // Example: 'min_length', 'max_length', 'numeric', etc.
        }
    }

    // **** VALIDATION FUNCTIONS **** //

    private function validateRequired($fieldName, $value) {
        if (empty($value)) {
            echo 'Field is required.';
            $this->addError($fieldName, 'Field is required.');
        }
        else{
            echo "Validate required successful <br>";
        }
    }

    private function validateEmail($fieldName, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format.';
            $this->addError($fieldName, 'Invalid email format.');
        }
        
    }

    private function validateMinLength($value){
        if( strlen($value) < 8){
            echo "ERROR: The password is not long enough.";
        }
        else{
            echo "Validate minlength successful <br>";
        }
    }

    private function addError($fieldName, $message) {
        $this->errors[$fieldName][] = $message;
    }

    public function getErrors() {
        return $this->errors;
    }
}