<?php

class Stack extends Collection
{
    const EMPTY_STACK = 4;

    public function __construct($data = null, $how = 0)
    {
        parent::__construct($data, $how);
    }

    public function copy()
    {
        return new Stack($this->collection, $this->_how);
    }

    /**
     * Method push object or another variable to Stack
     * @param $object mixed
     */
    public function push($object)
    {
        $this->_check($object);
        array_push($this->collection, $object);
        ++$this->_how;
    }

    /**
     * Method pop object from Stack
     * @return mixed
     * */
    public function pop()
    {
        try {
            if ($this->_how == 0) {
                $this->loader->changeRegister("loadException");
                throw new CollectionException("Empty stack", self::EMPTY_STACK);
            }
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
        $object = $this->collection[$this->_how];
        --$this->_how;
        return $object;
    }
}