<?php

session_start();
$_SESSION['logInCustomer'] = "C10001";

include '../db_connection.php';

if (!empty($_POST['action'])) {
    if ($_POST['action'] == "checkRefundQualificationFunc") {
        checkRefundQualification($_POST['order_ID'], $_POST['order_date']);
    }
}

function retrieveOrderDtls($orderID) {
    $conn = OpenCon();

    $orderDtls = array();

    $sql = "SELECT
                    O.ORDER_ID,
                    O.TRANSACTION_ID,
                    L.LOCATION_NAME,
                    CR.CINEMA_ROOM_ID,
                    O.ORDER_DATE,
                    SCH.SHOW_DATE,
                    SCH.SHOW_TIME,
                    SCH.END_TIME,
                    CU.CUST_ID,
                    CU.CUST_NAME,
                    O.TOTAL_PRICE
            FROM
                    ORDERS           O
                    JOIN CUSTOMER    CU  USING (CUST_ID)
                    JOIN ORDER_LIST  OL  USING (ORDER_ID)
                    JOIN SCHEDULE    SCH USING (SCHEDULE_ID)
                    JOIN SEAT        S   USING (SEAT_ID)
                    JOIN CINEMA_ROOM CR  USING (CINEMA_ROOM_ID)
                    JOIN LOCATION    L   USING (LOCATION_ID)
            WHERE
                    O.ORDER_ID = ?
            LIMIT 1;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
// output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($orderDtls, $row);
        }
    }

    CloseCon($conn);

    return $orderDtls;
}

function retrieveOrderListFoodDtls($orderID) {
    $conn = OpenCon();

    $orderListFoodDtls = array();

    $sql = "SELECT
                    FB.fb_id,
                    FB.food_name,
                    FB.unit_price,
                    OL.quantity,
                    OL.sub_price
            FROM
                    order_list OL
                    JOIN food_and_beverage FB USING (fb_id)
            WHERE
                    OL.order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
// output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($orderListFoodDtls, $row);
        }
    }

    CloseCon($conn);

    return $orderListFoodDtls;
}

function retrieveOrderListSeatDtls($orderID) {
    $conn = OpenCon();

    $orderListSeatDtls = array();

    $sql = "SELECT
                    ST.seat_id,
                    ST.seat_name,
                    OL.ticket_type,
                    OL.unit_price
            FROM
                    order_list OL
                    JOIN schedule S  USING (schedule_id)
                    JOIN seat     ST USING (seat_id)
            WHERE
                    OL.order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
// output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($orderListSeatDtls, $row);
        }
    }

    CloseCon($conn);

    return $orderListSeatDtls;
}

function retrieveCustInfor() {
    $custID = !empty($_SESSION['logInCustomer']) ? $_SESSION['logInCustomer'] : null;
    $conn = OpenCon();

    $custDtls = array();

    $sql = "SELECT
                    C.EMAIL,
                    C.CUST_NAME
            FROM
                    CUSTOMER C
            WHERE
                    C.CUST_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $custID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
// output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($custDtls, $row);
        }
    }

    CloseCon($conn);

    if (count($custDtls) != 0) {
        $custDtls = $custDtls[0];
        return $custDtls;
    } else {
        return null;
    }
}

function checkRefundQualification($orderID, $orderDate) {
    $custDtls = retrieveCustInfor();

    if (!is_null($custDtls)) {
        //current date > refund date
        $result = array();
        if (date("Y-m-d") > date("Y-m-d", strtotime($orderDate . ' +3 day'))) {
            $result = array(
                "email" => $custDtls['EMAIL'],
                "subj" => "LGTL Cineplex: Refund Rejection Notice [$orderID]",
                "msgBody" => nl2br("Dear " . $custDtls['CUST_NAME'] . ":"
                        . "\n\nGreetings, we have received the request for a refund from you for order ID [$orderID]. Unfortunately, according to our company policy, we are unable to make refunds for you if the order date has exceeded 3 issue days."
                        . "\n\nYou are always welcome to email us via our contact channel. Stay tuned."
                        . "\n\nBest Regards,"
                        . "\nLGTL Cineplex"
                        . "\n\n\n*This email is auto-generated by the system, please do not make any reply.*")
            );
        } else {
            $result = array(
                "email" => $custDtls['EMAIL'],
                "subj" => "LGTL Cineplex: Refund Success Notice [$orderID]",
                "msgBody" => nl2br("Dear " . $custDtls['CUST_NAME'] . ":"
                        . "\n\nGreetings, we have received the request for a refund from you for order ID []. According to our company policy, we are able to make refunds for you if the order date has within 3 issue days. Hence, we are here to inform you that your refund request has been approved. Please be patient, we are processing your refunds request. "
                        . "\n\nYou are always welcome to email us via our contact channel. Stay tuned."
                        . "\n\nBest Regards,"
                        . "\nLGTL Cineplex"
                        . "\n\n\n*This email is auto-generated by the system, please do not make any reply.*")
            );
        }
        echo json_encode($result);
    } else {
        echo null;
    }
}
