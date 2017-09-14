<?php

class AutoLoader
{
    use \GetInstance;
    private static $object;
    private $_core;
    private $_lib;
    private $_models;
    private $_modules;
    private $_custom;
    private $_controller;
    private $_exception;
    private $_current;

    private function __construct($method)
    {
        $this->_core = "app/core/";
        $this->_lib = "app/lib/";
        $this->_modules = "app/modules/built-in/";
        $this->_models = "app/models/";
        $this->_controller = "app/controllers/";
        $this->_custom = "app/modules/custom/";
        $this->_exception = "app/modules/built-in/exception";
        spl_autoload_extensions(".php");
        $this->_current = array($this, $method);
        spl_autoload_register($this->_current);
    }

    public function changeRegister($method)
    {
        spl_autoload_unregister($this->_current);
        $this->_current = array($this, $method);
        spl_autoload_register($this->_current);
    }

    public function loadLibrary($lib)
    {
        set_include_path($this->_lib);
        return $this->_loadClass($lib);
    }

    public function loadModule($module)
    {
        set_include_path($this->_modules);
        return $this->_loadClass($module);
    }

    public function loadModel($model)
    {
        set_include_path($this->_models);
        return $this->_loadClass($model);
    }

    public function loadException($exception)
    {
        set_include_path($this->_exception);
        return $this->_loadClass($exception);
    }

    public function loadCore($core)
    {
        set_include_path($this->_core);
        return $this->_loadClass($core);
    }

    public function loadController($controller)
    {
        set_include_path($this->_controller);
        return $this->_loadClass($controller);
    }

    public function loadCustom($custom)
    {
        set_include_path($this->_custom);
        return $this->_loadClass($custom);
    }

    private function _loadClass($class)
    {
        spl_autoload_extensions(".php");
        if (is_array($class)) {
            foreach ($class as $c) {
                if ($c) {
                    spl_autoload($c,".php");
                }
                return true;
            }
        } else {
            if ($class) {
                spl_autoload($class);
                return true;
            }
        }
        return false;
    }
}