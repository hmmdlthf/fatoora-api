<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/payhere/PayhereService.php';
require_once $ROOT . '/app/payment/PaymentService.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/email/Email.php';

function getStatus(int $statusCode)
{
    if ($statusCode == 0) {
        return 'Pending';
    } else if ($statusCode == 2) {
        return 'success';
    } else if ($statusCode == -1) {
        return 'canceled';
    } else if ($statusCode == -2) {
        return 'failed';
    } else if ($statusCode == -3) {
        return 'charged back';
    }
}

// $merchant_secret = 'MzA4NTY0Mzg5NjEwOTA4NTg0OTkyMjQ1NDg2MzU0MzEyOTE1ODAzMA=='; // secret for localhost
$merchant_secret = 'Njc4ODA0NDMzNjI1NjUwNDIyNTc1Njg2NDMzNDIzMTg1MzMy'; // scret for aftersite

$merchant_id = $_POST['merchant_id'];
$order_id = $_POST['order_id'];
$payment_id = $_POST['payment_id'];
$payhere_amount = $_POST['payhere_amount'];
$payhere_currency = $_POST['payhere_currency'];
$status_code = $_POST['status_code']; // (2, 0, -1, -2, -3): 2-success, 0-pending, -1-canceled, -2-failed, -3-chargedback
$md5sig = $_POST['md5sig'];
$method = $_POST['method']; // (VISA, MASTER, AMEX, EZCASH, MCASH, GENIE, VISHWA, PAYAPP, HNB, FRIMI)
$status_message = $_POST['status_message'];

// 2 custom parameters sent my merchant to checkout page 
$student_id = $_POST['custom_1']; 
$custom_2 = $_POST['custom_2'];

// if credit/debit card
$card_holder_name = $_POST['card_holder_name'];
$card_no = $_POST['card_no']; // masked card number (Ex: ************4564)
$card_expiry = $_POST['card_expiry']; // format MMYY 

$local_md5sig  = strtoupper(
    md5(
        $merchant_id .
            $order_id .
            $payhere_amount .
            $payhere_currency .
            $status_code .
            strtoupper(md5($merchant_secret))
    )
);

if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
    $paymentService = new PaymentService();
    $paymentService->updateByOrderId($order_id, (int)$status_code, $payment_id);

    $studentService = new StudentService();

    $email = new Email();
    $body = "Payment $order_id update <br>".
            "Amount: " . number_format((float)$payhere_amount, 2, '.', ',')  . "<br>".
            "Status: " . getStatus($status_code) . "Rs <br>" .
            "Method: $method <br>";

    try {
        $email = new Email();
        $email->setTo($studentService->getStudentById($student_id)->getEmail());
        $email->setSubject("Payment Status for orderId: $order_id");
        $email->setIsHTML(true);
        $email->setBody($body);
        $email->setAltBody("we sent the email in html, it seems your mail server doesn't support html");
        $email->setSendersName("Online Academy");
        $email->sendEmail();
    } catch (Exception $e) {
        die("error $e");
    }
}