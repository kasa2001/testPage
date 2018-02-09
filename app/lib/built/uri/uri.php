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


    private $config;
    /**
     * Construct create URI object
     * @param $config array
     * */
    private function __construct($config)
    {
        $this->scheme = $_SERVER["REQUEST_SCHEME"] . "://";
        $this->host = $_SERVER["HTTP_HOST"];
        $this->requestURI = $_SERVER["REQUEST_URI"];
        $this->base = $this->scheme . $this->host;
        $this->address = $this->base . $this->requestURI;
        $this->config = $config;
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

    /**
     * Method prepare link to pagination
     * @return string
     */
    public function toPagination()
    {
        $data = explode("/", $this->requestURI);
        $how = count($data);
        for ($i = 0; $i < $how; $i++) {
            if (is_numeric($data[$i]) || $data[$i]=='all' || strlen($data[$i]) == 0) {
                unset($data[$i]);
            }
        }

        if ((isset($this->config["system"]["default-directory"]) && $how < 5)
            || (!isset($this->config["system"]["default-directory"]) && $how < 4)) {
            $router = Router::getInstance($this->config);
            $data = array_merge($data, explode('/', $router->checkRoute('home/index')));
        }

        return implode("/", $data) . "/";
    }

    public function getCurrentPage()
    {
        $data = explode("/", $this->requestURI);
        if (is_numeric($data[(count($data)-1)])) {
            return $data[(count($data)-1)];
        } else {
            return 0;
        }
    }
}
