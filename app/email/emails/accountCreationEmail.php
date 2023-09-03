<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'app/email/emails/mailConfig.php';

$toemail = $argv[1];
$username = $argv[2];
$password = $argv[3];
$date = $argv[4];
$token = $argv[5];

$hostname = 'smtp.titan.email';
$port = 587;
$SMTPDebug = 0;
$hostusername = 'no-reply@academicportal.aftersite.lk';
$hostpassword = 'AcademicMailNoreplyUserAftersite123@';
$sendersEmail = 'no-reply@academicportal.aftersite.lk';
$sendersName = 'Online Academy';
$isHTML = true;

$body = "Your login credentials. <br><br>" .
        "Credentials requested email: " . $toemail . "<br>" .
        "username: " . $username . "<br>" .
        "password: " . $password . "<br>" .
        "created at: " . $date . "<br>" .
        "click the link to verify <br>" .
        "http://localhost:3000/teacher/verify.php?email=" . $toemail . "&token=" . $token . "<br>";

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host       = $hostname;        // SMTP server example
    $mail->SMTPDebug  = $SMTPDebug;       // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;             // enable SMTP authentication
    $mail->SMTPSecure = "tls";
    $mail->Port       = $port;            // set the SMTP port for the GMAIL server
    $mail->Username   = $hostusername;    // SMTP account username example
    $mail->Password   = $hostpassword;    // SMTP account password example

    // Content
    $mail->setFrom($sendersEmail, $sendersName);
    $mail->addAddress($toemail);
    $mail->addReplyTo($sendersEmail, $sendersName);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    $mail->Subject = 'Welcome to Online Academy';
    $mail->Body    = $body;

    $mail->isHTML($isHTML);
    $mail->AltBody = "we sent the email in html, it seems your mail server doesn't support html";
    $mail->send();
    echo 'email sent';

} catch (Exception $e) {
    die("error: $e");
}


