<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getSchedule($movieID, $status, $conn) {
    $scheduleList = array();

    $sql = "SELECT L.location_name, SCH.show_date, SCH.show_time, SCH.schedule_id

                    FROM movie M, schedule SCH, seat S, cinema_room CR, location L

                    WHERE M.movie_id = SCH.movie_id
                            AND SCH.seat_id = S.seat_id
                            AND S.cinema_room_id = CR.cinema_room_id
                            AND CR.location_id = L.location_id
                            AND M.movie_id = ?
                            AND SCH.status = ?

                    ORDER BY L.location_name ASC;";

    $stmt->bind_param("ss", $movieID, $status);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($schedule = $result->fetch_assoc()) {
            array_push($scheduleList, $schedule);
        }
        print_r($scheduleList);
    } else {
        echo "0 results";
    }

    $conn->close();

    return $scheduleList;
}

function getUniqueList($list, $colName) {
    $uniList = array();
    foreach ($list as $element) {
        array_push($uniList, $element[$colName]);
    }
    $uniList = array_unique($uniList);
    return $uniList;
}
