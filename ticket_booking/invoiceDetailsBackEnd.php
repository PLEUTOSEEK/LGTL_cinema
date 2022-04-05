<?php

include '../db_connection.php';

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
