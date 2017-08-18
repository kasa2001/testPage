<?php

class Server
{
    private static $object;

    use GetInstance;

    private function __construct()
    {

    }

    public function setCode($code)
    {
        $_SERVER["REDIRECT_STATUS"] = $code;
    }

    public function getHttpRequest(){
        return $_SERVER['HTTP_X_REQUESTED_WITH'];
    }



}