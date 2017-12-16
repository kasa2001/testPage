<?php

namespace Models;

use Core\Database;

class TestData extends Database
{

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
        $columns[0] = "title";
        $columns[1] = "alias";
        $columns[2] = "data";
        return $columns;
    }

    public function getUpdateDate()
    {
        return "update_at";
    }

    public function deleteData()
    {
        return "id";
    }
}