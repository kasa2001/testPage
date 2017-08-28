<?php

//SMTP!!! TODO!!!
class Mail
{
    private static $object;
    private $config;
    use \GetInstance;
    private $mail;

    private function __construct($config)
    {
        $this->config = $config;
        require_once '../app/lib/PHPMailer/PHPMailerAutoload.php';
        require_once '../app/lib/PHPMailer/class.phpmailer.php';
        require_once '../app/lib/PHPMailer/class.smtp.php';
        $this->sendMail("pawelgomolka@interia.pl", "Test", "Wiadomość testowa");
    }

    public function sendMail($to, $subject, $message)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $this->config['host'];
        $mail->Port = $this->config['port'];
        $mail->Username = $this->config['email'];
        $mail->Password = $this->config['password'];
        $mail->SMTPSecure = $this->config['secure'];
        $mail->From = $this->config['email'];
        $mail->FromName = "Paweł Gomółka";
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);
//        $mail->send();
    }
}