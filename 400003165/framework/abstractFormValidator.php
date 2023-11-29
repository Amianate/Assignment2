<?php

namespace framework;

abstract class abstractFormValidator {
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
        }
    }

    // **** VALIDATION FUNCTIONS **** //

    abstract public function validateRequired($fieldName, $value);

    abstract public function validateEmail($value);

}