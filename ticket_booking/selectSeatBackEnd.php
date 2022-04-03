<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../db_connection.php';
if (isset($_POST['action'])) {
    if ($_POST['action'] == "setSeatsBookedFunc") {
        setSeatsBooked();
    }
}

function setSeatsBooked() {
    $showDate = $_POST['show_date'];
    $showTime = $_POST['show_time'];
    $movieID = $_POST['movie_id'];

    $conn = OpenCon();
    $seatsInStr = implode("', '", json_decode($_POST['seat'], true));
    $seatsInStr = "'" . $seatsInStr . "'";

    $sql = "
            UPDATE
                SCHEDULE
            SET
                STATUS = 'Booked'
            WHERE
                SHOW_DATE = ?
                AND SHOW_TIME = ?
                AND MOVIE_ID = ?
                AND SEAT_ID IN ($seatsInStr)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $showDate, $showTime, $movieID);
    $stmt->execute();
    $result = $stmt->get_result();

    CloseCon($conn);
    return $seatsInStr;
}

function getSeats($cinemaRoomID, $showDate, $showTime, $movieID) {
    $conn = OpenCon();

    $seatList = array();

    $sql = "SELECT
                    S.seat_id, S.status
            FROM
                    SCHEDULE S
                    JOIN SEAT ST USING (SEAT_ID)
                    JOIN CINEMA_ROOM CR USING (CINEMA_ROOM_ID)
            WHERE
                    CR.CINEMA_ROOM_ID = ?
                    AND S.SHOW_DATE = ?
                    AND S.SHOW_TIME = ?
                    AND S.MOVIE_ID = ?
            ORDER BY
                    S.seat_id;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $cinemaRoomID, $showDate, $showTime, $movieID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($seat = $result->fetch_assoc()) {
            array_push($seatList, $seat);
        }
    } else {
        echo "0 results";
    }

    CloseCon($conn);

    return $seatList;
}
