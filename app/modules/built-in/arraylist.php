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
        return new ArrayList($this->collection, $this->_count);
    }

    public function add($object)
    {
        $this->_check($object);
        array_push($this->collection, $object);
        ++$this->_count;
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
        $this->key++;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return ($this->key < ($this->_count));
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function remove()
    {
        unset($this->collection[$this->key]);
        $this->collection = array_values($this->collection);
        -- $this->_count;
    }

    public function get($index)
    {
        try {
            if (!isset($this->collection[$index])){
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Wrong index", self::WRONG_INDEX);
            }
        }catch (CollectionException $e) {
            $this->_getError($e);
        }
        return $this->collection[$index];
    }
}