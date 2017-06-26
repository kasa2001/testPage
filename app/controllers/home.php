<?php

/**
 * All new classes must extends which class Controller.
 * */
class Home extends Controller
{
    public function index($name = '')
    {
        $user=null;
        if ($_POST!=null){
            Security::slashSQLForm($_POST);
            Security::analyzeXSS($_POST);
            $user = $this->loadModel('User');
            if ($this->checkPreviewWebSite() === "http://localhost/PTW/public/user/login"){
                $query = $user->createQuery($user->table(),"SELECT",array_merge($user->login(), $this->indexedData($_POST)) ,"a");
                $user->request($query);
                $user->saveData();
            }else{
                $query = $user->createQuery($user->table(),"INSERT",array_merge($user->registration(), $this->indexedData($_POST)) ,"a");
                $user->request($query);
            }
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