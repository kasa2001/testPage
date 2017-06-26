<?php

class Action extends Controller
{
    public function logout(){
        Session::destroySession();
        $this->redirect("home/index");
    }
}