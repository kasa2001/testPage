<?php

class Config
{
    protected $loader;
    protected $config;
    protected $session;
    private $path='app/config/config.ini';

    public function __construct()
    {
        $this->loader = autoloader::getInstance(null);
        $this->loader->changeRegister('loadModule');
        if (file_exists($this->path) and (filesize($this->path) !== 0)) {
            $this->config=parse_ini_file($this->path,true);
            if ($this->config['system']['session-start']==true and !isset($_SESSION))
                $this->session=new Session();
        }
    }
}
