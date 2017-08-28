<?php

class Date
{
    private $day;
    private $month;
    private $year;
    private $hour;
    private $minutes;
    private $seconds;

    public function __construct($date = array())
    {
        if (!empty($date)) {
            $this->day = $date["day"];
            $this->month = $date["month"];
            $this->year = $date["year"];
            $this->hour = $date["hour"];
            $this->minutes = $date["minutes"];
            $this->seconds = $date["seconds"];
        } else {
            $this->day = date("d");
            $this->month = date("m");
            $this->year = date("y");
            $this->hour = date("H");
            $this->minutes = date("i");
            $this->seconds = date("s");
        }
    }

    /**
     * @return false|string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return false|string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return false|string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return false|string
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @return false|string
     */
    public function getMinutes()
    {
        return $this->minutes;
    }

    /**
     * @return false|string
     */
    public function getSeconds()
    {
        return $this->seconds;
    }

    public function getDate($format)
    {
        return $this->year . $format . $this->month . $format . $this->day;
    }

    public function getTime($format)
    {
        return $this->hour . $format . $this->minutes . $format . $this->seconds;
    }

}