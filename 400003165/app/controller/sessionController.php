<?php

namespace app\controller;
use framework\abstractSession;


require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';

class sessionController extends abstractSession{
    
    function sessionStart() : void {

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    function sessionEnd() : void {
        session_unset();
        session_abort();
    }

    function getSessionValue($key) {
        if(session_status() != PHP_SESSION_ACTIVE){
            throw new \Exception("The session is not active."); // To be changed to session exception later (maybe)
        }

        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        else{
            return null;
        }
    }

    public function sessionStore($key, $value){
        $_SESSION[$key] = $value; 
    }


}