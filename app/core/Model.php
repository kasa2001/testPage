<?php


class Model extends Database
{
    protected $table;
    protected $columns = [];

    public function __construct()
    {
        parent::__construct();
    }
}