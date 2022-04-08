<?php

include "../db_connection.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "retrieveAllMoviesFunc") {
        retrieveAllMoviess();
    }

    if ($_POST['action'] == "retrieveAllMoviesBasedOnGenreFunc") {
        retrieveAllMoviesBasedOnGenre($_POST['movie_genre_search']);
    }
    
    if ($_POST['action'] == "retrieveAllMoviesFuncCS") {
        retrieveAllMoviessCS();
    }
    
    if ($_POST['action'] == "retrieveAllMoviesBasedOnGenreFuncCS") {
        retrieveAllMoviesBasedOnGenreCS($_POST['movie_genre_search']);
    }
}

function retrieveAllMoviess() {
    $conn = OpenCon();
    $htmlcode = "";

    $image_query = mysqli_query($conn, "select * from movie WHERE available_status = 'Now Showing'");
    if (mysqli_num_rows($image_query) > 0) {
        while ($rows = mysqli_fetch_array($image_query)) {
            $img_id = $rows['movie_id'];
            $img_name = $rows['movie_name'];
            $img_src = $rows['movie_image'];
            $videourl = $rows['video_link'];

            $htmlcode .= retrieveAllMovies($img_id, $img_name, $img_src, $videourl);
        }
    }
    CloseCon($conn);

    echo $htmlcode;
}

function retrieveAllMoviessCS() {
    $conn = OpenCon();
    $htmlcode = "";

    $image_query = mysqli_query($conn, "select * from movie WHERE available_status = 'Coming Soon'");
    if (mysqli_num_rows($image_query) > 0) {
        while ($rows = mysqli_fetch_array($image_query)) {
            $img_id = $rows['movie_id'];
            $img_name = $rows['movie_name'];
            $img_src = $rows['movie_image'];
            $videourl = $rows['video_link'];

            $htmlcode .= retrieveAllMoviesCS($img_id, $img_name, $img_src, $videourl);
        }
    }
    CloseCon($conn);

    echo $htmlcode;
}

function retrieveAllMoviesBasedOnGenre($genre) {
    $conn = OpenCon();
    $htmlcode = "";

    $image_query = "select * from movie WHERE available_status = ? AND UPPER(movie_genre) = UPPER(?)";

    $stmt = $conn->prepare($image_query);
    $currentState = "Now Showing";
    $stmt->bind_param("ss", $currentState, $genre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($rows = $result->fetch_assoc()) {
            $img_id = $rows['movie_id'];
            $img_name = $rows['movie_name'];
            $img_src = $rows['movie_image'];
            $videourl = $rows['video_link'];

            $htmlcode .= retrieveAllMovies($img_id, $img_name, $img_src, $videourl);
        }
    }

    CloseCon($conn);

    echo $htmlcode;
}

function retrieveAllMoviesBasedOnGenreCS($genre) {
    $conn = OpenCon();
    $htmlcode = "";

    $image_query = "select * from movie WHERE available_status = ? AND UPPER(movie_genre) = UPPER(?)";

    $stmt = $conn->prepare($image_query);
    $currentState = "Coming Soon";
    $stmt->bind_param("ss", $currentState, $genre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($rows = $result->fetch_assoc()) {
            $img_id = $rows['movie_id'];
            $img_name = $rows['movie_name'];
            $img_src = $rows['movie_image'];
            $videourl = $rows['video_link'];

            $htmlcode .= retrieveAllMovies($img_id, $img_name, $img_src, $videourl);
        }
    }

    CloseCon($conn);

    echo $htmlcode;
}

function retrieveAllMovies($img_id, $img_name, $img_src, $videourl) {
    $htmlcode = "";
    $htmlcode .= "<div class=' col-lg-3 col-md-4 col-xs-6 p-lg-6'>";
    $htmlcode .= "<div style = 'border:1px; solid #333; background-color:white; border-radius:6px; padding:14px; border-width:1px;' align = 'center' class = 'rounded mt-lg-3 mt-4 mt-md-2 my-sm-3 col-lg-11 '>";
    $htmlcode .= "<img src = 'data:image/jpg;charset=utf8;base64, " . base64_encode($img_src) . "' alt = '' title = '" . $img_name . "' class = 'img card-img-top img-fluid mt-md-2 mt-lg-2 mt-sm-4 rounded float-lg-start ' <br>";
    $htmlcode .= "<h5 class = 'text-info mt-lg-2 mt-sm-3 mt-md-2 text-responsive'>" . $img_name . "</h5>";
    
    $htmlcode .= "<div class='form-row'>";
    $htmlcode .= "<button type = 'button' id = 'trailer' class = 'btn btn-outline-primary btn-circle btn-xl fa fa-play' style = ' margin-top:5px;' data-toggle = 'modal' data-target = '#myModal2" . $videourl . "'></button>";
    $htmlcode .= "<div class = 'modal fade' id = 'myModal2" . $videourl . "' tabindex = '-1' role = 'dialog' aria-labelledby = 'exampleModalLabel' aria-hidden = 'true'>";
    $htmlcode .= "<div class = 'modal-dialog modal-lg modal-xl-1140' role = 'document'>";
    $htmlcode .= "<div class = 'modal-content'>";
    $htmlcode .= "<div class = 'modal-header'>";
    $htmlcode .= "<h5 class = 'modal-title text-info' id = 'exampleModalLabel'>" . $img_name . "</h5>";
    $htmlcode .= "<button type = 'button' class = 'close' data-dismiss = 'modal' aria-label = 'Close'>";
    $htmlcode .= "<span aria-hidden = 'true'>&times; </span>";
    $htmlcode .= "</button>";
    $htmlcode .= "</div>";
    $htmlcode .= "<div class = 'modal-body'>";

    $htmlcode .= "</div>";
    $htmlcode .= "<iframe class = 'ml-lg-2 mt-lg-8 mt-4 mt-md-2 my-sm-3 mr-2' height = '400px' src = 'https://www.youtube.com/embed/" . $videourl . "?autoplay=1&autohide=1&controls=1&showinfo=0&modestbranding=1&rel=0'></iframe>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    
    $htmlcode .= "<div class='form-group col-auto col-xl-6'>";
    $htmlcode .= "<form action = '../movie_details/movie_page.php' method = 'post'>";
    $htmlcode .= "<input type = 'hidden' name = 'movie_id' value = '" . $img_id . "'/>";
    $htmlcode .= "<input type = 'submit' style = 'margin-top:5px;' class = 'btn btn-outline-primary' value = 'Movie Detail'/>";
    $htmlcode .= "</form>";
    $htmlcode .= "</div>";
    $htmlcode .= "<div class='form-group col-auto col-xl-9'>";
    $htmlcode .= "<form action = '../ticket_booking/selectLocation.php' method = 'post'>";
    $htmlcode .= "<input type = 'hidden' name = 'movie_id' value = '" . $img_id . "'/>";
    $htmlcode .= "<input type = 'submit' style = 'margin-top:5px; ' class = 'btn btn-outline-success' value = '  Book Now  '/>";
    $htmlcode .= "</form>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    

    return $htmlcode;
}

