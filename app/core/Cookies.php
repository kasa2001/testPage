<?php
/*
 * Class to do later. You can to better plan this out
 * */
class Cookies
{
    public static function getFromCookies($name,$i)
    {
        return $_COOKIE[$name.$i];
    }

    public static function destroyCookies($name)
    {
        unset($_COOKIE[$name]);
    }

    public static function cookieValue($name, $value, $time=null)
    {
        if ($time==null)
            setcookie($name, $value);
        else setcookie($name,$value,$time);
    }
}