<?php

session_start();

include "../db_connection.php";

if (!empty($_POST['action'])) {
    if ($_POST['action'] == "insertMovieCommentFunc") {
        insertComment($_POST['data']);
    }
}

function insertComment($data) {
    $data = json_decode($data, true);
    $conn = OpenCon();

    $sql = "insert into movie_comment(cust_id,movie_id,rating,comment,date_modified) Values(?,?,?,?,?)";

    $custID = !empty($_SESSION['logInCustomer']) ? $_SESSION['logInCustomer']['cust_id'] : "00000";
    $currentDate = date("Y-m-d H:i:s");

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $custID, $data['mvID'], $data['ratingStar'], $data['comment'], $currentDate);
    $stmt->execute();

    CloseCon($conn);
}

?>
