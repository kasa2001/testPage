<?php

class Factory
{
    public static function getInstance($class, $data)
    {
        return $class::getInstance($data);
    }

    public static function getDatabase($driver, $host, $db, $user, $password)
    {
        return new Database($driver, $host, $db, $user, $password);
    }
}