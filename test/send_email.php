<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/email/Email.php";

$buyer_name = $_POST['buyer__name'];
if (empty($buyer_name)) {
    echo "Enter your name <br>";
}

$buyer_email = $_POST['buyer__email'];
if (empty($buyer_email)) {
    echo "Enter your email <br>";
}

$company_name = $_POST['company__name'];
if (empty($company_name)) {
    echo "Enter your company name <br>";
}

$company_website = $_POST['company__website'];
if (empty($company_website)) {
    echo "Enter your company's website <br>";
}

$buyer_message = $_POST['buyer__message'];

$subject = 'Thank\'s for the response';
$body = 'We recieved your request, and you\'ll here from us ASAP';
$result = array("state"=>"valid", "message"=>"Thank You For Contacting Us.");

$notify_to_email = "hmmdlthf@gmail.com";
$notify_subject = "Email sent from me.aftersite.lk site";
$notify_body = "Email was sent to a client in the website https://me.aftersite.lk <br>".
                "Email: $buyer_email <br>". 
                "name: $buyer_name <br>".
                "company: $company_name <br>".
                "company Website: $company_website <br>". 
                "message: $buyer_message";
$notify_altBody = "Email was sent to a client in the website https://me.aftersite.lk, Email: $buyer_email, name: $buyer_name, company: $company_name, company Website: $company_website, message: $buyer_message";

// email for the buyer
try {
    $email = new Email();
    $email->setTo($buyer_email);
    $email->setSubject($subject);
    $email->setBody($body);
    $email->sendEmail();
    $result = json_encode($result);
    echo $result;

} catch (Exception $e) {
    $result['state'] = 'invalid';
    $result['message'] = 'Please Try agian later';
    $result = json_encode($result);
    echo $result;

}

// email sent notification email for me my personal email
$email = new Email();
$email->setTo($notify_to_email);
$email->setSubject($notify_subject);
$email->setIsHTML(true);
$email->setBody($notify_body);
$email->setAltBody($notify_altBody);
$email->setSendersName("My Portfolio");
$email->sendEmail();
