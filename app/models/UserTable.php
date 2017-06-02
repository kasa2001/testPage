<?php

class UserTable extends Model
{
    protected $database;

    /**
     * Construct create new object -> Model
     * */
    public function __construct(){
        parent::__construct();
    }

    public function table()
    {
        return "users";
    }

    public function columns()
    {
        $columns[0] = 'Id';
        $columns[1] = 'Nick';
        $columns[2] = 'EMAIL';
        $columns[3] = 'PASSWORD';
        return $columns;
    }

    public function login()
    {
        $columns[0] = 'PASSWORD';
        $columns[1] = 'Nick';
        return $columns;
    }

    public function registration()
    {
        $columns[0] = 'Nick';
        $columns[1] = 'EMAIL';
        $columns[2] = 'PASSWORD';
        return $columns;
    }
}