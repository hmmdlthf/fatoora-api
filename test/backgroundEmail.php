<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'app/email/emails/mailConfig.php';

$toemail = $argv[1];

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host       = $hostname;        // SMTP server example
    $mail->SMTPDebug  = $SMTPDebug;       // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;             // enable SMTP authentication
    $mail->SMTPSecure = "tls";
    $mail->Port       = $port;            // set the SMTP port for the GMAIL server
    $mail->Username   = $username;        // SMTP account username example
    $mail->Password   = $password;        // SMTP account password example

    // Content
    $mail->setFrom($sendersEmail, $sendersName);
    $mail->addAddress($toemail);
    $mail->addReplyTo($sendersEmail, $sendersName);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    $mail->Subject = 'testing Online Academy';
    $mail->Body    = 'testing.....................';

    $mail->isHTML($isHTML);
    $mail->AltBody = "we sent the email in html, it seems your mail server doesn't support html";
    $mail->send();
    echo 'email sent';

} catch (Exception $e) {
    die("error: $e");
}

