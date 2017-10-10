<?php

/**
 * All new classes must extends which class Controller.
 * */
namespace Controllers;

use \Core\Controller,\Lib\Built\Collection, \Lib\Built\View\View, Lib\Built\Security\Security, \Core;

class Home extends Controller
{
    public function index()
    {
        $user = null;
        if (isset($_POST["nick"])) {
            Security::slashSQLForm($_POST);
            Security::analyzeXSS($_POST);
            $user = $this->loadModel('User');
            $query = $user->createQuery($user->table(), "SELECT", array_merge($user->login(), $this->indexedData($_POST)), "a");
            $user->request($query);
            $user->saveData();
        }
        $css = "main home";
        $this->view = View::getInstance($this->config);
        $this->view->display("home/index", null, $css, null);
    }

    /**
     * Method for test collection.
     * */
    public function collection()
    {
        $map = new Collection\Map();
        $list = new Collection\ArrayList();
        $queue = new Collection\Queue();
        $stack = new Collection\Stack();

        $map->add(new Core\Database(),'database');
        $map->add(new Core\Database(),'connect');
        $map->add(new Core\Database(),'connection');
        $map->add(new Core\Database(),'second');

        $list->add(new Core\Database());
        $list->add(new Core\Database());
        $list->add(new Core\Database());
        $list->add(new Core\Database());

        $queue->enQueue(new Core\Database());
        $queue->enQueue(new Core\Database());
        $queue->enQueue(new Core\Database());
        $queue->enQueue(new Core\Database());

        $stack->push(new Core\Database());
        $stack->push(new Core\Database());
        $stack->push(new Core\Database());
        $stack->push(new Core\Database());

        $this->view = View::getInstance($this->config);
        $this->view->display('home/collection',array($map,$list,$queue,$stack),'main home');
    }

    public function error404()
    {
        $this->view = View::getInstance($this->config);
        $this->view->display("home/error", array('error' => 404), null, null);
    }

    public function error403()
    {
        $this->view = View::getInstance($this->config);
        $this->view->display("home/error", array('error' => 403), null, null);
    }

    public function error410()
    {
        $this->view = View::getInstance($this->config);
        $this->view->display("home/error", array('error' => 410), null, null);
    }

    public function error402()
    {
        $this->view = View::getInstance($this->config);
        $this->view->display("home/error", array('error' => 402), null, null);
    }

    public function error401()
    {
        $this->view = View::getInstance($this->config);
        $this->view->display("home/error", array('error' => 401), null, null);
    }

    public function error400()
    {
        $this->view = View::getInstance($this->config);
        $this->view->display("home/error", array('error' => 400), null, null);
    }
}