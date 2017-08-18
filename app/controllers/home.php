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
        $this->view->view("home/index", null, $css, null);
        $mail = Mail::getInstance($this->config["mail"]);
    }

    public function error404()
    {
        $_SERVER["REDIRECT_STATUS"] = 404;
        $this->view = View::getInstance($this->config);
        $this->view->view("home/error", array('error'=> 404), null, null);
    }

    public function error403()
    {
        $_SERVER["REDIRECT_STATUS"] = 403;
        $this->view = View::getInstance($this->config);
        $this->view->view("home/error", array('error'=> 403), null, null);
    }
}