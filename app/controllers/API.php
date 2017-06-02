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

    public function sendSelect()
    {
        $this->getJSON("sendSelect");
    }

    public function sendInsert()
    {
        $this->getJSON("sendInsert");
    }

    public function sendDelete()
    {
        $this->getJSON("sendDelete");
    }

    public function sendModify()
    {
        $this->getJSON("sendModify");
    }
}