<?php

class TestDataTable extends Model
{

    use DeleteData;

    public function __construct(){
        parent::__construct();
    }

    public function table()
    {
        return "testdata";
    }

    public function columns()
    {
        $columns[0] = 'id';
        $columns[1] = 'data';
        $columns[2] = 'create_at';
        $columns[3] = 'update_at';
        return $columns;
    }
    public function insertData()
    {
        $columns[0] = "data";
        $columns[1] = "create_at";
        return $columns;
    }


    public function updateData()
    {
        return "data";
    }

}