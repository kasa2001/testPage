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

    }

    public function error401()
    {

    }

    public function error400()
    {

    }
}