<?php

namespace Controllers;

use \Core;
use Lib\Built\Server\Server;
use Lib\Built\Mail\Mail;
use Lib\Built\Session\Session;

class Action extends Core\Controller
{
    public function logout()
    {
        $this->server = Server::getInstance($this->config);

        Session::destroySession();

        $this->server->redirect(204);
    }

    public function checkExists()
    {
        $this->server = Server::getInstance($this->config);
        $model = $this->loadModel("User");
        $query = $model->createQuery($model->table(), "select", [$model->checkRegistry(), $_POST["nick"]]);
        $model->request($query);
        if ($model->isEmpty()) {
            $query = $model->createQuery($model->table(), "INSERT", array_merge($model->registration(), $this->indexedData($_POST)));
            $model->insert($query);
            $this->server->redirect("home/index");
        } else {
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
        } else {
            echo "Dramat... nie pykło coś";
        }

    }
}
