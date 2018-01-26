<?php

/**
 * All new classes must extends which class Controller.
 * */
namespace Controllers;

use \Core\Controller;
use \Lib\Built\Collection;
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
            $user = $this->loadModel('\Models\User');
            $query = $user->createQuery($user->table(), "SELECT", array_merge($user->login(), $this->indexedData($_POST)), "a");
            $user->request($query);
            $user->saveData();
        }
        $css = "main home";
        $this->view = View::getInstance($this->config);
        $pagination = new Pagination(5,5, 2201);
        $this->view->display("home/index", null, $css, null);
//        echo $pagination;

        $user = new \Models\User();
        $taxonomy = new \Models\Taxonomy();
        $database = new \Core\Database2();
        $database
            ->select(array(new class {
                private $id;
            }, $taxonomy))
            ->from(array($user, $taxonomy))
            ->where(function() use ($user, $taxonomy){
                return $user->item() < $taxonomy->id();
            });

        echo '<pre>';
        print_r($database);
        echo '</pre>';
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