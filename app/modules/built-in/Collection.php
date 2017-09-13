<?php

class Collection
{
    private $collection = array();

    public function __construct()
    {

    }

    public function add($object)
    {
        array_push($this->collection, $object);
    }


    public function remove($index)
    {

    }

    public function get($index)
    {
        if (isset($this->collection[$index]))
            return $this->collection[$index];
        else throw new Exception();
    }
}