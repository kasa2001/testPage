<?php

class User extends Controller
{
    public function index()
    {

    }

    public function login()
    {
        if ($_POST!=null)
            $user = $this->loadModel('User');
        $css = "main user";
        $js = "main";
        $this->view('user/login', NULL, $css, $js);
    }

    public function registry(){
        if ($_POST!=null)
            $user = $this->loadModel('User');
        $js=null;
        $css="main user";
        $this->view('user/registry', null, $css, $js);
    }
}