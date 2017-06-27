<?php

/**
 * All new classes must extends which class Controller.
 * */
class Home extends Controller
{
    public function index($name = '')
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
        $js = null;
        $this->view('home/index', $user, $css, $js);
    }

    public function error()
    {
        $this->view("home/error", NULL);
    }
}