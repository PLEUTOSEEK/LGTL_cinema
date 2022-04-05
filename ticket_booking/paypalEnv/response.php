<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require 'config.php';
include '../../db_connection.php';

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

        $payment = Payment::get($paymentId, $apiContext);

        $data = [
            'payment_amount' => $payment->transactions[0]->amount->total,
            'order_date' => date("Y-m-d H:i:s"),
            'payment_status' => $payment->getState(),
            'description' => $payment->transactions[0]->description,
            'transaction_id' => $payment->getId(),
            'current_date' => date("Y-m-d H:i:s")
        ];
        $orderID = addOrder($data);
        if ($orderID !== "" && $data['payment_status'] === 'approved') {
            // Payment successfully added, redirect to the payment complete page.
            header("location:http://localhost/LGTL_Cineplex/LGTL_cinema/ticket_booking/paypalEnv/paypalSuccessPage.php?order_id=$orderID");

            exit(1);
        } else {
            // Payment failed
            //
            header("location:http://localhost/LGTL_Cineplex/LGTL_cinema/ticket_booking/paypalEnv/paypalFailPage.php");
            exit(1);
        }
    } catch (Exception $e) {
        // Failed to retrieve payment from PayPal
        var_dump($e);
    }
} catch (Exception $e) {
    // Failed to take payment
    var_dump($e);
}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function generateCustID() {
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT cust_id FROM customer ORDER BY cust_id DESC limit 1");
    //$stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->fetch_object();

    $newCustID = "";
    if (!is_null($value)) {
        $latestCustID = $value->cust_id;
        $latestCustIDNum = substr($latestCustID, 1);

        $newCustID = "C" . ($latestCustIDNum + 1);
    } else {
        $newCustID = "C10001";
    }

    CloseCon($conn);

    return $newCustID;
}

function createGuestAcc() {
    $newCustID = generateCustID();

    $conn = OpenCon();

    $sql = "INSERT INTO `customer` (cust_id         , "
            . "                   cust_name       , "
            . "                   email           , "
            . "                   password        , "
            . "                   phone_no        , "
            . "                   date_modified) "
            . "                   VALUES (?,?,?,?,?,?);";

    //date("Y-m-d H:i:s"); currrent date
    // $date=date_create("2013-03-15");
    //echo date_format($date,"Y/m/d H:i:s"); self-made date
    $currentDate = date("Y-m-d H:i:s");
    $undeFine = "UNDEFINED";
    $guest = "GUEST";
    $phoneNo = "999";
    $pass = "123";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $newCustID, $guest, $undeFine, $pass, $phoneNo, $currentDate);
    $stmt->execute();

    CloseCon($conn);

    return $newCustID;
}

function addOrder($data) {
    if (!empty($_COOKIE['seatsSelected']) && !empty($_COOKIE['seatsSelected'])) {
        $seatsSelected = json_decode($_COOKIE['seatsSelected'], true);
        $foodsSelected = json_decode($_COOKIE['foodsSelected'], true);

        if (is_array($data)) {
            $newOrderID = generateOrderID();
            $logInCustomerID = "";

            if (!empty($_SESSION['logInCustomer'])) {
                $logInCustomer = $_SESSION['logInCustomer'];
                $logInCustomerID = $logInCustomer['cust_id'];
            } else {
                $logInCustomerID = createGuestAcc();
            }

            $conn = OpenCon();

            $sql = "INSERT INTO orders (order_id       , "
                    . "                 cust_id        , "
                    . "                 total_price    , "
                    . "                 order_date     , "
                    . "                 status         , "
                    . "                 description    , "
                    . "                 transaction_id , "
                    . "                 date_modified)   "
                    . "                 VALUES (?,?,?,?,?,?,?,?);";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsssss", $newOrderID, $logInCustomerID, $data['payment_amount'], $data['order_date'], $data['payment_status'], $data['description'], $data['transaction_id'], $data['current_date']);
            $stmt->execute();

            CloseCon($conn);

            completeOrderList($newOrderID, $seatsSelected, $foodsSelected);
            return $newOrderID;
        }
    }
    return "";
}

function completeOrderList($newOrderID, $seatsSelected, $foodsSelected) {

    foreach ($seatsSelected as $seatSelected) {
        $data = [
            'order_list_id' => generateOrderListID(),
            'order_id' => $newOrderID,
            'fb_id' => null,
            'schedule_id' => $seatSelected['sch_id'],
            'ticket_type' => $seatSelected['ticket_type'],
            'unit_price' => $seatSelected['unitPrice'],
            'quantity' => 1,
            'sub_price' => $seatSelected['unitPrice'],
            'description' => '',
            'date_modified' => date("Y-m-d H:i:s")
        ];
        addOrderList($data);
    }


    foreach ($foodsSelected as $foodSelected) {
        $data = [
            'order_list_id' => generateOrderListID(),
            'order_id' => $newOrderID,
            'fb_id' => $foodSelected['fb_id'],
            'schedule_id' => null,
            'ticket_type' => null,
            'unit_price' => $foodSelected['uniPr'],
            'quantity' => $foodSelected['foodQty'],
            'sub_price' => $foodSelected['uniPr'] * $foodSelected['foodQty'],
            'description' => '',
            'date_modified' => date("Y-m-d H:i:s")
        ];
        addOrderList($data);
    }
}

function addOrderList($data) {
    $conn = OpenCon();

    $sql = "INSERT INTO order_list
            (order_list_id      ,
             order_id           ,
             fb_id              ,
             schedule_id        ,
             ticket_type        ,
             unit_price         ,
             quantity           ,
             sub_price          ,
             description        ,
             date_modified)
            VALUES (?,?,?,?,?,?,?,?,?,?)
            ";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssssdidss",
            $data['order_list_id'],
            $data['order_id'],
            $data['fb_id'],
            $data['schedule_id'],
            $data['ticket_type'],
            $data['unit_price'],
            $data['quantity'],
            $data['sub_price'],
            $data['description'],
            $data['date_modified']);
    $stmt->execute();

    CloseCon($conn);
}

function generateOrderListID() {
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT order_list_id FROM order_list ORDER BY order_list_id DESC limit 1");
    //$stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->fetch_object();

    $newOrderListID = "";
    if (!is_null($value)) {
        $latestOrderListID = $value->order_list_id;
        $latestOrderListIDNum = substr($latestOrderListID, 2);

        $newOrderListID = "OL" . ($latestOrderListIDNum + 1);
    } else {
        $newOrderListID = "OL10001";
    }

    CloseCon($conn);

    return $newOrderListID;
}

function generateOrderID() {
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT order_id FROM orders ORDER BY order_id DESC limit 1");
    //$stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->fetch_object();

    $newOrderID = "";
    if (!is_null($value)) {
        $latestOrderID = $value->order_id;
        $latestOrderIDNumber = substr($latestOrderID, 1);

        $newOrderID = "O" . ($latestOrderIDNumber + 1);
    } else {
        $newOrderID = "O1001";
    }


    CloseCon($conn);

    return $newOrderID;
}
