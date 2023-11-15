<?php

abstract class sessionController{
    
    function sessionStart() : void {

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    function sessionEnd() : void {
    }

    function getSessionValue($key) {

    }

    abstract public function sessionStore($key, $value);


}