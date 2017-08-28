<?php


class SQLException extends Exception
{
    public function __construct($message = "Warning! Method can't be use", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}