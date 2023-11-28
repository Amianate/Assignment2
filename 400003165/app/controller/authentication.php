<?php

namespace app\controller;

require_once "/Router.php";
require_once __DIR__ . "/config.php";
require_once "../../config/autoloader.php";

use app\controller\security;
use framework\ErrorHandler;
use framework\abstractAuthentication;
use framework\orm;

$handler = new ErrorHandler();

class authentication extends abstractAuthentication{

    private $user;
    private $sess;

    function __construct($newUser)
    {
        $this->user = $newUser;
    }
    
    
    function checkEmail(){
        // Check the email
        $orm = new orm();               
        $orm->startConnection();

        return $orm->isInDb("email", $this->user->getEmail());
        // If it fails the checks
        throw new \Exception("Incorrect username/password.");
    }



    public function checkUserName(){
        // Check the username
        $orm = new orm();               
        $orm->startConnection();

        return $orm->isInDb("username", $this->user->getUsername());
        
        // If it fails the checks
        throw new \Exception("Username not found.");
    }



    public function checkPw(){
        // Check the password
        $orm = new orm();               
        $orm->startConnection();

        $rows = $orm->SearchDb("email", $this->user->getEmail()); // Collect the rows from the db where the email is equal to that input

        if(sizeof($rows) >= 1 ){

            foreach($rows as $row){

                // Compare passwords and return the matching row. (Picks the first match if there are multiple that fit the criteria)
                if( password_verify($this->user->getPassword(), $row->getPassword()) ){
                    return $row;
                }
            }
        }
        
        // If the matching row is not present
        throw new \Exception("Incorrect username/password.");

    }



    public function getUserAccess(){
        // This interacts with the model to retrieve the user access level
        
    }



    public function loginUser(){
        $this->sess = new sessionController();
        $this->sess->sessionStart();

        //checking the input username/passwords against those in the database
        try{
            if($this->checkEmail()){
                $result = $this->checkPw(); // Returns an exception if false

                if($result){
                    // If the checks are successful, place the information into the session variables and generate the secirity token

                    $this->sess->sessionStore('id', $result->getId());
                    $this->sess->sessionStore('username', $result->getUSername());
                    $this->sess->sessionStore('email', $result->getEmail());
                    $this->sess->sessionStore('password', $result->getPassword());
                    $this->sess->sessionStore('role', $result->getRole());

                    security::generateCsrfToken();
                    return true;
                }
            }
            else{
                throw new \Exception("Invalid email/password.");
            }
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