<?php

class Server
{
    use GetInstance;

    private function __construct()
    {

    }

    public function setError($code)
    {
        $_SERVER["REDIRECT_STATUS"] = $code;
    }

}