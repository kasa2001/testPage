<?php

/**
 * All new classes must extends which class Controller.
 * */
class Home extends Controller
{
    public function index($name = '')
    {
        if ($_POST!=null)
            $user = $this->loadModel('User');
        $css = "main home";
        $js = "main home";
        $this->view('home/index', NULL, $css, $js);
    }

    public function error()
    {
        $this->view("home/error", NULL);
    }
    public function sendSelect(){
        $user =  $this->loadModel('User');
        $this->view('home/sendSelect');
    }
}