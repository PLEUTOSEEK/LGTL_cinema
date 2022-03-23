<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <?php
    // Initialize the session
    session_start();

    include '../db_connection.php';
    $conn = OpenCon();
    ?>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="selectLocation.css">

    </head>
    <body>
        <?php
        include '../nav_bar/navigation_bar.php';
        include "back_end/back_end.php";
        ?>

        <?php
        $movieID = 'M1001';
        $scheduleList = getSchedule($movieID, 'Available', $conn);

        //get unique date
        $showDates = array();
        $showDates = getUniqueList($scheduleList, 'show_date');
        ?>

        <div class="container-fluid  py-3 ">
            <div class="container-fluid col-lg-8 col-sm-12 " id="date-selection-div">
                <select id = "date-selection" class="browser-default custom-select col-3 ticket-type-drop-down"  onchange="dynamicFilter();" >
                    <?php
                    foreach ($showDates as $date) {
                        $dateFormatted = date_format(date_create($date), "Y-F-d");
                        echo "<option value='$date'>$dateFormatted</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="container-fluid col-lg-8 col-sm-12 " id="location-time-selection">

            </div>
        </div>

        <?php
        include '../nav_bar/footer.php';
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>
                    $('#date-selection').ready(function () {
                        dynamicFilter();
                    })

                    function clearContent(elementID) {
                        document.getElementById(elementID).innerHTML = '';
                    }

                    function dynamicFilter() {
                        clearContent('location-time-selection');
                        var scheduleListArr = <?php echo json_encode($scheduleList); ?>;
                        scheduleListArr = JSON.stringify(scheduleListArr);

                        $.ajax({
                            url: "selectLocationBackEnd.php",
                            type: "POST",
                            data: {"action": "dynamicFilterFunc",
                                "scheduleList": scheduleListArr,
                                "date_selected": $("#date-selection").val()
                            },
                            error: function (xhr, status, error) {
                                console.log("Error: " + error);
                            }
                            ,
                            success: function (result, status, xhr) {
                                document.getElementById("location-time-selection").innerHTML = result;
                            }
                        }
                        );
                    }

        </script>
    </body>
</html>

