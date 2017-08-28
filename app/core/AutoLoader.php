<?php

class AutoLoader
{
    use \GetInstance;
    private static $object;
    private $_core;
    private $_lib;
    private $_models;
    private $_modules;
    private $_view;
    private $_controller;

    private function __construct($method)
    {
        $this->_core = "../app/core/";
        $this->_lib = "../app/core/";
        $this->_modules = "../app/modules/built-in";
        $this->_models = "../app/models/";
        $this->_view = "../app/view/";
        $this->_controller = "../app/controllers/";
        spl_autoload_register(array($this, $method));
    }

    public function changeRegister($method)
    {
        spl_autoload_register(array($this, $method));
    }

    public function loadLibrary($lib)
    {
        spl_autoload_extensions(".php");
        set_include_path($this->_lib);
        return $this->_loadClass($lib);
    }

    public function loadModule($module)
    {
        spl_autoload_extensions(".php");
        set_include_path($this->_modules);
        return $this->_loadClass($module);
    }

    public function loadModel($model)
    {
        spl_autoload_extensions(".php");
        set_include_path($this->_models);
        return $this->_loadClass($model);
    }

    public function loadCore($core)
    {
        spl_autoload_extensions(".php");
        set_include_path($this->_core);
        return $this->_loadClass($core);
    }

    public function loadController($controller)
    {
        spl_autoload_extensions(".php");
        set_include_path($this->_controller);
        return $this->_loadClass($controller);
    }

    public function loadView($view)
    {
        spl_autoload_extensions(".php");
        set_include_path($this->_modules);
        return $this->_loadClass($view);
    }

    private function _loadClass($class)
    {
        if (is_array($class)) {
            foreach ($class as $c) {
                if ($c) {
                    spl_autoload($c);
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