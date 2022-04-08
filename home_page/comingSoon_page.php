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

        </style>
    </head>
    <body>
        <?php
        include '../nav_bar/navigation_bar.php';
        include 'connection.php';
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script>
            $(function () { // on load

                $.ajax({
                    url: "homePageBackEnd.php", //your page
                    type: "POST", //type of method
                    data: {
                        "action": "retrieveAllMoviesFuncCS"
                    }, // passing the values
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    },
                    success: function (result, status, xhr) {
                        $("#movie_cartsCS").html(result);
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
                    $image_query1 = mysqli_query($result, "select * from movie WHERE available_status = 'Coming Soon' ORDER BY RAND()");
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
                                <div class="form-row justify-content-center">
                                    <div class="col-auto">
                                        <form action = "../movie_details/movie_page.php" method ="post">
                                            <input type = "hidden" name = "movie_id" value ="<?= $row['movie_id'] ?>"/>
                                            <input type = "submit" style = "margin-top:5px;" class = "btn btn-primary" value = "Movie Detail"/>
                                        </form>
                                    </div>
<!--                                    <div class="col-auto">
                                        <form action = "../ticket_booking/selectLocation.php" method = "post">
                                            <input type = "hidden" name = "movie_id" value = "<?= $row['movie_id'] ?>"/>
                                            <input type = "submit" style = "margin-top:5px;" class = "btn btn-success" value = "  Book Now  "/>
                                        </form>
                                    </div>-->
                                </div>
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
        </div>

        <div class="col-lg-12 input-group mt-3 justify-content-center">
            <input type="search" class="form-control rounded mr-3 col-lg-4 srchBar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" id = "search-text"/>
            <button type="button" class="btn btn-outline-primary srchBtn  " id="serch-btn">search</button>
        </div>

        <div class="row col-5">
            <h2 class="position-relative mx-2 mt-3 mt-md-3 mt-sm-6 col text-light" onclick="window.location.href = 'home_page.php'">Now Showing</h2>
            <h2 class="position-relative mx-2 mt-3 mt-md-3 mt-sm-6 col text-light" onclick="window.location.href = 'comingSoon_page.php'">Coming Soon</h2>

        </div>

        <div class="py-2 my-1 text-center position-relative mx-2">
            <div class="position-absolute w-100 top-50 start-50 translate-middle" style="z-index: 2">
                <span class="d-inline-block bg-white px-2 text-muted"></span>
            </div>
            <div class="position-absolute w-100 top-50 start-0 border-muted border-top"></div>
        </div>

        <div class="row" id = "movie_cartsCS">

        </div>

        <?php
        include '../nav_bar/footer.php';
        ?>

        <script>
            $("#serch-btn").on("click", function () {
                $.ajax({
                    url: "homePageBackEnd.php", //your page
                    type: "POST", //type of method
                    data: {
                        "action": "retrieveAllMoviesBasedOnGenreFuncCS",
                        "movie_genre_search": $("#search-text").val()
                    }, // passing the values
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    },
                    success: function (result, status, xhr) {
                        $("#movie_cartsCS").html(result);
                    }
                });
            })
        </script>

    </body>
</html>