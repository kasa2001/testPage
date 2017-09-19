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

    public static function getMail($data)
    {
        return Mail::getInstance($data);
    }

    public static function getPagination($data)
    {
        return Pagination::getInstance($data);
    }

    public static function getSEO($data)
    {
        return SEO::getInstance($data);
    }

    public static function getDate($data = null)
    {
        return new Date($data);
    }
}