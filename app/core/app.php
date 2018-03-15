<?php

namespace Core;

use \Lib\Built\Server\Server;

class App
{
    protected $controller = '\Controllers\Home';
    protected $method = 'index';
    protected $params = [];

    /**
     * @var Router
     * */
    protected $router;

    public function __construct()
    {
        $url = $this->parseUrl();

        $this->controller = ($url[0] ? $url[0] : $this->controller);
        $this->method = ($url[1] ? $url[1] : $this->method);
        $this->params = $url ? array_values($url) : [];
    }


    public function render()
    {
        $router = new \Lib\Built\Router\Router(
            $this->controller,
            $this->method,
            $this->params
        );

        $router->execute();
    }

    /**
     * Method where get url
     * */
    public function parseUrl()
    {
        $this->router = Router::getInstance(null);
        $url = $this->router->checkRoute(isset($_GET['url']) ? $_GET["url"] : '');
        return explode('/', $url);
    }
}
