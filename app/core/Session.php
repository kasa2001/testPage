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
    public function writeToSession($data)
    {
        foreach ($data as $key=>$datum){
            if (!isset($_SESSION[$key])){
                $_SESSION=$datum;
            }else if ($_SESSION[$key]!=$datum)
                $_SESSION=$datum;
        }
    }

    /**
     * Method get data from session
     * @param $data string
     * @return session data from session where index is $data
     * */
    public function getDataWithSession($data)
    {
        return $_SESSION[$data];
    }

    /**
     * Method kill session
     * */
    public function destroySession()
    {
        unset($_SESSION);
        session_destroy();
    }
}