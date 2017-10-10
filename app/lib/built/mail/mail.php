<?php


namespace Lib\Built\Mail;

class Mail
{
    private static $object;
    private $config;
    use \GetInstance;
    private $mail;

    private function __construct($config)
    {
        $this->config = $config;
        require_once 'app/lib/PHPMailer/PHPMailerAutoload.php';
        require_once 'app/lib/PHPMailer/class.phpmailer.php';
        require_once 'app/lib/PHPMailer/class.smtp.php';
    }

    public function sendMail($to, $subject, $message)
    {
        $this->mail = new \PHPMailer();
        $this->mail->CharSet = "UTF-8";
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = $this->config['host'];
        $this->mail->Port = $this->config['port'];
        $this->mail->Username = $this->config['email'];
        $this->mail->Password = $this->config['password'];
        $this->mail->SMTPSecure = $this->config['secure'];
        $this->mail->From = $this->config['email'];
        $this->mail->FromName = "Jan Kowalski";
        $this->mail->addAddress($to);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->SMTPDebug = 4;
        $this->mail->isHTML(true);
        $this->mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
        echo "<pre>";
        print_r($this);
        if ($this->mail->send()) {
            echo "</pre>";
            return true;
        } else {
            echo "</pre>";
            return false;
        }
    }
}