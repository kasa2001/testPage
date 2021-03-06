<?php

namespace Controllers;

use \Core;
use Lib\Built\Server\Server;
use Lib\Built\Security\Security;
use Lib\Built\View\View;

class API extends Core\Controller
{

    public function index()
    {

    }

    public function sendInsert()
    {
        $server = Server::getInstance($this->config);
        $server->checkIsJS();
        Security::slashSQLForm($_POST);
        Security::analyzeXSS($_POST);
        $user = $this->loadModel("Models\TestData");
        $this->view = View::getInstance($this->config);
        $this->view->getJSON("sendInsert", $user);
    }

    public function sendDelete()
    {
        $server = Server::getInstance($this->config);
        $server->checkIsJS();
        Security::slashSQLForm($_POST);
        Security::analyzeXSS($_POST);
        $user = $this->loadModel("Models\TestData");
        $this->view = View::getInstance($this->config);
        $this->view->getJSON("sendDelete", $user);
    }

    public function sendModify()
    {
        $server = Server::getInstance($this->config);
        $server->checkIsJS();
        Security::slashSQLForm($_POST);
        Security::analyzeXSS($_POST);
        $user = $this->loadModel("Models\TestData");
        $this->view = View::getInstance($this->config);
        $this->view->getJSON("sendModify", $user);
    }

    public function sendSelect()
    {
        $server = Server::getInstance($this->config);
        $server->checkIsJS();
        $user = $this->loadModel("Models\TestData");
        $this->view = View::getInstance($this->config);
        $this->view->getJSON("sendSelect", $user);
    }
}
