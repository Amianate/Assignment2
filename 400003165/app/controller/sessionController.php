<?php

namespace app\controller;
use framework\abstractSession;


require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . '/../../config/autoloader.php';

class sessionController extends abstractSession{
    
    public static function  sessionStart() : void {

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    public static function sessionEnd() : void {
        session_unset();
        session_abort();
    }

    public static function getSessionValue($key) {
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

    public static function getSessionMultiValue($key1, $key2) {
        if(session_status() != PHP_SESSION_ACTIVE){
            throw new \Exception("The session is not active."); // To be changed to session exception later (maybe)
        }

        if(isset($_SESSION[$key1][$key2])){
            return $_SESSION[$key1][$key2];
        }
        else{
            return null;
        }
    }

    public static function sessionStore($key, $value){
        $_SESSION[$key] = $value; 
    }

    public static function sessionMultiStore($key1, $key2, $value){
        $_SESSION[$key1][$key2] = $value; 
    }

    public static function sessionDelete($key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }


}