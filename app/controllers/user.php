<?php

class User extends Controller
{

    private $js = null;
    private $css = "main user";

    public function index()
    {

    }

    public function login()
    {
        $this->view('user/login', NULL, $this->css, $this->js);
    }

    public function registry()
    {
        $this->view('user/registry', null, $this->css, $this->js);
    }

    public function add()
    {
        $this->js = "ajax";
        $this->view('user/add', null, $this->css, $this->js);
    }


    public function delete()
    {
        $user = $this->loadModel('TestData');
        $user->request($user->createQuery($user->table(),"SELECT"));
        $this->js = "ajax";
        $this->view('user/delete', $user, $this->css, $this->js);
    }

    public function modify()
    {
        $user = $this->loadModel('TestData');
        $user->request($user->createQuery($user->table(),"SELECT"));
        $this->js = "ajax";
        $this->view('user/modify', $user, $this->css, $this->js);
    }

    public function select()
    {
        $user = $this->loadModel("TestData");
        $user->request($user->createQuery($user->table(),"SELECT"));
        $this->view('user/select', $user, $this->css, $this->js);
    }
}