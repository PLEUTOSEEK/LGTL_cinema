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
       
         <div class="row">
            <?php
            $result = mysqli_connect($host, $uname) or die("Could not connect to database." . mysqli_error());
            mysqli_select_db($result, $db_name) or die("Could not select the databse." . mysqli_error());
            $image_query = mysqli_query($result, "select * from movie");
            if (mysqli_num_rows($image_query) > 0) {
                while ($rows = mysqli_fetch_array($image_query)) {
                    $img_name = $rows['movie_name'];
                    $img_src = $rows['movie_image'];
                    $video = $rows['video_link'];
                    ?>
            
                    <div class="column col-lg-3 col-md-4 col-xs-6 p-lg-6">
                        <!--<form method="post" action="index.php?action=add&id=<?php echo $row["imageID"]; ?>">-->  
                        <div style="border:1px solid #333; background-color:white; border-radius:6px; padding:14px; border-width:1px;" align="center" class="rounded mt-lg-3 mt-4 mt-md-2 my-sm-3 col-lg-11 "> 
                            <img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($img_src); ?>" alt="" title="<?php echo $img_name; ?>" class="img card-img-top img-fluid mt-md-2 mt-lg-2 mt-sm-4 rounded float-lg-start " <br>                             
                            <h5 class="text-info mt-lg-2 mt-sm-3 mt-md-2 text-responsive"><?php echo $img_name; ?></h5>  
                            <!--<input type="hidden" name="movie_name" value="<?php echo $img_name; ?>" />-->    
                            <button onclick="play()" value="Input Button" type="button" class="btn btn-outline-primary btn-circle btn-xl fa fa-play" style=" margin-top:5px;"></button>
                            <input id="mdetail" onclick="mdetails()" type="submit" style="margin-top:5px;" class="btn btn-outline-primary" value="Movie Detail"/>  
                            <input type="submit" name="Book_now" style="margin-top:5px; " class="btn btn-outline-success" value="  Book Now  "/>
<!--                            <video id="myvideo" data-id="<?php echo $video ?>"  style="width:100%; height:400px;" type="video/mp4" controls   />
                                    <source  style="width:100%; height:400px;" src="video/<?php // echo $video; ?>"  />
                                     <iframe class="embed-responsive-item" src="style="width:100%; height:400px;" src="video/<?php echo $video; ?>" allowfullscreen></iframe>
                            </video>-->
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