<?php

namespace Lib\Built\Collection;
class Queue extends Collection
{
    const EMPTY_QUEUE = 7;

    public function __construct($data = null, $count = 0)
    {
        parent::__construct($data, $count);
    }

    public function copy()
    {
        return new Queue($this->collection, $this->_count);
    }

    public function enQueue($object)
    {
        $this->_check($object);
        array_push($this->collection, $object);
        ++$this->_count;
    }

    public function deQueue()
    {
        try {
            if ($this->_count == 0) {
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Empty Queue", self::EMPTY_QUEUE);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
        $object = $this->collection[0];
        unset($this->collection[0]);
        $this->collection = array_values($this->collection);
        --$this->_count;
        return $object;
    }

    public function peek()
    {
        try {
            if (!isset($this->collection[0])) {
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Empty Queue", self::EMPTY_QUEUE);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
        return $this->collection[0];
    }
}