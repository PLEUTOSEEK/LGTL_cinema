<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Hello, world!</title>
        <style>



            .srchBar{
                background-color : #F7F7F7 !important;
            }
            
        </style>
    </head>
    <body>
        <?php
        include '../nav_bar/navigation_bar.php';
        include 'connection.php';
        ?>
        <div id="carouselExampleIndicators" class="carousel slide mt-3" data-ride="carousel">

            <div class="carousel-inner">

                <?php
                $totalTrendMv = 3;
                $mvImg = "food-sample.jpg";
                $captionHeader = "This is header";
                $caption = "This is caption paragraph";

                for ($x = 0; $x < $totalTrendMv; $x++) {
                    if ($x == 0) {
                        $currentMv = "active";
                    } else {
                        $currentMv = "";
                    }
                    echo "<div class=\"carousel-item $currentMv\">";
                    echo "<img class = \"d-block w-100\" src = \"images/$mvImg\" alt = \"First slide\" style = \"height:500px;object-fit: fill;\">";
                    echo "<div class = \"carousel-caption d-none d-md-block\">";
                    echo "<h1 class=\"py-2 font-weight-bold bg-white text-primary\">" . $captionHeader . $x . "</h1>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="col-lg-12 input-group mt-3 justify-content-center">
            <input type="search" class="form-control rounded mr-3 col-lg-4 srchBar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary srchBtn ">search</button>
        </div>

       



        <?php
        include '../nav_bar/footer.php';
        ?>

    </body>
</html>
