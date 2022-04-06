<?php

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;

require 'config.php';

if (empty($_POST['pymt_amt'])) {
    throw new Exception('This script should not be called directly, expected post data');
}

$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Set some example data for the payment.
$currency = 'MYR';
$item_qty = 1;
$amountPayable = $_POST['pymt_amt']; // total amount
$description = 'Paypal transaction';
$invoiceNumber = uniqid();

//change this to foods and seats details
$my_items = array();

$seatsSelected = json_decode($_COOKIE['seatsSelected'], true);
foreach ($seatsSelected as $seatSelected) {
    $qty = 1;
    array_push($my_items, array(
        'name' => $seatSelected['sch_id'],
        'price' => number_format($seatSelected['unitPrice'], 2),
        'quantity' => $qty,
        'currency' => $currency
    ));
}

$foodsSelected = json_decode($_COOKIE['foodsSelected'], true);
foreach ($foodsSelected as $foodSelected) {
    array_push($my_items, array(
        'name' => $foodSelected['fb_id'],
        'price' => number_format($foodSelected['uniPr'], 2),
        'quantity' => $foodSelected['foodQty'],
        'currency' => $currency
    ));
}

$amount = new Amount();
$amount->setCurrency($currency)
        ->setTotal($amountPayable);

$items = new ItemList();
$items->setItems($my_items);

$transaction = new Transaction();
$transaction->setAmount($amount)
        ->setDescription($description)
        ->setInvoiceNumber($invoiceNumber)
        ->setItemList($items);

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($paypalConfig['return_url'])
        ->setCancelUrl($paypalConfig['cancel_url']);

$payment = new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions([$transaction])
        ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode(); // Prints the Error Code
    echo $ex->getData(); // Prints the detailed error message
    die($ex);
} catch (Exception $ex) {
    die($ex);
}

header('location:' . $payment->getApprovalLink());
exit(1);
