<?php


class Controller extends config
{
    /**
     * @var $view View
     * */
    protected $view;

    /**
     * @var $server Server
     * */
    protected $server;

    /**
     * Method where add model and connect whit database if exists $_POST
     * @param $model - how model
     * @return Database. Return new model from view
     * */
    public function loadModel($model)
    {
        $this->loader->changeRegister('loadModel');
        $model .= "Table";
        require_once 'app/models/' . $model . '.php';
        $model = new $model();
        $this->loader->changeRegister('loadModule');
        return $model;
    }

    /**
     * Method return  not associative array
     * @param $array array
     * @return array
     * */
    public function indexedData($array)
    {
        $i = 0;
        $data = [];
        foreach ($array as $value) {
            $data[$i] = $value;
            $i++;
        }
        return $data;
    }

}