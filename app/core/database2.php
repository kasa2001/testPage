<?php

namespace Core;


use Lib\Built\Collection\ArrayList;
use Lib\Built\Collection\Map;
use Lib\Built\Collection\Queue;
use Lib\Built\Collection\Stack;
use Lib\Built\Error\Error;
use Lib\Built\StdObject\StdObject;

class Database2 extends Config
{
    /**
     * @var \PDOStatement
     * */
    private $data;

    /**
     * @var \PDO
     * */
    private $connect;

    /**
     * @var string
     * */
    private $driver;

    /**
     * @var string
     * */
    private $server;

    /**
     * @var string
     * */
    private $login;

    /**
     * @var string
     * */
    private $password;

    /**
     * @var string
     * */
    private $base;

    /**
     * @var array
     * */
    private $select = array();

    /**
     * @var array
     * */
    private $from = array();

    /**
     * @var array
     * */
    private $where = array();


    /**
     * Connect with database
     * @param $driver string/null
     * @param $host string/null
     * @param $db string/null
     * @param $user string/null
     * @param  $password string/null
     * */
    public function __construct($driver = null, $host = null, $db = null, $user = null, $password = null)
    {
        parent::__construct();
        $this->server = ($host === null) ? $this->config['database']['host'] : $host;
        $this->login = ($user === null) ? $this->config['database']['user'] : $user;
        $this->password = ($password === null) ? $this->config['database']['password'] : $password;
        $this->base = ($db === null) ? $this->config['database']['database'] : $db;
        $this->driver = ($driver === null) ? $this->config['database']['sql'] : $driver;
        try {
            $this->connect = new \PDO($this->driver . ":host=" . $this->server . ";dbname=" . $this->base, $this->login, $this->password);
        } catch (\PDOException $exception) {
            echo '<pre>';
            print_r($exception);
            echo '</pre>';
        }
        $this->connect->exec("set names utf8");
    }

    /**
     * Method get data from Database class to array
     * @return array
     * */
    public function loadArray()
    {
        return $this->data->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Method get data from Database class to Queue
     * @return Queue
     * */

    public function loadQueue()
    {
        $queue = new Queue();
        $item = $this->data->fetch(\PDO::FETCH_ASSOC);
        $object = new StdObject();
        foreach ($item as $data) {
            foreach ($data as $key => $i) {
                $object->$key = $i;
            }
            $queue->enQueue($object);
        }

        return $queue;
    }

    /**
     * Method get data from Database class to Stack
     * @return Stack
     * */
    public function loadStack()
    {
        $stack = new Stack();
        $item = $this->data->fetch(\PDO::FETCH_ASSOC);
        $object = new StdObject();
        foreach ($item as $data) {
            foreach ($data as $key => $i) {
                $object->$key = $data;
            }
            $stack->push($object);
        }

        return $stack;
    }

    /**
     * Method get data from Database class to Map
     * @return Map
     * */
    public function loadMap()
    {
        $map = new Map();
        $item = $this->data->fetch(\PDO::FETCH_ASSOC);
        $object = new StdObject();
        foreach ($item as $key => $data) {
            foreach ($data as $keys => $datum) {
                $object->$keys = $datum;
            }
            $map->add($object, $key);
        }

        return $map;
    }

    /**
     * Method get data from Database class to List
     * @return ArrayList
     * */
    public function loadList()
    {
        $list = new ArrayList();
        $item = $this->data->fetch(\PDO::FETCH_ASSOC);
        $object = new StdObject();
        foreach ($item as $data) {
            foreach ($data as $key => $i) {
                $object->$key = $i;
            }
            $list->add($object);
        }

        return $list;
    }

    /**
     * Method return 1 if query is empty or 0 if not empty
     * @return boolean
     * */
    public function isEmpty()
    {
        return $this->data->rowCount() == 0;
    }

    public function execute($query = null)
    {
        if ($query === null)
            $this->data = $this->connect->query($this->prepareQuery());
        else
            $this->data = $this->connect->query($query);
    }

    private function prepareQuery()
    {
        $query = null;

        return $query;
    }

    /*
     * Methods TODO
     * */

    /**
     * Method get class properties
     * @param $object mixed
     * @return $this
     * */
    public function select($object)
    {
        try {
            $reflect = new \ReflectionClass($object);
        } catch (\ReflectionException $exception) {
            Error::raiseError(500);
            exit;
        }

        $fields = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PUBLIC);

        foreach ($fields as $field)
            array_push($this->select, $field->name);

        return $this;
    }

    /**
     * Method get class name to query
     * @param $object mixed
     * @return $this
     * */
    public function from($object)
    {
        $class = explode('\\', get_class($object));

        $this->from = $class[count($class) - 1];
        return $this;
    }

    /**
     * Method add where
     * @param $callable callable
     * @return $this
     * */
    public function where($callable)
    {
        $this->where = $callable;
        return $this;
    }

    public function set()
    {
        return $this;
    }

    public function update()
    {
        return $this;
    }

    public function join()
    {
        return $this;
    }
}