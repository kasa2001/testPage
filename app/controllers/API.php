<?php

class API extends Controller
{
    private $database;
    public function __construct()
    {
        $this->database=new Database();
    }

    public function index()
    {

    }
}