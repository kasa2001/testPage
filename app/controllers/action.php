<?php

class Action extends Controller
{
    public function logout(){
        $server = Server::getInstance($this->config);
        if ($server->checkPreviewWebSite()!==null){
            Session::destroySession();
        }
        $server->redirect("home/index");
    }

    public function checkExists()
    {
        $server = Server::getInstance($this->config);
        $model = $this->loadModel("User");
        $query = $model->createQuery($model->table(),"select",[$model->checkRegistry(), $_POST["nick"]]);
        $model->request($query);
        if ($model->isEmpty()){
            $query = $model->createQuery($model->table(),"INSERT",array_merge($model->registration(), $this->indexedData($_POST)) ,"a");
            $model->request($query);
            $server->redirect("home/index");
        }else{
            $server->redirect("user/registry");
        }
    }

}