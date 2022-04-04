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
            
            .tab-space {
                padding-left:1em;
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
            
*/            
/*            @media screen and (max-width: 500px) {
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
       
        <!--<div class="row">-->
            <?php
            $image_query2 = mysqli_query($result, "select * from movie WHERE movie_name = 'The Batman'");
            if (mysqli_num_rows($image_query2) > 0) {
                while ($rows = mysqli_fetch_array($image_query2)) {
                    $img_name = $rows['movie_name'];
                    $img_src = $rows['movie_image'];
//                    $video = $rows['video_link'];
//                    str_replace("watch?v=", "embed/",$video);
                    $videourl = $rows['video_link'];
                    $releaseDate = $rows['movie_release_date'];
                    $dateFormatted = date_format(date_create($releaseDate), "d-F-Y");
                    ?>

                    <div class="row ml-lg-3">
                        <div class="rounded mt-md-2 mt-lg-3 mt-sm-4 ml-lg-1 col-lg-3 col-md-4 col-sm-8"> 
                            <img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($img_src); ?>" alt="" title="<?php echo $img_name; ?>" class="img img-fluid mt-lg-3 mt-4 mt-md-2 my-sm-3 rounded " style = "width: 350px; height:450px;">                      
                        </div>
                        <div class="col-md-6 col-lg-8 mt-4">
                                <h3 class="text-info mt-lg-4 mt-sm-3 mt-md-2 text-responsive" style="padding:8px;"> <?php echo $img_name; ?></h3>  
                                <h5 class="text-info mt-lg-4 mt-sm-3 mt-md-2 text-responsive" style="padding:6px;"> Genre: <?= $rows['movie_ genre'] ?> <span class="tab-space"> Duration: <?= $rows['movie_duration'] ?></span> <span class="tab-space">Language: <?= $rows['movie_language'] ?> </span> </h5>
                                <h5 class="text-info mt-lg-4 mt-sm-3 mt-md-2 text-responsive" style="padding:2px;"> Subtitle: <?= $rows['movie_subtitle'] ?> <span class="tab-space"> Release Date: <?= $dateFormatted ?> </span></h5>
                                <h5 class="text-info mt-lg-4 mt-sm-3 mt-md-2 text-responsive" style="padding:2px;"> Cast: <br> <?= $rows['movie_cast'] ?></h5>
                                <h5 class="text-info mt-lg-4 mt-sm-3 mt-md-2 text-responsive" style="padding:2px;"> Director: <br> <?= $rows['movie_ director'] ?> </h5>
                                <h5 class="text-info mt-lg-4 mt-sm-3 mt-md-2 text-responsive" style="padding:2px;"> Synopsis: <br> <?= $rows['movie_ synopsis'] ?> </h5>

                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        <!--</div>-->
        
    <div class="row justify-content-center mt-lg-3 mt-4 mt-md-2 my-sm-3">
        <iframe width="750" height="400" src="https://www.youtube.com/embed/<?php echo $videourl; ?>?autoplay=1&autohide=1&controls=1&showinfo=0&modestbranding=1&rel=0"></iframe>
    </div>
        
        <?php
        include '../nav_bar/footer.php';
        ?>

    </body>
</html>