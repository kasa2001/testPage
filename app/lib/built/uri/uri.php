<?php

namespace Lib\Built\URI;

use Core\Router;

class URI
{
    use \GetInstance;

    /**
     * @var $object static URI
     * */
    private static $object;

    /**
     * @var $scheme string
     * */
    private $scheme;

    /**
     * @var $host string
     * */
    private $host;

    /**
     * @var $base string
     * */
    private $base;

    /**
     * @var $requestURI string
     * */
    private $requestURI;

    /**
     * @var $address string
     * */
    private $address;

    /**
     * @var $get array
     */
    private $get;

    /**
     * @var $helpPath string
     */

    private $helpPath;

    private $controller;

    private $method;

    private $params = [];

    /**
     * Construct create URI object
     * */
    public function __construct()
    {
        $matches = $get = $helpPath = [];

        /**
         * Przetestować!!!
         * parse_url();
         * parse_str();
         *
         * */
        parse_str($_SERVER['QUERY_STRING'], $get);
        print_r(dirname($_SERVER['SCRIPT_NAME']));

        preg_match_all("/[^=|\/|?|&]*?[=|\/]([a-zA-Z]+)/A", $_SERVER['QUERY_STRING'], $matches);
        preg_match_all("/[^&]*?&([a-zA-Z]+)=([a-zA-Z0-9]+)/", $_SERVER['QUERY_STRING'], $get);
        preg_match_all("/\/([a-zA-Z]+)\//", $_SERVER['SCRIPT_NAME'], $helpPath);

        for ($i = 0; $i < count($get[1]); $i++) {
            $this->get[$get[1][$i]] = $get[2][$i];
        }

        $this->controller = isset($matches[1][0]) ? $matches[1][0] : 'home';
        $this->method = isset($matches[1][1]) ? $matches[1][1] : 'index';
        unset($matches[1][0], $matches[1][1]);

        $this->params = !empty($matches[1]) ? $matches[1] : [];

        $this->scheme = $_SERVER["REQUEST_SCHEME"] . "://";
        $this->host = $_SERVER["HTTP_HOST"];

        $this->helpPath = isset($helpPath[1]) ? '/' . implode('/', $helpPath[1]) : null;
        // REQUEST URI TODO
        $this->requestURI = $this->helpPath . '/' . $this->controller . '/' . $this->method;

        if (!empty($this->params)) {
            $this->requestURI .= '/' . implode('/', $this->params);
        }

        $this->base = $this->scheme . $this->host;
        $this->address = $this->base . $this->requestURI;

        self::$object = $this;
        unset($_GET);
        echo '<pre>';
        echo "Sparsowany URL</br>";
        echo "Linkowanie pod kontroller </br>";
        print_r($this);
        echo "SERVER</br>";
        print_r($_SERVER);
        echo '</pre>';
        //exit;
    }

    /**
     * Method return scheme
     * @return string
     * */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Method return address
     * @return string
     * */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Method return host
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Method return base address
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Method return request URI
     * @return string
     */
    public function getRequestURI()
    {
        return $this->requestURI;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function checkVars()
    {
        return !empty($this->get);
    }

    public function getVar($key)
    {
        return $this->get[$key];
    }


    /**
     * Method prepare link to pagination
     * @return string
     */
    public function toPagination()
    {
        $data = explode("/", $this->requestURI);
        $how = count($data);
        for ($i = 0; $i < $how; $i++) {
            if (is_numeric($data[$i]) || $data[$i] == 'all' || strlen($data[$i]) == 0) {
                unset($data[$i]);
            }
        }

        if ((isset($this->config["system"]["default-directory"]) && $how < 5)
            || (!isset($this->config["system"]["default-directory"]) && $how < 4)) {
            $router = Router::getInstance(null);
            $data = array_merge($data, explode('/', $router->checkRoute('home/index')));
        }

        return implode("/", $data) . "/";
    }

    public function getCurrentPage()
    {
        $data = explode("/", $this->requestURI);
        if (is_numeric($data[(count($data) - 1)])) {
            return $data[(count($data) - 1)];
        } else {
            return 0;
        }
    }
}
