<?php

namespace framework;

abstract class abstractSession{
    
    public static function sessionStart() : void {

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    public static function sessionEnd() : void {
        session_unset();
        session_abort();
    }
}