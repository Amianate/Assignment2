<?php

namespace framework;

use Exception;
use framework\ORM\orm;


class abstractAuthentication{
    //sessionController $session = new sessionController();

    function checkEmail(){
        // Check the email

        // If it fails the checks
        throw new \Exception("Email address not found.");
    }

    public function checkUserName(){
        // Check the username

        
        // If it fails the checks
        throw new \Exception("Username not found.");
    }

    public function checkPw(){
        // Check the password

        // If it fails the checks
        throw new \Exception("Incorrect password.");

    }

    public function getUserAccess(){
        // This interacts with the model to retrieve the user access level
        
    }


}