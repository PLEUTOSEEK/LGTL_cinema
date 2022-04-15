<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../db_connection.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == "retrieveFoods") {
        getFoodsCompleteInfo();
    }

    if ($_POST['action'] == "completeFoodsFunc") {
        completeOrder($_POST['totalPr']);
    }
}

function getSeatsCompleteInfo() {
    if (!empty($_COOKIE['seatsSelected'])) {
        $seatsSelected = json_decode($_COOKIE['seatsSelected'], true);

        return $seatsSelected;
    }
}

function getInvoiceDetails($schID) {

    $conn = OpenCon();

    $invoiceDtls = array();

    $sql = "SELECT
                    s.schedule_id,
                    M.movie_name,
                    M.unit_price,
                    L.location_name,
                    S.show_date,
                    S.show_time
            FROM
                    SCHEDULE S
                    JOIN MOVIE M USING (MOVIE_ID)
                    JOIN SEAT ST USING (SEAT_ID)
                    JOIN CINEMA_ROOM CR USING (CINEMA_ROOM_ID)
                    JOIN LOCATION L USING (LOCATION_ID)
            WHERE
                    S.SCHEDULE_ID = ?;
            ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $schID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($invoiceDtls, $row);
        }
    }

    CloseCon($conn);

    return $invoiceDtls;
}

function getFoodsCompleteInfo() {
    if (!empty($_COOKIE['foodsSelected'])) {
        $foodsSelected = json_decode($_COOKIE['foodsSelected'], true);

        if (count($foodsSelected) != 0) {
            echo json_encode($foodsSelected);
        }
    }

    echo null;
}
