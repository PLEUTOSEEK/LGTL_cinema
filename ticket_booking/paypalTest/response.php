<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require 'config.php';

if (empty($_GET['paymentId']) || empty($_GET['PayerID'])) {
    throw new Exception('The response is missing the paymentId and PayerID');
}

$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);

$execution = new PaymentExecution();
$execution->setPayerId($_GET['PayerID']);

try {
    // Take the payment
    $payment->execute($execution, $apiContext);

    try {
        $conn = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

        $payment = Payment::get($paymentId, $apiContext);

        $data = [
            'product_id' => $payment->transactions[0]->item_list->items[0]->sku,
            'transaction_id' => $payment->getId(),
            'payment_amount' => $payment->transactions[0]->amount->total,
            'currency_code' => $payment->transactions[0]->amount->currency,
            'payment_status' => $payment->getState(),
            'invoice_id' => $payment->transactions[0]->invoice_number,
            'product_name' => $payment->transactions[0]->item_list->items[0]->name,
            'description' => $payment->transactions[0]->description,
        ];
        if (addOrder($data) !== false && $data['payment_status'] === 'approved') {
            // Payment successfully added, redirect to the payment complete page.
            $inserids = $conn->insert_id;
            header("location:http://localhost/LGTL_Cineplex/LGTL_cinema/ticket_booking/paypalTest/PaypalSuccess.php?payid=$inserids");
            exit(1);
        } else {
            // Payment failed
            header("location:http://localhost/LGTL_Cineplex/LGTL_cinema/ticket_booking/paypalTest/PaypalFailed.php");
            exit(1);
        }
    } catch (Exception $e) {
        // Failed to retrieve payment from PayPal
    }
} catch (Exception $e) {
    // Failed to take payment
}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addOrder($data) {
    global $conn;

    if (is_array($data)) {
        //'isdsssss' --- i - integer, d - double, s - string, b - BLOB
        $stmt = $conn->prepare('INSERT INTO `payments` (product_id,transaction_id, payment_amount,currency_code, payment_status, invoice_id, product_name, createdtime) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param(
                'isdsssss',
                $data['product_id'],
                $data['transaction_id'],
                $data['payment_amount'],
                $data['currency_code'],
                $data['payment_status'],
                $data['invoice_id'],
                $data['product_name'],
                date('Y-m-d H:i:s')
        );
        $stmt->execute();
        $stmt->close();

        return $conn->insert_id;
    }

    return false;
}
