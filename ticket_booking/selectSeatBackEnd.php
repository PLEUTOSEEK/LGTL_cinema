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

function getSeats($cinemaRoomID, $showDate, $showTime, $movieID) {
    $conn = OpenCon();

    $seatList = array();

    $sql = "SELECT
                    S.schedule_id,
                    S.seat_id,
                    ST.seat_name,
                    S.status,
		    ST.INDEX_SPLIT
            FROM
                    SCHEDULE S
                    JOIN MOVIE M USING (MOVIE_ID)
                    JOIN SEAT ST USING (SEAT_ID)
                    JOIN CINEMA_ROOM CR USING (CINEMA_ROOM_ID)
            WHERE
                    CR.CINEMA_ROOM_ID = ?
                    AND S.SHOW_DATE = ?
                    AND S.SHOW_TIME = ?
                    AND S.MOVIE_ID = ?
            ORDER BY
                    ST.INDEX_SPLIT,
		    ST.seat_name;";

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
