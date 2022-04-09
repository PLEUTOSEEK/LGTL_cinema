<?php

session_start();

include "../db_connection.php";

if (!empty($_POST['action'])) {
    if ($_POST['action'] == "loadMvCommentFunc") {
        loadMvComment($_POST['mvID']);
    }
}

function loadMvComment($mvID) {
    $conn = OpenCon();

    $query = "select "
            . "C.cust_id, "
            . "C.cust_name, "
            . "C.customer_image, "
            . "MC.rating, "
            . "MC.comment "
            . "from "
            . "movie_comment MC "
            . "JOIN customer C USING(cust_id) "
            . "where MC.movie_id = '" . $mvID . "' "
            . "order by movie_comment_id desc";
    $result = mysqli_query($conn, $query);

    $htmlCode = "";

    while ($rows = mysqli_fetch_assoc($result)) {
        $htmlCode .= '<div class="container-fluid justify-content-center col-md-7 text-muted">';
        $htmlCode .= '<div class="comment-box ml-12 justify-content-center float-left col-11 m-3">';
        $htmlCode .= '<div class="m-2 mt-2 md-9 float-left"> <img src="data:image/jpg;charset=utf8;base64,' . base64_encode($rows['customer_image']) . '" width="45"class="rounded-circle"> </div>';
        $htmlCode .= '<div class="m-3 justify-content-center text-white fs-5 text-uppercase">';
        $htmlCode .= $rows['cust_name'];
        $htmlCode .= '</div>';
        $htmlCode .= '<div class="col-9 float-left">';
        $htmlCode .= '<div class="rateOptionBox">';
        $checkRateNumber = $rows['rating'];
        $htmlCode .= checkRate($checkRateNumber);
        $htmlCode .= '</div>';
        $htmlCode .= '</div>';
        $htmlCode .= '<fieldset disabled class="float-left col-12">';
        $htmlCode .= '<div class="comment-area"> <textarea class="form-control bg-dark text-light disabledTextInput" style="border:0px">';
        $htmlCode .= $rows['comment'];
        $htmlCode .= '</textarea> </div>';
        $htmlCode .= '</fieldset>';
        $htmlCode .= '</div>';
        $htmlCode .= '</div>';
    }


    CloseCon($conn);

    echo $htmlCode;
}

function checkRate($row) {
    $i = 0;
    $htmlCode = "";
    while ($i < $row) {
        $htmlCode .= '<label>';
        $htmlCode .= '<input type="radio" name="rateOption1"id="rateOption1" class="rateOption1" />';
        $htmlCode .= '<img src="../contact_us/start_check.png" width="30%">';
        $htmlCode .= '</label>';
        $i++;
    }

    return $htmlCode;
}
?>

