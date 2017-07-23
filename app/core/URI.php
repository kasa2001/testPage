<?php

class URI
{
    use GetInstance;

    private static $object;
    private $scheme;
    private $host;
    private $base;
    private $requestURI;
    private $address;

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
}