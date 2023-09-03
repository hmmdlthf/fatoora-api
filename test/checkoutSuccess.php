<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/payhere/PayhereService.php';
require_once $ROOT . '/app/payment/PaymentService.php';

echo "payment successfull";

$order_id = $_GET['order_id'];

$paymentService = new PaymentService();
$payment = $paymentService->getPaymentByOrderId($order_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    <div class="orderId"><?php echo "order Id: ". $order_id; ?></div>
    <div class="orderId"><?php echo "amount: ". $payment->getPaymentFee(); ?></div>
    <div class="orderId"><?php echo "created date: ". $payment->getCreatedDate(); ?></div>
    <div class="orderId"><?php echo "status code: ". $payment->getStatusCode(); ?></div>
    <div class="orderId"><?php echo "payment Id: ". $payment->getPaymentId(); ?></div>
    <div class="message">You will be further updated</div>
</body>
</html>
