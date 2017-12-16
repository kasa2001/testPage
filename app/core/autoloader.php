<?php

namespace Core;

class AutoLoader
{
    use \GetInstance;
    private static $object;
    private $namespace = array();

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

    /**
     * Method add namespace to autoload
     *
     * @param $namespace string
     * @param $directory string
     * @throws AutoloaderException if namespace is registered
     *
     * @return void
     * */
    public function registerNamespace($namespace, $directory)
    {
        if (isset($this->namespace[$namespace])) {
            throw new AutoloaderException("Namespace is registered earlier");
        }

        $this->namespace[$namespace] = $directory;
    }

    /**
     * Method load classes by PSR-4 standard
     *
     * @param $class string
     * @throws AutoloaderException if namespace is not registered
     *
     * @return void
     * */
    public function loadPSR4($class)
    {

        $class = explode('\\', $class);
        if (!isset($this->namespace[$class[0]])) {
            throw new AutoloaderException("Namespace is not registered. Please register namespace");
        }
        $item = $class[0];
        unset($class[0]);

        spl_autoload($this->namespace[$item] . '/' . implode('/', $class));
    }
}