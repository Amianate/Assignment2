<?php

namespace framework;

abstract class abstractSession{
    
    function sessionStart() : void {

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    function sessionEnd() : void {
        session_unset();
        session_abort();
    }
}