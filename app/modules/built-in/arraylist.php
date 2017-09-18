<?php

class ArrayList extends Collection implements Iterator
{

    const INDEX_NOT_EXISTS = 6;
    private $key;

    public function __construct($data = null, $how = 0)
    {
        parent::__construct($data, $how);
        $this->key = 0;
    }

    public function copy()
    {
        return new ArrayList($this->collection, $this->_how);
    }

    public function add($object)
    {
        $this->_check($object);
        array_push($this->collection, $object);
        ++$this->_how;
    }

    public function current()
    {
        try {
            if (!isset($this->collection[$this->key])) {
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Index not exists", self::INDEX_NOT_EXISTS);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }

        return $this->collection[$this->key];
    }

    public function next()
    {
        try {
            if (!isset($this->collection[$this->key + 1])) {
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Index not exists", self::INDEX_NOT_EXISTS);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return ($this->_how > $this->key);
    }

    public function rewind()
    {
        $this->key = 0;
    }
}