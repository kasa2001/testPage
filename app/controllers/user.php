<?php

class User extends Controller
{
    public function index()
    {

    }

    public function login()
    {
        if ($_POST != null)
            $user = $this->loadModel('User');
        $css = "main user";
        $js = "main";
        $this->view('user/login', NULL, $css, $js);
    }

    public function registry()
    {
        if ($_POST != null)
            $user = $this->loadModel('User');
        $js = null;
        $css = "main user";
        $this->view('user/registry', null, $css, $js);
    }

    public function add()
    {
        $this->view('user/add');
    }


    public function delete()
    {
        $this->view('user/delete');
    }

    public function modify()
    {
        $this->view('user/modify');
    }

    public function select()
    {
        $this->view('user/select');
    }
}