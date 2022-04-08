<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../db_connection.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == "dynamicFilterFunc") {
        dynamicFilter();
    }
}

function getSchedule($movieID, $status) {
    $conn = OpenCon();
    $scheduleList = array();

    $sql = "SELECT L.location_id, L.location_name, L.geo_location, CR.cinema_room_id,M.movie_id, SCH.show_date, SCH.show_time, SCH.schedule_id

                    FROM movie M, schedule SCH, seat S, cinema_room CR, location L

                    WHERE M.movie_id = SCH.movie_id
                            AND SCH.seat_id = S.seat_id
                            AND S.cinema_room_id = CR.cinema_room_id
                            AND CR.location_id = L.location_id
                            AND M.movie_id = ?
                            AND SCH.status = ?

                    ORDER BY L.location_name ASC, SCH.show_time ASC;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $movieID, $status);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($schedule = $result->fetch_assoc()) {
            array_push($scheduleList, $schedule);
        }
    } else {
        echo "0 results";
    }

    CloseCon($conn);

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

function dynamicFilter() {

    $dateSelected = $_POST['date_selected'];
    $scheduleList = json_decode($_POST['scheduleList'], true);
    $counter = 1;
    //get unique location
    $locationNames = array();

    foreach ($scheduleList as $schedule) {
        if ($schedule['show_date'] == $dateSelected) {
            array_push($locationNames, array(
                "locationID" => $schedule['location_id'],
                "locationName" => $schedule['location_name'],
                "locationGeo" => $schedule['geo_location'],
            ));
        }
    }

    $locationNames = array_values(array_column($locationNames, null, 'locationID'));

    $htmlCode = "";
    foreach ($locationNames as $location) {
        $htmlCode .= " <button class = \"btn btn-outline-primary  h-10 btn-block py-3 my-3 rounded-0\" type=\"button\" data-toggle=\"collapse\" data-target=\"#timeSlotsBox$counter\" aria-controls=\"timeSlotsBox$counter\" aria-expanded=\"false\" aria-label=\"Toggle time slots\">";

        $htmlCode .= " <h4 class = \"float-left font-weight-bold text-uppercase text-left my-auto\">" . $location['locationName'] . "</h4>";

        $htmlCode .= " <h4 class = \"float-right font-weight-bold my-auto\">+</h4>";

        $htmlCode .= " </button>";

        $htmlCode .= "<div class=\"collapse  rounded-0 p-lg-3 text-center\" id=\"timeSlotsBox$counter\" >";

        $htmlCode .= "<a href = '" . $location['locationGeo'] . "' target='_blank'>";
        $htmlCode .= "<button class ='btn btn-outline-primary font-weight-bold text-uppercase float-right my-3'>";
        $htmlCode .= "location";
        $htmlCode .= "</button>";
        $htmlCode .= "</a>";

        $htmlCode .= "<div class=\"row  align-items-center justify-content-center w-100 mx-auto\">";
        $uniTimes = array();

        foreach ($scheduleList as $schedule) {

            if ($schedule['show_date'] == $dateSelected && $schedule['location_id'] == $location['locationID']) {

                if (in_array($schedule['show_time'], $uniTimes) == false) {
                    $uniFormID = uniqid();
                    $htmlCode .= "<form action = 'selectSeat.php' method = 'POST' name = \"ticket-info\" class = \"time-obj py-0\" id=$uniFormID >";
                    $htmlCode .= "<input type = \"hidden\" name = \"cinema_room_id\" value = \"" . $schedule['cinema_room_id'] . "\" />";
                    $htmlCode .= "<input type = \"hidden\" name = \"movie_id\" value = \"" . $schedule['movie_id'] . "\" />";
                    $htmlCode .= "<input type = \"hidden\" name = \"show_date\" value = \"" . $schedule['show_date'] . "\" />";
                    $htmlCode .= "<input type = \"hidden\" name = \"show_time\" value = \"" . $schedule['show_time'] . "\" />";
                    $htmlCode .= "</form>";
                    $htmlCode .= "<button type='submit' form='$uniFormID' value='Submit' class=\"btn btn-outline-primary font-weight-bold text-uppercase col-4 mr-lg-5 mr-4 my-lg-3 my-sm-3 my-3 rounded-0 add-on-timeslot-btn\" >";
                    $htmlCode .= date("h:i a", strtotime($schedule['show_time']));
                    $htmlCode .= " </button>";
                    array_push($uniTimes, $schedule['show_time']);
                }
            }
        }
        $htmlCode .= "</div>";
        $htmlCode .= "</div>";
        $counter++;
    }



    echo $htmlCode;
}
