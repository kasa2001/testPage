<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
    if (!isset($_SERVER['HTTP_REFERER']))
        $this->redirect("home/index");
    else
        $this->redirect();
}