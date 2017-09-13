<?php

class Action extends Controller
{
    public function logout(){
        $this->server = Server::getInstance($this->config);
        if ($this->server->checkPreviewWebSite()!==null){
            Session::destroySession();
        }
        $this->server->redirect("home/index");
    }

    public function checkExists()
    {
        $this->server = Server::getInstance($this->config);
        $model = $this->loadModel("User");
        $query = $model->createQuery($model->table(),"select",[$model->checkRegistry(), $_POST["nick"]]);
        $model->request($query);
        if ($model->isEmpty()){
            $query = $model->createQuery($model->table(),"INSERT",array_merge($model->registration(), $this->indexedData($_POST)));
            $model->insert($query);
            $this->server->redirect("home/index");
        }else{
            $this->server->redirect("user/registry");
        }
    }

    public function sendMail()
    {
        $this->server = Server::getInstance($this->config);
        $mail = Mail::getInstance($this->config['mail']);
        if ($mail->sendMail($_POST["to"], $_POST["subject"], $_POST["content"])) {
            echo "success";
            $this->server->redirect('home/index');
        }else {
            echo "Dramat... nie pykło coś";
        }

    }
}