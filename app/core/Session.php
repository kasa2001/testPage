<?php


class Session
{

    /**
     * Construct start session
     * */
    public function __construct()
    {
        if (!isset($_SESSION))
            session_start();
    }

    /**
     * Method write data to session
     * @param $data array
     * */
    public static function writeToSession($data)
    {
        foreach ($data as $key=>$datum){
            if (!isset($_SESSION[$key]))
                $_SESSION[$key]=$datum;
        }
    }

    /**
     * Method get data from session
     * @param $data string
     * @return session data from session where index is $data
     * */
    public static function getDataWithSession($data)
    {
        if (isset($_SESSION[$data]))
            return $_SESSION[$data];
        else return null;
    }

    /**
     * Method kill session
     * */
    public static function destroySession()
    {
        unset($_SESSION);
        session_destroy();
    }
}