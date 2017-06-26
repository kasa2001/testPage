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
            $this->view('user/login', NULL, $this->css, $this->js);
        }
    }

    public function registry()
    {
        $this->js="form";
        if (Session::getDataWithSession("Id")!==null){
            $this->redirect("home/index");
        }else{
            $this->view('user/registry', null, $this->css, $this->js);
        }
    }

    public function add()
    {
        if (Session::getDataWithSession("Id")!==null){
            $this->js = "ajax";
            $this->view('user/add', null, $this->css, $this->js);
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
            $this->view('user/delete', $user, $this->css, $this->js);
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
            $this->view('user/modify', $user, $this->css, $this->js);
        }else{
            $this->redirect("home/index");
        }
    }

    public function select()
    {
        if (Session::getDataWithSession("Id")!==null){
            $user = $this->loadModel("TestData");
            $user->request($user->createQuery($user->table(),"SELECT"));
            $this->view('user/select', $user, $this->css, $this->js);
        }else{
            $this->redirect("home/index");
        }
    }
}