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
        if (Session::getDataWithSession("Id")!==null){
            $this->redirect("home/index");
        }else{
            $this->view = View::getInstance($this->config);
            $this->view->display('user/login', NULL, $this->css, $this->js);
        }
    }

    public function registry()
    {
        $this->js="form";
        if (Session::getDataWithSession("Id")!==null){
            $this->redirect("home/index");
        }else{
            $this->view = View::getInstance($this->config);
            $this->view->display('user/registry', NULL, $this->css, $this->js);
        }
    }

    public function add()
    {
        if (Session::getDataWithSession("Id")!==null){
            $this->js = "ajax";
            $this->view = View::getInstance($this->config);
            $this->view->display('user/add', NULL, $this->css, $this->js);
        }else{
            $this->redirect("home/index");
        }
    }


    public function delete()
    {
        if (Session::getDataWithSession("Id")!==null){
            $user = $this->loadModel('TestData');
            $user->request($user->createQuery($user->table(),"SELECT"));
            $this->js = "ajax";
            $this->view = View::getInstance($this->config);
            $this->view->display('user/delete', $user, $this->css, $this->js);
        }else{
            $this->redirect("home/index");
        }
    }

    public function modify()
    {
        if (Session::getDataWithSession("Id")!==null){
            $user = $this->loadModel('TestData');
            $user->request($user->createQuery($user->table(),"SELECT"));
            $this->js = "ajax";
            $this->view = View::getInstance($this->config);
            $this->view->display('user/modify', $user, $this->css, $this->js);
        }else{
            $this->redirect("home/index");
        }
    }

    public function select()
    {
        if (Session::getDataWithSession("Id")!==null){
            $user = $this->loadModel("TestData");
            $user->request($user->createQuery($user->table(),"SELECT"));
            $this->view = View::getInstance($this->config);
            $this->view->display('user/select', $user, $this->css, $this->js);
        }else{
            $this->redirect("home/index");
        }
    }
}