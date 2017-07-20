<?php

class API extends Controller
{

    public function index()
    {

    }

    public function sendInsert()
    {
        $this->checkIsJS();
        Security::slashSQLForm($_POST);
        Security::analyzeXSS($_POST);
        $user = $this->loadModel("TestData");
        $this->getJSON("sendInsert", $user);
    }

    public function sendDelete()
    {
        $this->checkIsJS();
        Security::slashSQLForm($_POST);
        Security::analyzeXSS($_POST);
        $user = $this->loadModel("TestData");
        $this->getJSON("sendDelete", $user);
    }

    public function sendModify()
    {
        $this->checkIsJS();
        Security::slashSQLForm($_POST);
        Security::analyzeXSS($_POST);
        $user = $this->loadModel("TestData");
        $this->getJSON("sendModify", $user);
    }

    public function sendSelect()
    {
        $this->checkIsJS();
        $user = $this->loadModel("TestData");
        $this->getJSON("sendSelect", $user);
    }
}