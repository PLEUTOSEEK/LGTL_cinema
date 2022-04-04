<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello, world!</title>
        <link rel="stylesheet" href="home_page.css"/>
        <style>



            .srchBar{
                background-color : #F7F7F7 !important;
            }

            .card-img-top{
                width: 200%;
                /*height: 15vw;*/
                height: 230px;
                object-fit: cover;
            }

            .tab-space {
                padding-left:1em;
            }

            .title{
                color: #6DD4F9;
            }

            .title:hover{
                color: #314CAA;

            }


            @media screen and (min-width: 544px){
                h5 { font-size: calc( 20px + (24 - 16) * (10vw - 40px) / (800 - 400) ); }
            }

            /*Safari <8 and IE <11*/
            @media screen and (min-width: 768px){
                h5 { font-size: calc( 1px + (24 - 16) * (10vw - 40px) / (800 - 400) ); }
            }

            @media screen and (min-width: 1200px){
                h5 { font-size: calc( 30px + (24 - 16) * (10vw - 40px) / (800 - 400) ); }
            }

            @media screen and (min-width: 50em){
                h5 { font-size: calc( 5px + (24 - 16) * (10vw - 40px) / (800 - 400) ); }
            }

        </style>
    </head>
    <body>
        <?php
        include '../nav_bar/navigation_bar.php';
        include 'connection.php';
        ?>

        <!-- Carousel -->
        <div class="container-fluid mt-3 mt-md-3 mt-sm-6 justify-content-center">
            <!--<div class="row">-->
            <div id="demo" class="carousel slide mt-lg-3 mt-md-3 mt-sm-6" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <ul class="carousel-indicators">
                    <?php
                    $image_query1 = mysqli_query($result, "select * from movie WHERE available_status = 'Coming Soon' ORDER BY RAND()");
//                        if (mysqli_num_rows($image_query1) > 0) {
                    while ($rows = mysqli_fetch_array($image_query1)) {
                        $img_name = $rows['movie_name'];
                        $img_src = $rows['movie_image'];
                        $i = 0;
                        foreach ($image_query1 as $row) {
                            $actives = '';
                            if ($i == 0) {
                                $actives = 'active';
                            }
                            ?>
                            <li type="button" data-bs-target="#demo" data-bs-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
                            <?php
                            $i++;
                        }
//                            }
                    }
                    ?>
                </ul>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <?php
