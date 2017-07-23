<?php

class Pagination
{

    private static $pagination;
    private $allPages;
    private $prevLink;
    private $nextLink;
    private $startLink;
    private $endLink;

    private function __construct()
    {

    }

    /**
     * Method at this moment do nothing. Todo write him and pagination
     * */
    public function addNextPageLink()
    {
        echo '<link rel="next" href="">';
    }

    /**
     * Method at this moment do nothing. Todo write him and pagination
     * */
    public function addPreviousPageLink()
    {
        echo '<link rel="prev" href="">';
    }



    public function __toString()
    {
        return "null";
    }
}