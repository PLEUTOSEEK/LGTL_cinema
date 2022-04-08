<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../db_connection.php";
if (!empty($_POST['action'])) {
    if ($_POST['action'] == "retrieveAllOrdersByCustFunc") {
        retrieveAllOrdersByCust();
    }
    if ($_POST['action'] == "retrieveAllOrdersByCustAndConditionFunc") {
        retrieveAllOrdersByCustAndCondition($_POST['srch_text']);
    }
}

function retrieveAllOrdersByCust() {

    if (!empty($_SESSION['logInCustomer'])) {
        $orderList = array();

        $conn = OpenCon();

        $sql = "
                SELECT
                        O.ORDER_ID,
                        O.ORDER_DATE,
                        L.LOCATION_NAME,
                        SCH.SHOW_DATE,
                        O.TOTAL_PRICE
                FROM
                        CUSTOMER C
                        JOIN ORDERS O USING (CUST_ID)
                        JOIN ORDER_LIST OL USING (ORDER_ID)
                        JOIN SCHEDULE SCH USING (SCHEDULE_ID)
                        JOIN SEAT ST USING (SEAT_ID)
                        JOIN CINEMA_ROOM CR USING (CINEMA_ROOM_ID)
                        JOIN LOCATION L USING (LOCATION_ID)
                WHERE
                        C.CUST_ID = ?
                GROUP BY
                        O.ORDER_ID;
            ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['logInCustomer']['cust_id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($orderList, $row);
            }
        }

        CloseCon($conn);

        echo json_encode($orderList);
    } else {
        echo "zz";
    }
}

function retrieveAllOrdersByCustAndCondition($srchText) {
    if (!empty($_SESSION['logInCustomer'])) {
        $orderList = array();

        $conn = OpenCon();

        $sql = "
                SELECT
                        O.ORDER_ID,
                        O.ORDER_DATE,
                        L.LOCATION_NAME,
                        SCH.SHOW_DATE,
                        O.TOTAL_PRICE
                FROM
                        CUSTOMER C
                        JOIN ORDERS O USING (CUST_ID)
                        JOIN ORDER_LIST OL USING (ORDER_ID)
                        JOIN SCHEDULE SCH USING (SCHEDULE_ID)
                        JOIN SEAT ST USING (SEAT_ID)
                        JOIN CINEMA_ROOM CR USING (CINEMA_ROOM_ID)
                        JOIN LOCATION L USING (LOCATION_ID)
                WHERE
                        C.CUST_ID = ?
                        AND (
                            O.ORDER_ID LIKE ?
                            OR O.ORDER_DATE LIKE ?
                            OR L.LOCATION_NAME LIKE ?
                            OR SCH.SHOW_DATE LIKE ?
                            OR O.TOTAL_PRICE LIKE ?
                        )
                GROUP BY
                        O.ORDER_ID;
            ";
        $stmt = $conn->prepare($sql);
        $srchText = "%" . $srchText . "%";
        $stmt->bind_param("ssssss", $_SESSION['logInCustomer']['cust_id'], $srchText, $srchText, $srchText, $srchText, $srchText);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($orderList, $row);
            }
        }

        CloseCon($conn);

        echo json_encode($orderList);
    } else {
        echo "zz";
    }
}
