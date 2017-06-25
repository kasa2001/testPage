<?php

class API extends Controller
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function index()
    {

    }

    public function sendInsert()
    {
        $this->checkIsJS();
        $user = $this->loadModel("TestData");
        $this->getJSON("sendInsert", $user);
    }

    public function sendDelete()
    {
        $this->checkIsJS();
        $user = $this->loadModel("TestData");
        $this->getJSON("sendDelete", $user);
    }

    public function sendModify()
    {
        $this->checkIsJS();
        $user = $this->loadModel("TestData");
        $this->getJSON("sendModify", $user);
    }
}