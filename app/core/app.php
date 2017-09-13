<?php


class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    private $loader;

    public function __construct()
    {
        $this->loader = AutoLoader::getInstance(null);
        $this->loader->changeRegister('loadController');
        $url = $this->parseUrl();
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        $this->controller = new $this->controller;
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->controller = "home";
                $this->method = "error404";
                $this->controller = new $this->controller;
            }
        }
        $this->loader->changeRegister('loadModule');
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
}