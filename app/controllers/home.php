<?php

/**
 * All new classes must extends which class Controller.
 * */
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
        $map = new Map();
        $list = new ArrayList();
        $queue = new Queue();
        $stack = new Stack();

        $map->add(new Database(),'database');
        $map->add(new Database(),'connect');
        $map->add(new Database(),'connection');
        $map->add(new Database(),'second');

        $list->add(new Database());
        $list->add(new Database());
        $list->add(new Database());
        $list->add(new Database());

        $queue->enQueue(new Database());
        $queue->enQueue(new Database());
        $queue->enQueue(new Database());
        $queue->enQueue(new Database());

        $stack->push(new Database());
        $stack->push(new Database());
        $stack->push(new Database());
        $stack->push(new Database());

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