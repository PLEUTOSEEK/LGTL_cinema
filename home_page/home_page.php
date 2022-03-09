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
                padding-left:2em;
            }
            
/*            .column {
                float: left;
                width: 33.33%;
                padding: 5px;
            }

            .row::after {
                content: "";
                clear: both;
                display: table;
                float: left;
            }
            
            @media screen and (max-width: 500px) {
                .column {
                    width: 100%;
                }
            }*/
          
            
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
        
        <div> 
            <h2 class="text-info mt-lg-3 col-lg-6"><b>Now Showing</b> <span class="tab-space">Coming Soon</span></h2>
        </div>
        
        <div class="py-2 my-1 text-center position-relative mx-2">
            <div class="position-absolute w-100 top-50 start-50 translate-middle" style="z-index: 2">
                <span class="d-inline-block bg-white px-2 text-muted"></span>
            </div>
            <div class="position-absolute w-100 top-50 start-0 border-muted border-top"></div>
        </div>
        
        <div class="row">
            <?php
            $result = mysqli_connect($host, $uname) or die("Could not connect to database." . mysqli_error());
            mysqli_select_db($result, $db_name) or die("Could not select the databse." . mysqli_error());
            $image_query = mysqli_query($result, "select imageID, imageName, imageData from homeimage");
            if (mysqli_num_rows($image_query) > 0) {
                while ($rows = mysqli_fetch_array($image_query)) {
                    $img_name = $rows['imageName'];
                    $img_src = $rows['imageData'];
                    ?>
            
                    <div class="column col-lg-3 col-md-4 col-xs-6 p-lg-6">
                        <!--<form method="post" action="index.php?action=add&id=<?php echo $row["imageID"]; ?>">-->  
                        <div style="border:1px solid #333; background-color:white; border-radius:6px; padding:14px; border-width:1px;" align="center" class="rounded mt-lg-3 mt-4 mt-md-2 my-sm-3 col-lg-11 "> 
                            <img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($img_src); ?>" alt="" title="<?php echo $img_name; ?>" class="img card-img-top img-fluid mt-md-2 mt-lg-2 mt-sm-4 rounded float-lg-start " <br> 
                            <h5 class="text-info mt-lg-2"><?php echo $img_name; ?></h5>  
                            <!--<input type="hidden" name="movie_name" value="<?php echo $img_name; ?>" />-->    
                            <input type="submit" name="movie_detail" style="margin-top:5px;" class="btn btn-outline-primary" value="Movie Detail"/>  
                            <input type="submit" name="Book_now" style="margin-top:5px; margin-left: 4px;" class="btn btn-outline-success" value="Book Now"/>
                        </div>  
                        <!--</form>-->  
                    </div>


                    <?php
                }
            }
            ?>
        </div>
        <?php
        include '../nav_bar/footer.php';
        ?>

    </body>
</html>
