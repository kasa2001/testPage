<?php

/**
 * All new classes must extends which class Controller.
 * */
namespace Controllers;

use \Core\Controller;
use \Lib\Built\Collection;
use Lib\Built\Session\Session;
use \Lib\Built\View\View;
use Lib\Built\Security\Security;
use \Core;
use Lib\Built\Server\Server;
use Modules\Built\Pagination\Pagination;

class Home extends Controller
{
    public function index()
    {
        $user = null;
        if (isset($_POST["nick"])) {
            Security::slashSQLForm($_POST);
            Security::analyzeXSS($_POST);
//            $user = $this->loadModel('\Models\User');
//            $query = $user->createQuery($user->table(), "SELECT", array_merge($user->login(), $this->indexedData($_POST)), "a");
//            $user->request($query);
//            $user->saveData();

            $model = new \Models\Logic\Home();
            $user = $model->login($_POST['nick'], $_POST['password']);

            Session::writeToSession($user);
        }
        $css = "main home";
        $this->view = View::getInstance($this->config);
        $pagination = new Pagination(5,5, 2201);
        $this->view->display("home/index", null, $css, null);
//        echo $pagination;

        $home = new \Models\Logic\Home();
        try {

            $home->getItems();

            $home->login('ala', 'makota');

        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * Method for test collection.
     * */
    public function collection()
    {
        $map = new Collection\Map();
        $list = new Collection\ArrayList();
        $queue = new Collection\Queue();
        $stack = new Collection\Stack();

        $map->add(new Core\Database(),'database');
        $map->add(new Core\Database(),'connect');
        $map->add(new Core\Database(),'connection');
        $map->add(new Core\Database(),'second');

        $list->add(new Core\Database());
        $list->add(new Core\Database());
        $list->add(new Core\Database());
        $list->add(new Core\Database());

        $queue->enQueue(new Core\Database());
        $queue->enQueue(new Core\Database());
        $queue->enQueue(new Core\Database());
        $queue->enQueue(new Core\Database());

        $stack->push(new Core\Database());
        $stack->push(new Core\Database());
        $stack->push(new Core\Database());
        $stack->push(new Core\Database());

        $this->view = View::getInstance($this->config);
        $this->view->display('home/collection',array($map,$list,$queue,$stack),'main home');
    }

    public function taxonomy()
    {

    }

    public function error($message = null)
    {
        $this->view = View::getInstance($this->config);
        $this->view->display("home/error", array('message' => $message, 'code' => Server::getStatus()), null, null);
    }
}