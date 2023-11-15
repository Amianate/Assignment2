<?php

abstract class AuthController{
    //sessionController $session = new sessionController();

    function checkEmail(){

    }

    abstract public function checkUserName(); 

    abstract public function checkPw();

}