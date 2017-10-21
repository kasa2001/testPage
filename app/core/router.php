<?php

namespace Core;


class Router
{

    private static $object;

    use \GetInstance;

    private function __construct()
    {
    }

    /**
     * Method where you can prepare routing. Method this you can add to switch uri (if you not added uri default controller been execute)
     * @param $uri string
     * @return string
     * */
    public function checkRoute($uri)
    {
        switch ($uri) {
            default:
                return $uri;
        }
    }
}