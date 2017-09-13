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

    public function current()
    {
        return $this->collection[$this->key];
    }

    /**
     * @return mixed
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
     * @return mixed
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function valid()
    {
        return ($this->key < $this->_how);
    }

    /**
     * @return mixed
     */
    public function rewind()
    {
        $this->key = 0;
        return true;
    }

}