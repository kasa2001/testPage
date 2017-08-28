<?php

class Factory
{
    public static function getInstance($class, $data)
    {
        return $class::getInstance($data);
    }

    public static function getDatabase($driver = null, $host = null, $db = null, $user = null, $password = null)
    {
        return new Database($driver, $host, $db, $user, $password);
    }
}