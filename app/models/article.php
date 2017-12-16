<?php

namespace Models;


use Core\Database;

class Article extends Database
{
    public function addArticle()
    {
        $this->query = "insert into `testdata` (``) values ()";
    }
}