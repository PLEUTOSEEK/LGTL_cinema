<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
            /*
                        .h1{
                            color: #314CAA;
                        }*/


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
        include 'connection.php';
        include '../nav_bar/navigation_bar.php';
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script>
            $(function () { // on load

                $.ajax({
                    url: "homePageBackEnd.php", //your page
                    type: "POST", //type of method
                    data: {
                        "action": "retrieveAllMoviesFunc"
                    }, // passing the values
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    },
                    success: function (result, status, xhr) {
                        $("#movie_carts").html(result);
                    }
                });
            });
        </script>
        <!-- Carousel -->
        <div class="container-fluid mt-3 mt-md-3 mt-sm-6 justify-content-center">
            <!--<div class="row">-->
            <div id="demo" class="carousel slide mt-lg-3 mt-md-3 mt-sm-6" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <ul class="carousel-indicators">
                    <?php
                    $image_query1 = mysqli_query($result, "select * from movie WHERE available_status = 'Now Showing' ORDER BY RAND()");
//                        if (mysqli_num_rows($image_query1) > 0) {
                    while ($rows = mysqli_fetch_array($image_query1)) {
                        $img_name = $rows['movie_name'];
                        $img_src = $rows['movie_image'];
                        $videourl = $rows['video_link'];
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
                                <button type="button" id="trailer" class="btn btn-outline-primary btn-circle btn-xl fa fa-play" style=" margin-top:5px;" data-toggle="modal" data-target="#myModal2<?= $videourl ?>"></button>
                                <div class="modal fade" id="myModal2<?= $videourl ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-xl-1140" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-info" id="exampleModalLabel"><?= $img_name ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                            <iframe class="ml-lg-2 mt-lg-8 mt-4 mt-md-2 my-sm-3 mr-2" height="400px" src="https://www.youtube.com/embed/<?= $videourl ?>?autoplay=1&autohide=1&controls=1&showinfo=0&modestbranding=1&rel=0"></iframe>
                                        </div>
                                    </div>
                                </div>
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
            <input type="search" class="form-control rounded mr-3 col-lg-4 srchBar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" id = "search-text"/>
            <button type="button" class="btn btn-outline-primary srchBtn  " id="serch-btn">search</button>
            <!--<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">-->
        </div>

        <div class="row col-7">
            <h2 class="position-relative mx-2 mt-3 mt-md-3 mt-sm-6 col text-light">Now Showing</h2>
            <h2 class="position-relative mx-2 mt-3 mt-md-3 mt-sm-6 col text-light" onclick="window.location.href = 'comingSoon_page.php'">Coming Soon</h2>

        </div>

        <div class="py-2 my-1 text-center position-relative mx-2">
            <div class="position-absolute w-100 top-50 start-50 translate-middle" style="z-index: 2">
                <span class="d-inline-block bg-white px-2 text-muted"></span>
            </div>
            <div class="position-absolute w-100 top-50 start-0 border-muted border-top"></div>
        </div>

        <div class="row" id = "movie_carts">

        </div>

        <script>


        </script>

        <?php
        include '../nav_bar/footer.php';
        ?>

        <script>
            $("#serch-btn").on("click", function () {
                $.ajax({
                    url: "homePageBackEnd.php", //your page
                    type: "POST", //type of method
                    data: {
                        "action": "retrieveAllMoviesBasedOnGenreFunc",
                        "movie_genre_search": $("#search-text").val()
                    }, // passing the values
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    },
                    success: function (result, status, xhr) {
                        $("#movie_carts").html(result);
                    }
                });
            })
        </script>
    </body>
</html>