function retrieveAllMoviesCS($img_id, $img_name, $img_src, $videourl) {
    $htmlcode = "";
    $htmlcode .= "<div class=' col-lg-3 col-md-4 col-xs-6 p-lg-6'>";
    $htmlcode .= "<div style = 'border:1px; solid #333; background-color:white; border-radius:6px; padding:14px; border-width:1px;' align = 'center' class = 'rounded mt-lg-3 mt-4 mt-md-2 my-sm-3 col-lg-11 '>";
    $htmlcode .= "<img src = 'data:image/jpg;charset=utf8;base64, " . base64_encode($img_src) . "' alt = '' title = '" . $img_name . "' class = 'img card-img-top img-fluid mt-md-2 mt-lg-2 mt-sm-4 rounded float-lg-start ' <br>";
    $htmlcode .= "<h5 class = 'text-info mt-lg-2 mt-sm-3 mt-md-2 text-responsive'>" . $img_name . "</h5>";
    
    $htmlcode .= "<div class='form-row justify-content-center'>";
    $htmlcode .= "<button type = 'button' id = 'trailer' class = 'btn btn-outline-primary btn-circle btn-xl fa fa-play' style = ' margin-top:5px;' data-toggle = 'modal' data-target = '#myModal2" . $videourl . "'></button>";
    $htmlcode .= "<div class = 'modal fade' id = 'myModal2" . $videourl . "' tabindex = '-1' role = 'dialog' aria-labelledby = 'exampleModalLabel' aria-hidden = 'true'>";
    $htmlcode .= "<div class = 'modal-dialog modal-lg modal-xl-1140' role = 'document'>";
    $htmlcode .= "<div class = 'modal-content'>";
    $htmlcode .= "<div class = 'modal-header'>";
    $htmlcode .= "<h5 class = 'modal-title text-info' id = 'exampleModalLabel'>" . $img_name . "</h5>";
    $htmlcode .= "<button type = 'button' class = 'close' data-dismiss = 'modal' aria-label = 'Close'>";
    $htmlcode .= "<span aria-hidden = 'true'>&times; </span>";
    $htmlcode .= "</button>";
    $htmlcode .= "</div>";
    $htmlcode .= "<div class = 'modal-body'>";

    $htmlcode .= "</div>";
    $htmlcode .= "<iframe class = 'ml-lg-2 mt-lg-8 mt-4 mt-md-2 my-sm-3 mr-2' height = '400px' src = 'https://www.youtube.com/embed/" . $videourl . "?autoplay=1&autohide=1&controls=1&showinfo=0&modestbranding=1&rel=0'></iframe>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    
    $htmlcode .= "<div class='form-group col-auto'>";
    $htmlcode .= "<form action = '../movie_details/movie_page.php' method = 'post'>";
    $htmlcode .= "<input type = 'hidden' name = 'movie_id' value = '" . $img_id . "'/>";
    $htmlcode .= "<input type = 'submit' style = 'margin-top:5px;' class = 'btn btn-outline-primary' value = 'Movie Detail'/>";
    $htmlcode .= "</form>";
    $htmlcode .= "</div>";
//    $htmlcode .= "<div class='form-group col-5'>";
//    $htmlcode .= "<form action = '../ticket_booking/selectLocation.php' method = 'post'>";
//    $htmlcode .= "<input type = 'hidden' name = 'movie_id' value = '" . $img_id . "'/>";
//    $htmlcode .= "<input type = 'submit' style = 'margin-top:5px; ' class = 'btn btn-outline-success' value = '  Book Now  '/>";
//    $htmlcode .= "</form>";
//    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
    $htmlcode .= "</div>";
   
    return $htmlcode;
}



