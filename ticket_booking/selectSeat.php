<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>
        <?php
        include 'selectSeatBackEnd.php';
        if (isset($_POST['cinema_room_id']) && !empty($_POST['cinema_room_id'])) {
            $cinemaRoomID = $_POST['cinema_room_id'];
            $showDate = $_POST['show_date'];
            $showTime = $_POST['show_time'];
            $movieID = $_POST['movie_id'];

            $seatList = getSeats($cinemaRoomID, $showDate, $showTime, $movieID);
        }
        ?>
        <?php
        include '../nav_bar/navigation_bar.php';
        ?>
        <link rel="stylesheet" href="selectSeat.css"/>
        <?php
        $borderPrimary = "border border-primary";
        $borderWaring = "border border-warning";
        $borderDanger = "border border-danger";
        $borderPrimary = " ";
        $borderWaring = " ";
        $borderDanger = " ";
        ?>
        <div class="container-fluid  py-3 <?php echo $borderDanger ?> clearfix text-center">
            <div class="container-fluid  py-3 <?php echo $borderPrimary ?>  h-5 col-lg-10 px-0">
                <img class ="img-fluid" src="images/Cinema_Screen.png"  alt="yah" style="width:100%;height: 100px;">
            </div>

            <div class="container-fluid <?php echo $borderPrimary ?> col-lg-10  scrolling-wrapper seats-box">

                <?php
                $seatNo = 1;
                $alpha = 65;

                $ttlSeat = count($seatList);
                $ttlCluster = ceil($ttlSeat / 16);

                $ttlbigRows = ceil($ttlCluster / 3); // 2 correct -- used

                $bigColArr = array(); //-- used

                for ($i = 1; $i <= floor($ttlCluster / 3); $i++) {
                    array_push($bigColArr, 3);
                }
                if ($ttlCluster % 3 != 0)
                    array_push($bigColArr, $ttlCluster % 3);

                $lastTtlSeats = $ttlSeat - (16 * ($ttlCluster - 1));

                $ttlSmallRows = 4;
                $lastTtlSmallRows = ceil($lastTtlSeats / 4);

                $ttlSmallCols = array(4, 4, 4, 4);

                $lastTtlSmallColArr = array();
                for ($i = 1; $i <= floor($lastTtlSeats / 4); $i++) {
                    array_push($lastTtlSmallColArr, 4);
                }
                if ($lastTtlSeats % 4 != 0)
                    array_push($lastTtlSmallColArr, $lastTtlSeats % 4);

                $counter = 0;
                for ($x = 0; $x < $ttlbigRows; $x++) {// ceiling (? cluster / 3) = answer;
                    echo "<div class=\"row py-3 $borderWaring flex-nowrap px-lg-auto\">"; // big row

                    for ($y = 0; $y < $bigColArr[$x]; $y++) {// do for loop to minus three and insert into array
                        echo "<div class=\"container-fluid  p-2 $borderDanger col-lg-3 col-8 px-0 flex-nowrap mx-lg-auto mx-5\">";

                        if ($x == $ttlbigRows - 1 && $y == $bigColArr[$x] - 1) {
                            $ttlSmallRows = $lastTtlSmallRows;

                            $ttlSmallCols = $lastTtlSmallColArr;
                        }

                        for ($z = 0; $z < $ttlSmallRows; $z++) {// for loop to minus 16 and insert and insert into array
                            echo "<div class=\"row my-3 flex-nowrap\">";
                            for ($a = 0; $a < $ttlSmallCols[$z]; $a++) {
                                $uniFormID = uniqid();
                                $seatText = chr($alpha) . str_pad($seatNo, 2, '0', STR_PAD_LEFT);
                                if ($seatList[$counter]['status'] == "Booked")
                                    echo "<button class=\"btn bg-danger text-white col col-sm-2 mx-sm-auto mx-2 add-on-seat-btn seat-btn\"  disabled id=\"" . $seatList[$counter]['schedule_id'] . "\">"; //Unavailable - bg-danger text-white border-danger disabled
                                else
                                    echo "<button class=\"btn btn-outline-primary col col-sm-2 mx-sm-auto mx-2 add-on-seat-btn seat-btn\" id=\"" . $seatList[$counter]['schedule_id'] . "\">"; //Unavailable - bg-danger text-white border-danger disabled
                                echo $seatText;
                                echo "</button>";
                                $seatNo++;
                                $counter++;
                            }

                            $seatNo -= 4;
                            $alpha++;
                            echo "</div>";
                        }
                        $seatNo += 4;
                        $alpha -= 4;
                        echo "</div>";
                    }
                    $seatNo = 1;
                    $alpha += 4;
                    echo "</div>";
                }
                ?>
            </div>
            <div class=" d-flex flex-row-reverse">
                <button class="btn btn-outline-primary font-weight-bold text-uppercase col-lg-2 col-4 my-lg-3 my-sm-3 my-3 rounded-0 add-on-next-btn " id="next-btn">
                    next
                </button>
            </div>

        </div>

        <?php
        include '../nav_bar/footer.php';
        ?>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="cookies.js"></script>

        <script>
            var sch_seats = [];

            $('.seat-btn').on('click', function () {
                if (this.classList.contains('selectedSeat')) {
                    $(this).removeClass('selectedSeat');


                    var index = sch_seats.findIndex(p => p.sch_id == this.id);

                    if (index !== -1) {
                        sch_seats.splice(index, 1);
                    }

                } else {
                    $(this).addClass('selectedSeat');
                    sch_seats.push({"sch_id": this.id, "seat_name": this.innerText});
                }
            });

            $('#next-btn').on('click', function () {
                //delete_cookie("Seats");
                if (sch_seats.length != 0) {
                    createCookie('seatsSelected', JSON.stringify(sch_seats), '1');
                    window.location = 'selectFood.php';
                } else {
                    alert("At least one seat must be select");
                }
            });

            //

            /*
             function sendSeatData(sch_seats, url) {
             $.ajax({
             type: "POST", //type of method
             url: "selectSeatBackEnd.php", //your page
             data: {action: "setSeatsBookedFunc",
             schedule_seats: JSON.stringify(seats)
             }, // passing the values
             success: function (res) {
             //do what you want here...
             createCookie('seatsSelected', JSON.stringify(sch_seats), '1');
             window.location = url;
             }
             });
             }
             *
             */




        </script>
    </body>
</html>
