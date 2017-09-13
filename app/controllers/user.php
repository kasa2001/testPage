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
        $this->server = Server::getInstance($this->config);
        if (Session::getDataWithSession("Id")!==null){
            $this->server->redirect("home/index");
        }else{
            $this->view = View::getInstance($this->config);
            $this->view->display('user/login', NULL, $this->css, $this->js);
        }
    }

    public function registry()
    {
        $this->server = Server::getInstance($this->config);
        $this->js="form";
        if (Session::getDataWithSession("Id")!==null){
            $this->server->redirect("home/index");
        }else{
            $this->view = View::getInstance($this->config);
            $this->view->display('user/registry', $this->config, $this->css, $this->js);
        }
    }

    public function add()
    {
        $this->server = Server::getInstance($this->config);
        if (Session::getDataWithSession("Id")!==null){
            $this->js = "ajax";
            $this->view = View::getInstance($this->config);
            $this->view->display('user/add', NULL, $this->css, $this->js);
        }else{
            $this->server->redirect("home/index");
        }
    }


    public function delete()
    {
        $this->server = Server::getInstance($this->config);
        if (Session::getDataWithSession("Id")!==null){
            $user = $this->loadModel('TestData');
            $user->request($user->createQuery($user->table(),"SELECT"));
            $this->js = "ajax";
            $this->view = View::getInstance($this->config);
            $this->view->display('user/delete', $user, $this->css, $this->js);
        }else{
            $this->server->redirect("home/index");
        }
    }

    public function modify()
    {
        $this->server = Server::getInstance($this->config);
        if (Session::getDataWithSession("Id")!==null){
            $user = $this->loadModel('TestData');
            $user->request($user->createQuery($user->table(),"SELECT"));
            $this->js = "ajax";
            $this->view = View::getInstance($this->config);
            $this->view->display('user/modify', $user, $this->css, $this->js);
        }else{
            $this->server->redirect("home/index");
        }
    }

    public function select()
    {
        $this->server = Server::getInstance($this->config);
        if (Session::getDataWithSession("Id")!==null){
            $user = $this->loadModel("TestData");
            $user->request($user->createQuery($user->table(),"SELECT"));
            $this->view = View::getInstance($this->config);
            $this->view->display('user/select', $user, $this->css, $this->js);
        }else{
            $this->server->redirect("home/index");
        }
    }

    public function mail()
    {
        $this->server = Server::getInstance($this->config);
        $this->view = View::getInstance($this->config);
        $this->view->display("user/mail", null, $this->css, null);
    }
}