//               $result2 = mysqli_connect($host, $uname) or die("Could not connect to database." . mysqli_error());
//               mysqli_select_db($result2, $db_name) or die("Could not select the databse." . mysqli_error());
//               $image_query2 = mysqli_query($result2, "select * from movie WHERE available_status = 'Now Showing' ORDER BY RAND()");
//                while ($rows = mysqli_fetch_array($image_query2)) {
//                    $img_src2 = $rows['movie_image'];
                    $i = 0;
                    foreach ($image_query1 as $row) {
                        $actives = '';
                        if ($i == 0) {
                            $actives = 'active';
                        }
                        ?>
                        <div class="carousel-item <?= $actives; ?>">
                            <img src="data:image/jpg;charset=utf8;base64, <?= base64_encode($row['movie_banner']) ?>" style = "width: 100%; height:500px;">
                            <div class="carousel-caption">
                                <h1 class="mt-lg-2 mt-sm-3 mt-md-2 text-responsive py-2 font-weight-bold text-white"><?= $row['movie_name'] ?></h1>
                                <button id="youtube" onclick="play()" type="submit" class="btn btn-outline-primary btn-circle btn-xl fa fa-play" style=" margin-top:5px;"></button>
                                <input id="mdetail" onclick="mdetails()" type="submit" style="margin-top:5px;" class="btn btn-primary" value="Movie Detail"/>
                                <input type="submit" name="Book_now" style="margin-top:5px; " class="btn btn-success" value="  Book Now  "/>
                            </div>

                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>

                <!-- Left and right controls/icons -->
                <a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#demo" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!--</div>-->
        </div>

        <div class="col-lg-12 input-group mt-3 justify-content-center">
            <input type="search" class="form-control rounded mr-3 col-lg-4 srchBar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary srchBtn ">search</button>
        </div>

        <div class="row col-7">
            <h2 class="position-relative mx-2 mt-3 mt-md-3 mt-sm-6 col text-light" onclick="window.location.href = 'home_page.php'">Now Showing</h2>
            <h2 class="position-relative mx-2 mt-3 mt-md-3 mt-sm-6 col text-light">Coming Soon</h2>

        </div>

        <div class="py-2 my-1 text-center position-relative mx-2">
            <div class="position-absolute w-100 top-50 start-50 translate-middle" style="z-index: 2">
                <span class="d-inline-block bg-white px-2 text-muted"></span>
            </div>
            <div class="position-absolute w-100 top-50 start-0 border-muted border-top"></div>
        </div>

        <div class="row">
            <?php
            $image_query = mysqli_query($result, "select * from movie WHERE available_status = 'Coming Soon' ");
            if (mysqli_num_rows($image_query) > 0) {
                while ($rows = mysqli_fetch_array($image_query)) {
                    $img_id = $rows['movie_id'];
                    $img_name = $rows['movie_name'];
                    $img_src = $rows['movie_image'];
                    $videourl = $rows['video_link'];
                    ?>

                    <div class="column col-lg-3 col-md-4 col-xs-6 p-lg-6">
                        <div style="border:1px solid #333; background-color:white; border-radius:6px; padding:14px; border-width:1px;" align="center" class="rounded mt-lg-3 mt-4 mt-md-2 my-sm-3 col-lg-11 ">
                            <img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($img_src); ?>" alt="" title="<?php echo $img_name; ?>" class="img card-img-top img-fluid mt-md-2 mt-lg-2 mt-sm-4 rounded float-lg-start " <br>
                            <h5 class="text-info mt-lg-2 mt-sm-3 mt-md-2 text-responsive"><?php echo $img_name; ?></h5>
                            <!--<input type="hidden" name="movie_name" value="<?php echo $img_name; ?>" />-->
                            <button type="button" id="trailer" class="btn btn-outline-primary btn-circle btn-xl fa fa-play" style=" margin-top:5px;" data-toggle="modal" data-target="#myModal2<?php echo $videourl ?>"></button>
                            <div class="modal fade" id="myModal2<?php echo $videourl ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-xl-1140" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-info" id="exampleModalLabel"><?php echo $img_name; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        </div>
                                        <iframe class="ml-lg-2 mt-lg-8 mt-4 mt-md-2 my-sm-3 mr-2" height="400px" src="https://www.youtube.com/embed/<?php echo $videourl ?>?autoplay=1&autohide=1&controls=1&showinfo=0&modestbranding=1&rel=0"></iframe>
                                    </div>
                                </div>
                            </div>
                            <form action ="../movie_details/movie_page.php" method="post">
                                <input  type="hidden"  name = "movie_id"  value="<?php echo $img_id; ?>"/>
                                <input  type="submit" style="margin-top:5px;" class="btn btn-outline-primary" value="Movie Detail"/>
                            </form>
                            <form action ="../ticket_booking/selectLocation.php" method="post">
                                <input  type="hidden"  name = "movie_id"  value="<?php echo $img_id; ?>"/>
                                <input type="submit"  style="margin-top:5px; " class="btn btn-outline-success" value="  Book Now  "/>
                            </form>
                            <!--
                                                    </div>
                            <!--</form>-->
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>

        //<?php
//       $result = mysqli_connect($host, $uname) or die("Could not connect to database." . mysqli_error());
//            mysqli_select_db($result, $db_name) or die("Could not select the databse." . mysqli_error());
//            $image_query = mysqli_query($result, "select videolink from homeimage");
//        while ($rows = mysqli_fetch_array($image_query)) {
//            $vid =$rows["videolink"];
//        }
//
        ?>

        <script>

        </script>



        <?php ?>

        <?php
        include '../nav_bar/footer.php';
        ?>

    </body>
</html>