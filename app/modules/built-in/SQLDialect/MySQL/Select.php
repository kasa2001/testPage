<?php


namespace MySQL;


class Select
{
    private $distinct = false;
    private $all = false;
    private $column;
    private $table;


    public function __construct()
    {

    }

    public function count()
    {

    }

    public function selectColumn($data)
    {
        if(!$this->all) {

        }else throw new \SQLException("You can't select only chosen columns, because you call method selectAll()");
    }

    public function selectAll()
    {
        $this->all = true;
    }

    public function selectDistinct()
    {
        $this->distinct = true;
    }
}