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

    if (isset($_COOKIE['Seats'])) {
        echo "<h1>HIII</h1>";
    } else {
        echo "<h1>NPPP</h1>";
    }
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
        if (empty($_POST["movie_id"])) {
            echo "this page canot direct access";
        } else {
            $movieID = $_POST["movie_id"];
            $scheduleList = getSchedule($movieID, 'available', $conn);

            //get unique date
            $showDates = array();
            $showDates = getUniqueList($scheduleList, 'show_date');

            //get unique location
            $locationNames = array();
            $locationNames = getUniqueList($scheduleList, 'location_name');
        }
        ?>


        <div class="container-fluid  py-3 ">
            <div class="container-fluid col-lg-8 col-sm-12 " id="location-time-selection">

                <?php
                $locations = array("LGTL KLCC", "LGTL Suria");
                $geo = "zz";
                $times = array("10:30 pm", "11:30 pm");
                $counter = 1;

                foreach ($locations as $location) {
                    echo " <button class=\"btn btn-outline-primary  h-10 btn-block py-3 my-3 rounded-0\" type=\"button\" data-toggle=\"collapse\" data-target=\"#timeSlotsBox$counter\" aria-controls=\"timeSlotsBox$counter\" aria-expanded=\"false\" aria-label=\"Toggle time slots\">";

                    echo " <h4 class = \"float-left font-weight-bold text-uppercase text-left my-auto\">$location</h4>";

                    echo " <h4 class = \"float-right font-weight-bold my-auto\">+</h4>";

                    echo " </button>";

                    echo "<div class=\"collapse  rounded-0 p-lg-3 text-center\" id=\"timeSlotsBox$counter\" >";
                    echo "<button class = \"btn btn-outline-primary font-weight-bold text-uppercase float-right my-3\">";
                    echo "location ";
                    echo "</button>";

                    echo "<div class=\"row  align-items-center justify-content-center w-100 mx-auto\">";
                    foreach ($times as $time) {
                        echo "<button class=\"btn btn-outline-primary font-weight-bold text-uppercase col-4 mr-lg-5 mr-4 my-lg-3 my-sm-3 my-3 rounded-0 add-on-timeslot-btn  \" >";
                        echo $time;
                        echo " </button>";
                    }
                    echo "</div>";

                    echo "</div>";
                    $counter++;
                }
                ?>
            </div>
        </div>

        <?php
        include '../nav_bar/footer.php';
        ?>

        <script>
            function clearContent(elementID) {
                document.getElementById(elementID).innerHTML = '';
            }

            function dynamicFilter(date) {
                clearContent('location-time-selection');
                var scheduleList = <?php echo json_encode($scheduleList); ?>;

                if (element['show_date'] == date) {
                }

                });
            }

            function getLocationTimeByDate(scheduleList, date) {
                scheduleList.forEach(element => {

                });
            }
        </script>
    </body>
</html>
