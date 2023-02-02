<?php


class Session{



    public function __construct()
    {
        session_start();
    }

    public function setSession($key, $value){

        $_SESSION[$key] = $value;
        return $this;
    }
    public function closeSession(){
        session_unset();
        session_destroy();
    }
   


}