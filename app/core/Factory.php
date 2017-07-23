<?php

class Factory
{
    public static function getInstance($class, $data)
    {
        return $class::getInstance($data);
    }
}