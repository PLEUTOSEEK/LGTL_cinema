<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../db_connection.php';
include "back_end/back_end.php";
$conn = OpenCon();

if (isset($_POST['action'])) {
    if ($_POST['action'] == "dynamicFilterFunc") {
        dynamicFilter();
    }
}

function dynamicFilter() {

    $dateSelected = $_POST['date_selected'];
    $scheduleList = json_decode($_POST['scheduleList'], true);
    $counter = 1;
    //get unique location
    $locationNames = array();

    foreach ($scheduleList as $schedule) {
        if ($schedule['show_date'] == $dateSelected) {
            array_push($locationNames, $schedule['location_name']);
        }
    }

    $locationNames = array_unique($locationNames);

    $htmlCode = "";

    foreach ($locationNames as $location) {
        $htmlCode .= " <button class=\"btn btn-outline-primary  h-10 btn-block py-3 my-3 rounded-0\" type=\"button\" data-toggle=\"collapse\" data-target=\"#timeSlotsBox$counter\" aria-controls=\"timeSlotsBox$counter\" aria-expanded=\"false\" aria-label=\"Toggle time slots\">";

        $htmlCode .= " <h4 class = \"float-left font-weight-bold text-uppercase text-left my-auto\">$location</h4>";

        $htmlCode .= " <h4 class = \"float-right font-weight-bold my-auto\">+</h4>";

        $htmlCode .= " </button>";

        $htmlCode .= "<div class=\"collapse  rounded-0 p-lg-3 text-center\" id=\"timeSlotsBox$counter\" >";
        $htmlCode .= "<button class = \"btn btn-outline-primary font-weight-bold text-uppercase float-right my-3\">";
        $htmlCode .= "location ";
        $htmlCode .= "</button>";

        $htmlCode .= "<div class=\"row  align-items-center justify-content-center w-100 mx-auto\">";
        $uniTimes = array();

        foreach ($scheduleList as $schedule) {

            if ($schedule['show_date'] == $dateSelected && $schedule['location_name'] == $location) {

                if (in_array($schedule['show_time'], $uniTimes) == false) {
                    $htmlCode .= "<button class=\"btn btn-outline-primary font-weight-bold text-uppercase col-4 mr-lg-5 mr-4 my-lg-3 my-sm-3 my-3 rounded-0 add-on-timeslot-btn  \" >";
                    $htmlCode .= $schedule['show_time'];
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
