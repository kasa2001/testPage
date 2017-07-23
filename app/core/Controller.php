<?php


class Controller extends Config
{
    /**
     * @var $view View
     * */
    protected $view;

    /**
     * @var $server Server
     * */
    protected static $server;

    /**
     * Method where add model and connect whit database if exists $_POST
     * @param $model - how model
     * @return Model. Return new model from view
     * */
    public function loadModel($model)
    {
        $model .= "Table";
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Method get data from file without loading all page
     * @param $file string
     * @param $model Model
     * */
    public function getJSON($file, $model)
    {
        require_once "../app/views/API/" . $file . ".php";
    }

    /**
     * Method redirect to another page. If $where is null redirect to preview page
     * @param $where string
     * */
    public function redirect($where = null)
    {
        if ($where == null)
            header("Location: " . $this->checkPreviewWebSite());
        else
            header("Location: " . "http://www.localhost/" . $this->config["system"]["default-directory"] . "/public/" . $where);
    }

    /**
     * Method redirecting if someone try go to file with JSON
     * */
    public function checkIsJS()
    {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            if (!isset($_SERVER['HTTP_REFERER']))
                $this->redirect("home/index");
            else
                $this->redirect();
        }
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

    /**
     * Method return data about preview page
     * @return string
     * */
    public function checkPreviewWebSite()
    {
        if (isset($_SERVER['HTTP_REFERER'])) return $_SERVER['HTTP_REFERER'];
        else return null;
    }
}