<?php

class Map extends Collection
{
    const INDEX_BUSY = 5;

    public function __construct($data = null, $how = 0)
    {
        parent::__construct($data, $how);
    }

    public function copy()
    {
        return new Map($this->collection, $this->_count);
    }

    public function add($object, $key)
    {
        $this->_check($object);
        $this->_checkIndex($key);
        $this->collection = array_merge($this->collection,array($key=>$object));
        ++$this->_count;
    }

    public function get($key)
    {
        try {
            if (!isset($this->collection[$key])) {
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Wrong index", self::WRONG_INDEX);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
        return $this->collection[$key];
    }

    public function remove($key)
    {
        try {
            if (!isset($this->collection[$key])) {
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Wrong index", self::WRONG_INDEX);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
        unset($this->collection[$key]);

        -- $this->_count;
    }

    protected function _checkIndex($key)
    {
        try {
            if (isset($this->collection[$key])) {
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Index busy", self::INDEX_BUSY);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
    }
}