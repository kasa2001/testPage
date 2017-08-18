<?php

//SMTP!!! TODO!!!
class Mail
{
    private static $object;
    private $config;
    use GetInstance;

    private function __construct($config)
    {
        $this->config=$config;
    }

    public function sendMail($to, $subject, $message)
    {

    }
}