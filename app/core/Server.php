<?php

class Server
{
    private static $object;

    use GetInstance;

    private function __construct()
    {

    }

    public function setError($code)
    {
        $_SERVER["REDIRECT_STATUS"] = $code;
    }

    public function httpRequest(){
        return $_SERVER['HTTP_X_REQUESTED_WITH'];
    }

}