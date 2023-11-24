<?php

namespace framework\authorization;

use Exception;
use framework\ORM\orm;

require_once __DIR__ . "/../../autoloader.php";


class AuthController{
    //sessionController $session = new sessionController();

    function checkEmail($email){
        // Check the email

        // If it fails the checks
        throw new \Exception("Email address not found.");
    }

    public function checkUserName(){
        // Check the username

        
        // If it fails the checks
        throw new \Exception("Username not found.");
    }

    public function checkPw($pw){
        // Check the password

        // If it fails the checks
        throw new \Exception("Incorrect password.");

    }

    public function getUserAccess(){
        // This interacts with the model to retrieve the user access level
        
    }

    public function loginUser(){
        //checking the input username/passwords against those in the database
        try{
            $this->checkEmail($_REQUEST['email']);
            $this->checkPw($_REQUEST['pw']);

        }
        catch(\Exception $e){
            return $e->getMessage();
        }        
    }

    public function checkUserAccess($required){
        foreach($required as $accessLvl){
            if($_SESSION['request'] == $accessLvl){
                return true;
            }
        }
        return false;
    }

}