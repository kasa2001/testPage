<?php

class Action extends Controller
{
    public function logout(){
        if ($this->checkPreviewWebSite()!==null){
            Session::destroySession();
        }
        $this->redirect("home/index");
    }

    public function checkExists()
    {
        $model = $this->loadModel("User");
        $query = $model->createQuery($model->table(),"select",[$model->checkRegistry(), $_POST["nick"]]);
        $model->request($query);
        if ($model->isEmpty()){
            $query = $model->createQuery($model->table(),"INSERT",array_merge($model->registration(), $this->indexedData($_POST)) ,"a");
            $model->request($query);
            $this->redirect("home/index");
        }else{
            $this->redirect("user/registry");
        }
    }

}