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
        if (isset($_POST['seat'])) {
            echo "<h1>HIII</h1>";
        } else {
            echo "<h1>NPPP</h1>";
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

                for ($x = 0; $x < 3; $x++) {
                    echo "<div class=\"row py-3 $borderWaring flex-nowrap  px-lg-auto\">"; // big row

                    for ($y = 0; $y < 3; $y++) {
                        echo "<div class=\"container-fluid  p-2 $borderDanger col-lg-3 col-8 px-0 flex-nowrap mx-lg-auto mx-5\">";
                        for ($z = 0; $z < 4; $z++) {
                            echo "<div class=\"row my-3 flex-nowrap\">";
                            for ($a = 0; $a < 4; $a++) {
                                $seatText = chr($alpha) . str_pad($seatNo, 2, '0', STR_PAD_LEFT);
                                echo "<button class=\"btn btn-outline-primary col col-sm-2 mx-sm-auto mx-2 add-on-seat-btn seat-btn\" id=\"$seatText\">"; //Unavailable - bg-danger text-white border-danger disabled
                                echo $seatText;
                                echo "</button>";
                                $seatNo++;
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

        <script>
            var seats = [];

            $('.seat-btn').on('click', function () {
                if (this.classList.contains('selectedSeat')) {
                    $(this).removeClass('selectedSeat');
                    var index = seats.indexOf(this.id);
                    if (index !== -1) {
                        seats.splice(index, 1);
                    }


                } else {
                    $(this).addClass('selectedSeat');
                    seats.push(this.id);
                    console.log(this.id);
                }
                console.log(seats);
            });
            //

            function sendSeatData(seats, url) {

                $.ajax({
                    type: "POST", //type of method
                    url: "selectSeat.php", //your page
                    data: {seat: seats}, // passing the values
                    success: function (res) {
                        //do what you want here...

                        window.location = "selectLocation.php";
                    }
                });
            }

            //

            $('#next-btn').on('click', function () {
                createCookie("Seats", seats, "10");
                delete_cookie("Seats");
                sendSeatData(seats, 'selectLocation.php');
            });

            // Function to create the cookie
            function createCookie(name, value, days) {
                var expires;

                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                } else {
                    expires = "";
                }

                document.cookie = escape(name) + "=" +
                        escape(value) + expires + "; path=/";
            }

            function delete_cookie(name) {
                document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            }


        </script>
    </body>
</html>
