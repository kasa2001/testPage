<?php

class API extends Controller
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
        $user = $this->loadModel("TestData");
        $this->view = View::getInstance($this->config);
        $this->view->getJSON("sendDelete", $user);
    }

    public function sendDelete()
    {
        $server = Server::getInstance($this->config);
        $server->checkIsJS();
        Security::slashSQLForm($_POST);
        Security::analyzeXSS($_POST);
        $user = $this->loadModel("TestData");
        $this->view = View::getInstance($this->config);
        $this->view->getJSON("sendDelete", $user);
    }

    public function sendModify()
    {
        $server = Server::getInstance($this->config);
        $server->checkIsJS();
        Security::slashSQLForm($_POST);
        Security::analyzeXSS($_POST);
        $user = $this->loadModel("TestData");
        $this->view = View::getInstance($this->config);
        $this->view->getJSON("sendDelete", $user);
    }

    public function sendSelect()
    {
        $server = Server::getInstance($this->config);
        $server->checkIsJS();
        $user = $this->loadModel("TestData");
        $this->view = View::getInstance($this->config);
        $this->view->getJSON("sendDelete", $user);
    }
}