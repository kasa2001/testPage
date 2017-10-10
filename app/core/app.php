<?php

namespace Core;
use \Controllers, \Lib\Built\Server\Server;

class App
{
    protected $controller = '\Controllers\home';
    protected $method = 'index';
    protected $params = [];

    /**
     * @var $loader AutoLoader
     */
    private $loader;

    public function __construct()
    {
        $this->loader = AutoLoader::getInstance(null);
        $url = $this->parseUrl();
        if (file_exists('app/controllers/' . $url[0] . '.php')) {
            $this->controller = "\\Controllers\\" . $url[0];
            unset($url[0]);
        } else if ($url[0] != null) {
            $this->_error();
        }
        $this->controller = new $this->controller;
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->_error();
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Method where get url
     * */
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return NULL;
    }

    private function _error() {
        $config = new Config();
        $server = Server::getInstance($config->getConfig());
        $server->redirect(404);
        exit();
    }
}