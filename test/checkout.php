<?php


$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/payhere/PayhereService.php';
require_once $ROOT . '/app/payment/PaymentService.php';


$student_id = 1;
$merchant_id = '1222661';
$amount = 1000.00;
$currency = 'LKR';
// $merchant_secret = 'MzA4NTY0Mzg5NjEwOTA4NTg0OTkyMjQ1NDg2MzU0MzEyOTE1ODAzMA=='; // secret for localhost
$merchant_secret = 'Njc4ODA0NDMzNjI1NjUwNDIyNTc1Njg2NDMzNDIzMTg1MzMy'; // scret for aftersite

// $return_url = 'http://localhost:3000/test/checkoutSuccess.php';
// $cancel_url = 'http://localhost:3000/test/checkoutCancel.php';
// $notify_url = 'https://academicportal.aftersite.lk/test/checkoutNotify.php';

$return_url = 'https://academicportal.aftersite.lk/test/checkoutSuccess.php';
$cancel_url = 'https://academicportal.aftersite.lk/test/checkoutCancel.php';
$notify_url = 'https://academicportal.aftersite.lk/test/checkoutNotify.php';


$paymentService = new PaymentService();
$order_id = $paymentService->save($amount, $student_id);

$hash = strtoupper(
    md5(
        $merchant_id .
            $order_id .
            number_format($amount, 2, '.', '') .
            $currency .
            strtoupper(md5($merchant_secret))
    )
);

echo $hash;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
</head>

<body>
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
        <input type="hidden" name="merchant_id" value="<?php echo $merchant_id ?>"> <!-- Replace your Merchant ID -->
        <input type="hidden" name="return_url" value="<?php echo $return_url ?>">
        <input type="hidden" name="cancel_url" value="<?php echo $cancel_url ?>">
        <input type="hidden" name="notify_url" value="<?php echo $notify_url ?>">
        </br></br>Item Details</br>
        <input type="text" name="order_id" value="<?php echo $order_id ?>">
        <input type="text" name="items" value="Door bell wireless">
        <input type="text" name="currency" value="<?php echo $currency ?>">
        <input type="text" name="amount" value="<?php echo $amount ?>">
        </br></br>Customer Details</br>
        <input type="hidden" name="custom_1" value="<?php echo $student_id ?>">
        <input type="text" name="first_name" value="Saman">
        <input type="text" name="last_name" value="Perera">
        <input type="text" name="email" value="hmmdlthf@gmail.com">
        <input type="text" name="phone" value="0741609373">
        <input type="text" name="address" value="No.1, Galle Road">
        <input type="text" name="city" value="Colombo">
        <input type="hidden" name="country" value="Sri Lanka">
        <input type="hidden" name="hash" value="<?php echo $hash ?>"> <!-- Replace with generated hash -->
        <input type="submit" value="Buy Now">
    </form>
</body>

</html>