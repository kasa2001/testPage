<?php

namespace Core;

class AutoLoader
{
    use \GetInstance;
    private static $object;

    private function __construct($method)
    {
        spl_autoload_extensions(".php");
        spl_autoload_register(array($this, $method));
    }

    public function loadPSR0($class)
    {
        $class = "app/" . str_replace("\\", "/", $class);
        spl_autoload($class);
    }
}