<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

//configuring the email messages 
trait SendMail
{
    private $emailSentStatus = false;
    private $sendersEmail;
    private $sendersName;
    private $hostname;
    private $username;
    private $password;
    private $port;
    private $SMTPDebug;
    private $isHTML;

    protected $to;
    protected $subject;
    protected $body;
    private $altBody;
    private $mail;

    public function __construct()
    {
        // $this->hostname = $_ENV['MAIL_HOST'];
        // $this->port = $_ENV['MAIL_PORT'];
        // $this->SMTPDebug = $_ENV['MAIL_SMTPDebug'];
        // $this->username = $_ENV['MAIL_USERNAME'];
        // $this->password = $_ENV['MAIL_PASSWORD'];
        // $this->sendersEmail = $_ENV['MAIL_FROM_ADDRESS'];
        // $this->sendersName = $_ENV['MAIL_FROM_NAME'];
        // $this->isHTML = false;

        // $this->hostname = 'smtp.gmail.com';
        // $this->port = 587;
        // $this->SMTPDebug = 0;
        // $this->username = 'aftersite.emp@gmail.com';
        // $this->password = 'jhoippktdhluzavu';
        // $this->sendersEmail = 'aftersite.emp@gmail.com';
        // $this->sendersName = 'Althaf';
        // $this->isHTML = false;

        $this->hostname = 'smtp.titan.email';
        $this->port = 587;
        $this->SMTPDebug = 0;
        $this->username = 'no-reply@academicportal.aftersite.lk';
        $this->password = 'AcademicMailNoreplyUserAftersite123@';
        $this->sendersEmail = 'no-reply@academicportal.aftersite.lk';
        $this->sendersName = 'Online Academy';
        $this->isHTML = false;
    }

    public function getSendersEmail(): string
    {
        return $this->sendersEmail;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setIsHTML(bool $isHTML)
    {
        $this->isHTML = $isHTML;
    }

    public function setTo(string $to)
    {
        $this->to = $to;
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function setAltBody(string $altBody)
    {
        $this->altBody = $altBody;
    }

    public function setSendersName(string $sendersName)
    {
        $this->sendersName = $sendersName;
    }

    public function configEmail()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->CharSet = 'UTF-8';

        $this->mail->Host       = $this->hostname;        // SMTP server example
        $this->mail->SMTPDebug  = $this->SMTPDebug;       // enables SMTP debug information (for testing)
        $this->mail->SMTPAuth   = true;                   // enable SMTP authentication
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port       = $this->port;            // set the SMTP port for the GMAIL server
        $this->mail->Username   = $this->username;        // SMTP account username example
        $this->mail->Password   = $this->password;        // SMTP account password example

        // Content
        $this->mail->setFrom($this->sendersEmail, $this->sendersName);
        $this->mail->addAddress($this->to);
        $this->mail->addReplyTo($this->sendersEmail, $this->sendersName);
        // $this->mail->addCC('cc@example.com');
        // $this->mail->addBCC('bcc@example.com');

        $this->mail->Subject = $this->subject;
        $this->mail->Body    = $this->body;

        $this->mail->isHTML($this->isHTML);
        $this->mail->AltBody = $this->altBody;
    }

    public function sendEmail(): bool
    {
        $this->configEmail();
        try {
            $this->mail->send();
            $this->emailSentStatus = true;
            echo "Success";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error {$e} : {$this->mail->ErrorInfo}";
            $this->emailSentStatus = false;
        }
        return $this->emailSentStatus;
    }
}
