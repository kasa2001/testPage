<?php


class UnidirectionalList extends Collection implements Iterator
{
    const END_OF_LIST = 4;

    private $key;

    public function __construct($data = null, $how = 0)
    {
        parent::__construct($data, $how);
        $this->key = 0;
    }

    /**
     * Method return current object
     * @return object
     * */
    public function current()
    {
        return $this->collection[$this->key];
    }

    /**
     * Method return next object
     * @return object
     */
    public function next()
    {
        ++ $this->key;
        try{
            if ($this->key>= $this->_how)
                throw new CollectionException("Wrong! End of list", self::END_OF_LIST);
        } catch (CollectionException $e) {
            $this->_getError($e);
        }
        return $this->collection[$this->key];
    }

    /**
     * Method return current key
     * @return int
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Method check end of list
     * @return boolean
     */
    public function valid()
    {
        return ($this->key < $this->_how);
    }

    /**
     * Method reset current position
     */
    public function rewind()
    {
        $this->key = 0;
    }

    public function clear()
    {
        parent::clear();
        $this->key = 0;
    }

}